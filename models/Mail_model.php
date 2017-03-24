<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/4
 * Time: 15:44
 */
class  Mail_model extends  CI_Model{
    function  __construct()
    {
        parent::__construct();
    }

    /**
     * 获取当前用户的站内信
     */
    public function get_message($id,$size,$offset,$mail_status){
        $this->db->where("recipient_user",$id->id);
        $this->db->limit($size,$offset);
        //已读状态
        if(isset($mail_status)){
            $this->db->where("mail_status",$mail_status);
        }
        $this->db->order_by('send_time desc');
        $unread_mail=$this->db->get("mail")->result_array();
        return $unread_mail;
    }
}