<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/2
 * Time: 10:43
 */
class System extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 系统设置
     *  意向客户的数量，自动回归公海时间
     */
    public function regression_public(){
        if($_POST['customer_time']){
            $time=$_POST['customer_time'];
            $will_customer=$_POST['will_count'];
            $data=array(
                'will_count'=>$will_customer,
                'customer_time'=>$time,
            );
            $result=$this->db->update('system',$data);
            if($result){
                redirect("system/regression_public");
            }else{
                show_error("","","系统设置错误",'system/regression_public');
            }
        }else{
            $data['system']=$this->db->get('system')->result_array();
            $this->load->view('system/systemSettings',$data);

        }
    }
}