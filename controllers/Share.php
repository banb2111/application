<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/5
 * Time: 14:55
 */
class Share extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $user_id=$_SESSION['user_id'];
        $this->user_id=$user_id->id;
        $this->load->model("log_model");
        $this->load->helper('common_helper');
    }
    /**
     * 添加共享客户
     */
    public function share_customer(){

        $cus_id=$_POST['cus_id'];//共享客户id
        $cus_id=explode(",",$cus_id);
        $cus_id=array_filter($cus_id);

        $user_id=$_POST['user_id'];//被共享人
        $user_id=explode(",",$user_id);
        $user_id=array_filter($user_id);
        foreach($user_id as $k=>$user){
            foreach($cus_id as $k=>$cus){
                $data=array(
                    "share"=>$this->user_id,
                    'be_shared'=>$user,
                    'customer_id'=>$cus
                );
                //共享日志添加
                $this->log_model->customer_share_log($cus,$user,$this->user_id);
                $result=$this->db->insert("share",$data);
            }
        }
        echo $result;
    }
    /**
     * 共享的客户列表
     */
    public function my_share_customer(){

        $status=$_GET['status']?$_GET['status']:"";
		if($_GET['lei']!=null&&$_GET['lei']!=0){
			$status=$_GET['lei'];
		}
        $tag=$_GET['tag'];
        $url = base_url().'index.php/share/my_share_customer?'; //导入分页类URL
        if($status){
            $url.="&status=".$_GET['status'];
        }
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        $linkType=$_GET['linkType'];
        if($linkType!=null){
            $url.="&linkType=".$_GET['linkType'];
        }
        //联系状态查询
        $linkDay=$_GET['linkDay'];
        if($linkDay!=null){
            $url.="&linkDay=".$_GET['linkDay'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType!=null){
            $url.="&sortType=".$_GET['sortType'];
        }
        //按时间段查询 开始时间
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        //结束时间
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }
        $type=$_GET['type'];
        $sousuo_text=$_GET['sousuo_text'];
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$_GET['type']."&sousuo_text=".$_GET['sousuo_text'];
            }elseif($type==2){
                $url.="&type=".$_GET['type']."&sousuo_text".$_GET['sousuo_text'];
            }elseif($type==3){
                $url.="&type=".$_GET['type']."&sousuo_text".$_GET['sousuo_text'];
            }elseif($type==4){
                $url.="&type=".$_GET['type']."&sousuo_text".$_GET['sousuo_text'];
            }
        }
        //共享状态
        $share_status=$_GET['share'];
        if($share_status){
            $url.="&share=".$_GET['share'];
        }
        $result=$this->customer_model->queryCustomer2($this->user_id,"","",$linkType,$linkDay,$sortType,$status,
           
		   $tag,$type,$sousuo_text,$start_time,$end_time,"","","","",$share_status);
		
        $count=$result->result_array()[0]['num'];
        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页

        $result=$this->customer_model->queryCustomer2($this->user_id,$config['per_page'],$offset,$linkType,
            $linkDay,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,"","",
            "","",$share_status);
        $customerData= $result->result();
		
		//2017

		//echo "<pre>";
		//var_dump($customerData);die();
		
		//$a=$this->db->last_query();
		//echo "<pre>";
		//var_dump($a);die();
		
		//2017
		
        $regionResult =$this->region->getList();
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $data['customer'][$k] = $v;


            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }

            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->cus_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];

        }
        $data['pages']=$this->pagination->create_links();
        $data['status']=$status;
        $data['tag']=$tag;
        //共享状态
        $data['share']=$share_status;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;

        //售前客服显示
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();

        $data['position']=$this->customer_model->get_position();

        // p($data);die;

        $this->load->view("share/share_customer",$data);
    }
    /**
     * 取消分享
     *
     */
    public function cancel_share(){
        $cus_id=$_POST['cus_id'];
        $cus_id=explode(",",$cus_id);
        $cus_id=array_filter($cus_id);
        foreach($cus_id as $k=>$v){
            $this->db->where("customer_id",$v);
            $this->db->where("share",$this->user_id);
            $result=$this->db->delete("share");
        }
        if($result){
            echo "true";
        }else{
            echo "false";
        }
    }
    /**
     *获取要共享的用户 (客户共享过的就不显示)
     */
    public function get_users(){
        $depart_id=$_POST['department_id'];
        //指定销售的所有人
        $pagenum=$_POST['per_page']?$_POST['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=10 * ($pagenum-1);
        }
        //排除掉共享的用户
        $cus_id=$_POST['cus_id'];
        $cus_id= substr($cus_id,0,strlen($cus_id)-1);
        $this->db->select("user.id");
        $this->db->join("employee e","e.user_id=user.id","left");
        $this->db->join("department d" ,"d.id=e.department_no");
        if($depart_id){
            $this->db->where("d.id",$depart_id);
        }
        $this->db->where_in("s.customer_id",$cus_id);
        $this->db->join("share s","s.be_shared=user.id");
        $customer=$this->db->get("user")->result_array();
        $newcustomer=array_column($customer,"id");
        //获取共享的用户
        $this->db->select("user.*,e.name as ename,d.name as dname,user.username as usname");
        $this->db->join("employee e","e.user_id=user.id","left");
        $this->db->join("department d" ,"d.id=e.department_no");
        if($newcustomer){
            $this->db->where_not_in("user.id",$newcustomer);
        }
        if($depart_id){
            $this->db->where("d.id",$depart_id);
        }
        $this->db->limit(10,$offset);
        $sale_users=$this->db->get('user')->result_array();
        echo json_encode($sale_users);
    }

    /**
     * 弹出用户总数(去除客户已经共享的用户)
     */
    public function get_user_count(){
        $depart_id=$_POST['department_id'];
        $cus_id=$_POST['cus_id'];
        $cus_id= substr($cus_id,0,strlen($cus_id)-1);
        $this->db->select("user.id");
        $this->db->where_in("s.customer_id",$cus_id);
        $this->db->join("share s","s.be_shared=user.id");
        $customer=$this->db->get("user")->result_array();
        $newcustomer=array_column($customer,"id");
        if($depart_id!=null){
            $this->db->where("d.id",$depart_id);
        }
        $this->db->select("user.*,e.name as ename,d.name as dname,user.username as usname");
        $this->db->join("employee e","e.user_id=user.id","left");
        $this->db->join("department d" ,"d.id=e.department_no");
        if($newcustomer){
            $this->db->where_not_in("user.id",$newcustomer);
        }
        $sale_users=$this->db->get('user')->result_array();
        echo count($sale_users);
    }
}