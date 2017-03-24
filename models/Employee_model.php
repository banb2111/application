<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/27
 * Time: 18:38
 */
class Employee_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function add($data){
        $result=$this->db->insert('employee',$data);
        return $result;
    }
}