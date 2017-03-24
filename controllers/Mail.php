<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/4
 * Time: 13:41
 */
class Mail extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model("mail_model");
    }

    //查询当前用户的所有站内信
    public function index(){
        $url = base_url().'index.php/mail?'; //导入分页类URL
        $user=$_SESSION['user_id'];
        //已读状态
        $mail_status=$_GET['mail_status'];
        if(isset($mail_status)){
            $url.="&mail_status=".$_GET['mail_status'];
        }
        //当前用户的站内信信息数量
        $result=$this->mail_model->get_message($user,"","",$mail_status);
        $count=count($result);
        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页
        //获取当前用户的站内信的所有信息
        $data['message']=$this->mail_model->get_message($user,$config['per_page'],$offset,$mail_status);
        //分页
        $data['pages']=$this->pagination->create_links();
        //已读
        $data['mail_status']=$mail_status;
        $this->load->view("mail/my_mail_info",$data);
    }
    //发送站内信
    public function send(){
        //收信人
        $recipient=$_POST['user_id'];
        //内容
        $content=$_POST['mail_content'];
        //发信人
        $user=$_SESSION['user_id'];
        $data=array(
            'sender_user'=>$user->id,
            'recipient_user'=>$recipient,
            'mail_content'=>$content,
            'mail_status'=>0,
            'send_time'=>time(),
        );
        $result=$this->db->insert("mail",$data);
        if($result){
            echo "true";
        }else{
            echo "false";
        }
    }
    //站内信发送消息判断
    public function is_send_message(){
        $cus_id=$_POST['cus_id'];
        $this->db->select("customer.*,u.type,e.name as ename");
        $this->db->where("customer.id",$cus_id);
        $this->db->join("user u",'u.id=customer.creator',"left");
        $this->db->join("employee e",'u.id=e.user_id',"left");
        $customer=$this->db->get("customer")->result_array();
        if($customer[0]['new_user_id']!=0){
            $this->db->select("customer.*,u.type,e.name as ename");
            $this->db->where("customer.id",$cus_id);
            $this->db->join("user u",'u.id=customer.new_user_id',"left");
            $this->db->join("employee e",'u.id=e.user_id',"left");
            $customer=$this->db->get("customer")->result_array();
        }
        echo json_encode($customer);
    }
    //实时检测当前用户未读的信息
    public function get_unread_message(){
        $user=$_SESSION['user_id'];
        $this->db->where("recipient_user",$user->id);
        $this->db->where("mail_status",0);
        $unread_mail=$this->db->get("mail")->result_array();
        echo count($unread_mail);
    }
    //已读
    public function set_readMessage(){
        $id=$_POST['id'];
        $this->db->where("id",$id);
        $this->db->update("mail",array("mail_status"=>1));
    }
    /**
     * 删除指定的信息
     *
     */
    public function delete_message(){
        $id=$_POST['id'];
        $id=explode(",",$id);
        foreach(array_filter($id) as $k=>$v){
            $this->db->where("id",$v);
            $result=$this->db->delete("mail");
        }
        if($result){
            echo true;
        }else{
            echo false;
        }
    }
}