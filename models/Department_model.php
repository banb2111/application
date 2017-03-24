<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/27
 * Time: 14:01
 */
class Department_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function add($data){
        $result=$this->db->insert('department',$data);
        return $result;
    }
    public function get_department(){
        $result=$this->db->get('department')->result_array();
        return $result;
    }

    /**
     * [get_department_format 获取简单排版后的部门数据]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-09T14:53:20+0800
     * @return   [type]                   [数组]
     */
    public function get_department_format(){
        $par_department = $this->db->get_where("department",array('no'=>0,'display'=>1))->result_array(); // no => 0 需手动设置
        foreach($par_department as $val){
            $department[] = $val;
            // 下一级
            $department_1 = $this->db->get_where("department",array('no'=>$val['id'],'display'=>1))->result_array();//3-16
            foreach($department_1 as $val_1){
                $val_1['name'] = '&nbsp;&nbsp;&nbsp;&nbsp;--'.$val_1['name'];
                $department[] = $val_1;
                // 下二级
                $department_2 = $this->db->get_where("department",array('no'=>$val_1['id'],'display'=>1))->result_array();
                foreach($department_2 as $val_2){
                    $val_2['name'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--'.$val_2['name'];
                    $department[] = $val_2;
                }
            }
        }
        return $department;
    }

    /**
     * [get_department_format_obj 获取简单排版后的部门数据]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-09T15:00:46+0800
     * @return   [type]                   [对象]
     */
    public function get_department_format_obj(){
        $par_department = $this->db->get_where("department",array('no'=>0))->result(); // no => 0 需手动设置
        foreach($par_department as $val){
            $department[] = $val;
            // 下一级
            $department_1 = $this->db->get_where("department",array('no'=>$val->id))->result();
            foreach($department_1 as $val_1){
                $val_1->name = '&nbsp;&nbsp;&nbsp;&nbsp;--'.$val_1->name;
                $department[] = $val_1;
                // 下二级
                $department_2 = $this->db->get_where("department",array('no'=>$val_1->id))->result();
                foreach($department_2 as $val_2){
                    $val_2->name = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--'.$val_2->name;
                    $department[] = $val_2;
                }
            }
        }
        return $department;
    }
}