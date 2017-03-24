<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 10:13
 */
class Remind extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('customer_model');
        $this->load->model('linkman_model');
        session_start();
    }
    public  function menulist(){
        if ($this->uri->segment(3) === FALSE) {
            $product_id = 0;
        } else {
            $product_id = $this->uri->segment(3);
        }
        if ($product_id == "todayRemind") {
            $this->remind_list();
        }
    }
//    public function remind_list(){
//        $tiaojian=$this->uri->segment(4);
//        //分页类
//        $this->load->model('page');
//        $id=$_SESSION['user_id'];
//        $this->load->library('pagination');       //导入分页类
//        $url = base_url().'index.php/customer/menulist/cusMan?'; //导入分页类URL
//        $this->db->select("*,customer.status as sta ,customer.id as cus_id,f.next_time");
//        $this->db->join("follow_customer f","customer.id=f.customer_id");
//        $this->db->where("customer.creator",$id->id);
//        $today_time=strtotime(date("Y-m-d"));
//        $three_time=strtotime(date("Y-m-d",strtotime("+3 day")));
//        if($tiaojian=="today"){
//            $this->db->where("f.next_time",$today_time);
//        }else if($tiaojian=="three"){
//            $this->db->where("f.next_time<=",$three_time);
//            $this->db->where("f.next_time>",$today_time);
//        }elseif($tiaojian=="ten"){
//            $time=strtotime(date("Y-m-d",strtotime("+10 day")));
//            $this->db->where("f.next_time<=",$time);
//            $this->db->where("f.next_time>",$three_time);
//        }
//        $result=$this->db->get('customer');
//        $count=count($result->result()) ;//计算总记录数
//        //分页
//        $config=$this->page->page($url,$count);
//        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
//        if($pagenum==1){
//            $offset=0;
//        }else{
//            $offset=$config['per_page'] * ($pagenum-1);
//        }
//        $this->pagination->initialize($config);      //初始化分类页
//        $this->db->select("*,customer.status as sta ,customer.id as cus_id,f.next_time");
//        $this->db->join("follow_customer f","customer.id=f.customer_id");
//        $this->db->where("customer.creator",$id->id);
//        if($tiaojian=="today"){
//            $time=strtotime(date("Y-m-d"));
//            $this->db->where("f.next_time",$time);
//        }else if($tiaojian=="three"){
//            $this->db->where("f.next_time<=",$three_time);
//            $this->db->where("f.next_time>",$today_time);
//        }elseif($tiaojian=="ten"){
//            $time=strtotime(date("Y-m-d",strtotime("+10 day")));
//            $this->db->where("f.next_time<=",$time);
//            $this->db->where("f.next_time>",$three_time);
//        }
//        $this->db->limit($config['per_page'],$offset);
//        $query=$this->db->get('customer');
//        $data['customer']= $query->result();
//        foreach($data['customer'] as  $k=>$v){
//            $linkman=$this->linkman_model->get_linkman($v->linkman_id,$v->cus_id);
//            $data['customer'][$k]->linkman_name=$linkman[0]->lname;
//            $data['customer'][$k]->linkman_mobile=$linkman[0]->mobile;
//        }
//        $data['pages']=$this->pagination->create_links();
//        $this->load->view("todayRemind",$data);
//    }
}