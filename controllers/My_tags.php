<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/8
 * Time: 9:35
 */
class My_tags extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model("my_tags_model");
        session_start();
    }
    public function index(){
        $id=$_SESSION['user_id'];
        $id=$id->id;
        $result=$this->my_tags_model->get_tags($id);
        $data['label']=$result->result();
        $this->load->view('system/bag',$data);
    }
    public function add_tag(){
        $id=$_SESSION['user_id'];
        $data=array(
            'tag'=>$_POST['tag'],
            'user_id'=>$id->id,
        );
        $result=$this->db->insert('user_label',$data);
        if($result){
           $this->index();
        }
    }
    //标签修改
    public function update_tag(){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $this->db->where('id',$id);
        $result=$this->db->update('user_label',array('tag'=>$name));
        if($result){
            echo 'true';
        }
    }
}