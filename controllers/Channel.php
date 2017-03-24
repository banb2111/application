<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * 渠道类
 * Date: 2016/8/3
 * Time: 9:00
 */
class Channel extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('common_helper');
    }
    public  function  index(){

        // @zzr edit at 2016-12-05 16:30
        $p_channel = $this->db->get_where('channel',array('pid'=>0))->result_array();
        // 取三级渠道来源，临时使用后期可优化封装成函数
        foreach($p_channel as $chval){
            $data['channel'][] = $chval;
            // 下一级
            $chilren_chs = $this->db->get_where('channel',array('pid'=>$chval['id']))->result_array();
            foreach($chilren_chs as $chilrenval){
                $chilrenval['channel_name'] = $chilrenval['channel_name'];
                $data['channel'][] = $chilrenval;
                // 下二级
                $chilren_chs_2 = $this->db->get_where('channel',array('pid'=>$chilrenval['id']))->result_array();
                foreach($chilren_chs_2 as $chilrenval_2){
                    $data['channel'][] = $chilrenval_2;
                }
            }
        }

        $this->load->view("customer/channel",$data);
    }
    //客服渠道添加
    public function add_channel(){
        $user_id=$_SESSION['user_id'];
        // @zzr edit at 2016-12-06 17:01
        $channel_pid = $this->input->post('channel_pid');
        if(empty($channel_pid)){
            echo "<br/><br/><h2 style='color:red'>请选择来源渠道分类</h2>";
            exit(); 
        }
        $channel_name = $this->input->post('channel_name');

        if(empty($channel_name)){
            echo "<br/><br/><h2 style='color:red'>请输入来源渠道名称</h2>";
            exit();
        }
    
        $parent_channel = $this->db->get_where('channel',array('id'=>$channel_pid))->row_array();

        $data=array(
            'channel_name'=>$channel_name,
            'user_id'=>$user_id->id,
            'add_time'=>time(),
            'pid'=>$channel_pid,
            'level'=>intval($parent_channel['level']) + 1
        );
        $result=$this->db->insert('channel',$data);
        if($result){
            $this->index();
        }else{
            echo "<br/><br/><h2 style='color:red'>提交失败，请重试！</h2>";
            exit();
            show_error("","","添加渠道失败","channel/consultation");
        }
    }
    //客服渠道修改
    public function update_channel(){
        $id=$_POST['id'];
        $channel_name=$_POST['channel_name'];
        $this->db->where('id',$id);
        $result=$this->db->update('channel',array('channel_name'=>$channel_name));
        if($result){
            echo 'true';
        }
    }

    /**
     * [delete_channel 删除渠道]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-05T14:39:55+0800
     * @return   [type]                   [description]
     */
    public function delete_channel(){

        if($this->input->is_ajax_request()){

           $ch_id = $this->input->post('id');
           if(!empty($ch_id)){
                $delch_result = $this->db->delete('channel',array('id'=>$ch_id));
                if($delch_result){
                    echo json_encode(array('s'=>'ok','msg'=>'删除渠道数据成功！'));
                    exit();
                }else{
                    echo json_encode(array('s'=>'err','errmsg'=>'删除渠道数据失败！'));
                    exit();
                }
           }else{
                echo json_encode(array('s'=>'err','errmsg'=>'提交数据有误！'));
                exit();
           }
        }
       
    }
}
