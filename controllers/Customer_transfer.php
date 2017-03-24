<?php
/**
 * 客户转移类
 * User: Administrator
 * Date: 2016/8/5
 * Time: 11:13
 */
class Customer_transfer extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model("customer_transfer_model");
        $user=$_SESSION['user_id'];
        $this->user_id=$user->id;
        $this->load->model("log_model");
    }

    /**
     * 转移客户
     */
    public function transfer(){
        //转移客户id
        $cus_id=$_POST['cus_id'];
        //所有人id
        $user_id=$_POST['user_id'];
        //转移客户操作
       $result=$this->customer_transfer_model->transfer($cus_id,$user_id);
        if($result){
            $this->log_model->customer_transfer_log($cus_id,$user_id,$this->user_id);
            echo "true";
        }else{
            echo "false";
        }
    }
}