<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/29
 * Time: 15:50
 */
class Feedback extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        session_start();
    }
    public function menulist()
    {
        if ($this->uri->segment(3) === FALSE) {
            $product_id = 0;
        } else {
            $product_id = $this->uri->segment(3);
        }
        if ($product_id == "sys_feedback") {
            $this->load->view("feedback/sys_feedback");
        }else if ($product_id == "sys_feedback_list") {
           $this->index();
        }
    }

    public function index(){
        $query=$this->db->select('*,e.name')->from('feedback f')->join('employee e','f.user_id=e.user_id')->order_by('add_time desc')->get();
        $data['feedback']=$query->result();
        $this->load->view('feedback/sys_feedback_list',$data);
    }
    //添加反馈
    public function add_feedback(){
        $id=$_SESSION['user_id'];
        $time=time();
        $data=array(
            'user_id'=>$id->id,
            'add_time'=>$time,
            'feed_name'=>$_POST['feed_name'],
            'description'=>$_POST['description'],
        );
        $result=$this->db->insert('feedback',$data);
        if($result){
            show_error("","","添加反馈成功,请等待技术部查看","feedback/menulist/sys_feedback");
        }
    }
}