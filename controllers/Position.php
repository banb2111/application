<?php
/**
 * 客户联系人职位类
 * User: Administrator
 * Date: 2016/8/9
 * Time: 18:03
 */
class  Position extends  CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 添加客户联系人职位
     */
    public function add_position(){
        if(!$_POST['name']){
            //联系人职位
            $data['position']=$this->db->get("custom_position")->result_array();
            $this->load->view("system/add_position",$data);
        }else{
            //添加联系人职位
            $data=array(
                "name"=>$_POST['name'],
                "is_default"=>0,
            );
            $result=$this->db->insert("custom_position",$data);
            if($result){
                echo true;
            }else{
                echo false;
            }
        }
    }
    /**
     * 设置默认值
     */
    public function set_default(){
        //清楚默认值
        $this->db->update("custom_position",array("is_default"=>0));
        //获取要设置默认值的职位
        $id=$_POST['id'];
        $this->db->where("id",$id);
        $result=$this->db->update("custom_position",array("is_default"=>1));
        if($result){
            echo true;
        }else{
            echo false;
        }
    }
    /**
     * 修改
     */
    public function update_position(){
        $id=$_POST['id'];
        $this->db->where("id",$id);
        $result=$this->db->update("custom_position",array("name"=>$_POST['name']));
        if($result){
            echo true;
        }else{
            false;
        }
    }
}