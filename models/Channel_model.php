<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/3
 * Time: 9:52
 */
class Channel_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    //渠道列表
    public function get_channel(){
       $channel= $this->db->get('channel')->result_array();
        return $channel;
    }

    /**
     * [get_channel_bypid 根据pid获取来源渠道]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-08T09:25:51+0800
     * @param    [type]                   $pid [description]
     * @return   [type]                        [二维数组]
     */
    public function get_channel_bypid($pid){
       $channel= $this->db->get_where('channel',array('pid'=>$pid))->result_array();
        return $channel;
    }

    /**
     * [get_channel_bychname 根据来源渠道名称获取来源渠道]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-08T09:34:15+0800
     * @param    [type]                   $chname [description]
     * @return   [type]                           [一维数组]
     */
    public function get_channel_bychname($chname){
       $channel= $this->db->get_where('channel',array('channel_name'=>$chname))->row_array();
        return $channel;
    }


    /**
     * [getall_channel_format 获取所有来源渠道分类]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-22T16:18:50+0800
     * @param    integer                  $pid [父级id]
     * @return   [type]                        [description]
     */
    public function getall_channel_format($pid = 0 , $format_flag = true){

        $par_channels = $this->db->get_where('channel',array('pid'=>$pid))->result_array();
        $all_channels = array();
        // $all_channels[] = $this->db->get_where('channel',array('id'=>$pid))->row_array();
        foreach($par_channels as $val){
            $all_channels[] = $val;
            $chi_channels_1 = $this->db->get_where('channel',array('pid'=>$val['id']))->result_array();
            foreach($chi_channels_1 as $c1_val){
                if($format_flag){
                    $c1_val['channel_name'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$c1_val['channel_name'];
                }else{
                    $c1_val['channel_name'] = $c1_val['channel_name'];
                }
                
                $all_channels[] = $c1_val;
                $chi_channels_2 = $this->db->get_where('channel',array('pid'=>$c1_val['id']))->result_array();
                foreach($chi_channels_2 as $c2_val){
                    if($format_flag){
                        $c2_val['channel_name'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$c2_val['channel_name'];
                    }else{
                        $c2_val['channel_name'] = $c2_val['channel_name'];
                    }
                    
                    $all_channels[] = $c2_val;
                }
            }

        }
        return $all_channels;

    }

    /**
     * [get_parchannel_bychid 获取来源渠道所有的上级渠道]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-22T16:35:54+0800
     * @return   [type]                   [description]
     */
    public function get_parchannel_bychid($chid = 0){
        if(!empty($chid)){
            $return_channels = array();
            $par_channels = $this->db->select('id,pid')->get_where('channel',array('id'=>$chid))->row_array(); // 当前级别来源渠道
            if(!empty($par_channels['pid'])){

                array_unshift($return_channels , $par_channels['id']); // 上一级渠道

                $par_channels_1 = $this->db->select('id,pid')->get_where('channel',array('id'=>$par_channels['pid']))->row_array();
                if(!empty($par_channels_1['id'])){
                    array_unshift($return_channels , $par_channels_1['id']); // 上二级渠道    
                    if(!empty($par_channels_1['pid'])){
                        $par_channels_2 = $this->db->select('id,pid')->get_where('channel',array('id'=>$par_channels_1['pid']))->row_array();
                        array_unshift($return_channels , $par_channels_2['id']);
                    }                
                }
            }
            return $return_channels;
        }
    }


    /**
     * [get_chischannel_bypid 跟进pid获取所有下级id]
     * @author   zzr QQ:836663500
     * @datetime 2017-01-13T16:15:51+0800
     * @param    integer                  $chid [description]
     * @return   [type]                         [description]
     */
    public function get_chischannel_bypid($pid = 0){
        if(!empty($pid)){
            $return_channels = array();
            $chis_channels = $this->db->select('id')->get_where('channel',array('pid'=>$pid))->result_array(); // 当前级别来源渠道
            


            foreach($chis_channels as $chis_val){
                
                array_unshift($return_channels , $chis_val['id']); // 下一级渠道

                $chis_channels_1 = $this->db->select('id')->get_where('channel',array('pid'=>$chis_val['id']))->result_array(); // 当前级别来源渠道

                foreach($chis_channels_1 as $chis_val_1){
                    array_unshift($return_channels , $chis_val_1['id']); // 下二级渠道

                    $chis_channels_2 = $this->db->select('id')->get_where('channel',array('pid'=>$chis_val_1['id']))->result_array(); // 当前级别来源渠道

                    foreach($chis_channels_2 as $chis_val_2){
                        array_unshift($return_channels , $chis_val_2['id']); // 下二级渠道
                    }
                    
                }

            }
            return $return_channels;
        }
    }

}