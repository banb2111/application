<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/8
 * Time: 10:32
 */
class My_tags_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    //当前用户所有标签
    public function get_tags(){
        $this->db->where('user_id',1);
        $result=$this->db->get('user_label');
        return $result;
    }
    //获取当前用户该客户的标签
    public function get_cus_tags($id,$cus_id){
            $this->db->where('user_label.user_id',$id);
            $this->db->where('ct.cus_id',$cus_id);
            $this->db->join('custom_tag ct',"ct.tag_id=user_label.id");
            $result=$this->db->get('user_label')->result_array();
            return $result;
    }
    //客户详情标签显示
    public  function cus_tags_info(){
        $this->db->where('user_id',1);
        $result=$this->db->get('user_label')->result_array();
        echo json_encode($result);
    }
}