<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/4
 * Time: 14:48
 */
class Linkman_model extends CI_Model
{
    public  function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    //获取某个客户的主要联系人
    public function get_linkman($link_id,$customer_id){

        if(!empty($link_id)){
            $this->db->where('linkman.id',$link_id);
            $this->db->select('*,linkman.name as lname,cp.name as cpname');
            $this->db->join('custom_position cp',"cp.id=linkman.position_id");
            $this->db->where('linkman.is_default',1);
            $result=$this->db->get('linkman');
            return $result->result();
        }else{
            $this->db->where('linkman.is_default',0);
            $this->db->select('*,linkman.name as lname,cp.name as cpname');
            $this->db->join('custom_position cp',"cp.id=linkman.position_id");
            $this->db->where('linkman.customer_id',$customer_id);
            $result=$this->db->get('linkman')->result();
            return $result;
        }
    }
    public function cus_linkman($customer_id){
            $this->db->select('*,linkman.name as lname,cp.name as cpname');
            $this->db->join('custom_position cp',"cp.id=linkman.position_id");
            $this->db->where('linkman.customer_id',$customer_id);
            $result=$this->db->get('linkman')->result();
            return $result;
    }
}