<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/24
 * Time: 14:53
 */
class User_model extends  CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //验证用户名和密码是否正确
    public function  auth($username,$password){
        $this->db->where("username",$username,'password',$password);
        $query=$this->db->get("user");
        return $query->result();
    }
    public function get_user($id){
        $this->db->where("user.id",$id);
        $this->db->join("employee e",'e.user_id=user.id');
        $this->db->select("*");
        $query=$this->db->get("user");
        return $query->result();
    }
    //添加用户
    public function add($data){
       $result= $this->db->insert('user',$data);
        $user_id=$this->db->insert_id();
        return $user_id;
    }
    //判断是否登录
    public function is_login(){
        if(!$_SESSION['user_id']){
            redirect('users/logout');
        }
    }
    //用户权限
    public function get_user_power($id){
        $this->db->where("user_id",$id);
        $this->db->join("power p","p.id=user_pk_power.power_id","left");
        $power=$this->db->get("user_pk_power")->result_array();
        return $power;
    }
    //判断当前是否是主管
    public function is_zhuguan($id){
        $this->db->where("user_id",$id);
        $user=$this->db->get("division_manager")->result_array();
        return $user;
    }
    /**
     * 名称查询
     */
    public function get_user_name($id){
        $this->db->where("user.id",$id);
        $this->db->join("employee e","e.user_id=user.id","left");
        $user=$this->db->get("user")->result_array();
        return $user[0]['name'];
    }
}