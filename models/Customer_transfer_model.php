<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/5
 * Time: 11:16
 */
class Customer_transfer_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 转移客户
     * @param $cus_id //客户id
     * @param $user_id //用户id
     */
    public function transfer($cus_id,$user_id){
        $cus_id=explode(",",$cus_id);
        $cus_id=array_filter($cus_id);
        foreach($cus_id as $k=>$v){
            $this->db->where('id',$v);
            $customer=$this->db->get('customer')->result_array();
            //推广客户
            if($customer[0]['extend_status']==1){
                //所有人的部门
                $this->db->where("user.id",$user_id);
                $this->db->join("employee e","user.id=e.user_id");
                $user=$this->db->get("user")->result_array();
                //客户归属人部门
                if($customer[0]['new_user_id']!=0){
                    $this->db->where("user.id",$customer[0]['new_user_id']);
                    $this->db->join("employee e","user.id=e.user_id");
                    $cus_user=$this->db->get("user")->result_array();
                }else{
                    $this->db->where("user.id",$customer[0]['creator']);
                    $this->db->join("employee e","user.id=e.user_id");
                    $cus_user=$this->db->get("user")->result_array();
                }
                //判断当前转移人和被转移人的部门相同
                if($cus_user[0]['department_no']==$user[0]['department_no']){
                    $this->db->where("id",$v);
                    $this->db->update("customer",array("new_user_id"=>$user_id));
                }else{
                    // continue;
                    // @zzr edit at 2017-02-03 17:04
                    $this->db->where("id",$v);
                    $this->db->update("customer",array("new_user_id"=>$user_id));
                }
            }else{
                //不是推广客户直接转移客户
                $this->db->where("id",$v);
                $this->db->update("customer",array("new_user_id"=>$user_id));
            }
        }
        return true;
    }
}