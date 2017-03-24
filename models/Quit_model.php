<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/8
 * Time: 9:55
 */
class Quit_model extends  CI_Model{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取所有的离职信息
     */
    public function get_quit_info($size,$offset,$start_time,$end_time,$user_name,$department){
        $this->db->select("*,e.name as quit_name,em.name as transfer_name ,c.name as creator_name,d.name as dname");
        $this->db->join("employee e","quit.quit_user=e.user_id","left");
        $this->db->join("department d","d.id=e.department_no","left");
        $this->db->join("employee em","quit.transfer_user=em.user_id","left");
        $this->db->join("employee c","quit.creator=c.user_id","left");
        //录入时间段查询
        if($start_time&&$end_time){
            $start_time= strtotime($start_time);
            $end_time= strtotime($end_time);
            $this->db->where("quit.quit_time>=",$start_time);
            $this->db->where("quit.quit_time<",$end_time);
        }
        //用户姓名
        if($user_name){
            $this->db->like("e.name",$user_name);
        }
        //部门
        if($department){
            $this->db->where("d.id",$department);
        }
        $this->db->limit($size,$offset);
        $quit_info=$this->db->get('quit')->result_array();
        return $quit_info;
    }
}