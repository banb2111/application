<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 14:11
 */
class Power extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    //权限显示列表
    public function index()
    {
        $id=$_POST['id'];
        $this->db->select("*,power.id as pid");
        $this->db->where("up.user_id",$id);
        $this->db->join('user_pk_power up',"power.id=up.power_id","left");
        $power_list=$this->db->get("power")->result_array();
        echo json_encode($power_list);
    }
    //添加用户权限
    public function add_user_power(){
        $power_id=$_POST['power_id'];
        $user_id=$_POST['user_id'];
        $power_id=explode(",",$power_id);
        $this->db->where("user_id",$user_id);
        $this->db->delete("user_pk_power");
        foreach(array_filter($power_id) as $k=>$v){
            $this->db->insert("user_pk_power",array("user_id"=>$user_id,"power_id"=>$v,"own"=>1));
        }
        echo "true";
    }


    /**
     * [resetpwd 用户密码重置]
     * @author   zzr QQ:836663500
     * @datetime 2017-01-03T08:53:08+0800
     * @return   [type]                   [description]
     */
    public function resetpwd(){

        $user_id = $this->input->post('user_id');
        if(empty($user_id)){
            echo json_encode(array('s'=>'err','msg'=>'数据有误'));
            exit();
        }
        $upresult = $this->db->where('id='.$user_id)->update('user',array('password'=>md5('123456')));
        if($upresult){
            echo json_encode(array('s'=>'ok','msg'=>'密码重置成功'));
        }else{
            echo json_encode(array('s'=>'err','msg'=>'密码重置失败请重试'));
        }
        exit();
    }



}