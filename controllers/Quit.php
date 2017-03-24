<?php
/**
 * 离职类
 * User: Administrator
 * Date: 2016/8/5
 * Time: 16:59
 */
class Quit extends  CI_Controller{
    function __construct()
    {
        parent::__construct();
        $user=$_SESSION['user_id'];
        $this->user_id=$user->id;
        $this->load->model("customer_transfer_model");
        $this->load->model("quit_model");
    }

    /**
     * 离职信息
     *
     */
    public function index(){
        $url = base_url().'index.php/quit?'; //导入分页类URL

        //按时间段查询
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_POST['end_time'];
        }
        //用户姓名
        $user_name=$_GET['name'];
        if($user_name){
            $url.="&name=".$_GET['name'];
        }
        //部门
        $department=$_GET['department_id'];
        if($department){
            $url.="&department_id=".$_GET['department_id'];
        }


        $quit_count=$this->quit_model->get_quit_info("","",$start_time,$end_time,$user_name,$department);
        $quit_count=count($quit_count);
        //分页
        $config=$this->page->page($url,$quit_count);
        $this->pagination->initialize($config);      //初始化分类页
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        //分页
        $data['pages']=$this->pagination->create_links();
        //所有部门
        $data['department_list']=$this->department_model->get_department();
        //用户名称
        $data['name']=$user_name;
        //部门id
        $data['department_id']=$department;
        $data['quit_info']=$this->quit_model->get_quit_info($config['per_page'],$offset,$start_time,$end_time,$user_name,$department);
        $this->load->view("user/quit_info",$data);
    }

    /**
     * 添加离职
     */
    public function add_quit(){
        if(!$_POST['quit_user']){
            //所有部门
            $data['department_list']=$this->department_model->get_department();
            $this->load->view('user/add_quit',$data);
        }else{
            $quit_user= $_POST["quit_user"];//离职人
            $quit_time=$_POST["quit_time"];//离职时间
            $transfer_user=$_POST["transfer_user"];//交接人
            $content= $_POST["content"];//备注
            $data=array(
                "quit_user"=>$quit_user,
                "quit_time"=>strtotime($quit_time),
                "transfer_user"=>$transfer_user,
                "content"=>$content,
                "creator"=>$this->user_id,
            );
            //交接内容
            $customer_count=$this->get_customer($quit_user);
            $customer_count=count($customer_count);
            $data['transfer_content']="交接客户信息：".$customer_count."个";
            //查询当前用户的签约客户和推广客户
            $this->db->where("sign_status",1);
            $this->db->where("((nb_customer.creator = ".$quit_user." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$quit_user.")");
            $sign_count=$this->db->count_all_results("customer");

            $this->db->where("extend_status",1);
            $this->db->where("((nb_customer.creator = ".$quit_user." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$quit_user.")");
            $tuiguang_count=$this->db->count_all_results("customer");
            //判断当前用户是否存在推广客户和签约客户，如果有则不能完成离职
            if($sign_count!=0||$tuiguang_count!=0){
                //返回推广客户数量
                echo false;
            }else{
                //添加离职
                $this->db->insert("quit",$data);
                //转移客户
                $result=$this->quit_transfer_customer($quit_user,$transfer_user);
                if($result){
                    //修改为不可登录状态
                    $this->db->where("id",$quit_user);
                    $this->db->update("user",array("status"=>0));
                    echo true;
                }
            }
        }
    }

    /**
     * 离职转移客户
     * @param $quit_user //离职人
     * @param  $transfer_user /交接人
     */
    public function quit_transfer_customer($quit_user,$transfer_user){
        $customer=$this->get_customer($quit_user);
        $cus_id="";
        //获取离职人的客户id
        foreach($customer as $k=>$v){
            $cus_id.=$v['id'].",";
        }
        //转移客户
        $result= $this->customer_transfer_model->transfer($cus_id,$transfer_user);
        if($result){
            return $result;
        }
    }

    /**
     * 离职人客户数量
     *
     */
    public function quit_user_info (){
        $id=$_POST['id'];
        //交接客户数量
        $this->db->select("id");
        $this->db->where("((nb_customer.creator = ".$id." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$id.")");
        $customer=$this->db->get("customer")->result_array();
        $customer=count($customer);
        echo $customer;
    }
    /**
     * 离职人
     */
    public function get_customer($id){
        $this->db->select("id");
        $this->db->where("((nb_customer.creator = ".$id." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$id.")");
        $customer=$this->db->get("customer")->result_array();
        return $customer;
    }
}