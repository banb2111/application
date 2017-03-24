<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/4
 * Time: 15:38
 */
class Keyword_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    //获取当前客户的关键词
    public function get_keyword($keyword){
        if(!empty($keyword)){
            $this->db->where('id',$keyword);
            $result=$this->db->get('keyword')->result();
        }
        return $result;
    }
    /**
     * 关键词列表
     */
    public function get_keywords_list($size,$offset,$keyword_name,$category_id,$industry){
        $this->db->select("*,e.name as ename,i.name as iname,keyword.id as kid");
        $this->db->join("employee e","e.user_id=keyword.user_id","left");
        $this->db->join("keywords_category kc","kc.id=keyword.category_id","left");
        $this->db->join("industry i","keyword.id=i.keyword_id","left");
        //关键词查询
        if($keyword_name){
            $this->db->like("keyword.keyword",$keyword_name);
        }
        //关键词类别查询
        if($category_id){
            $this->db->where("keyword.category_id",$category_id);
        }
        //关键词行业查询
        if($industry){
            $this->db->like("i.name",$industry);
        }
        $this->db->group_by("keyword.id");
        $this->db->limit($size,$offset);
        $keyword=$this->db->get("keyword")->result_array();
        return $keyword;
    }
    /**
     * 关键词类别
     *
     */
    public function get_keyword_category(){
       $keyword_category=$this->db->get("keywords_category")->result_array();
        return $keyword_category;
    }

    /**
     * 关键词类别列表
     */
    public function get_category_list($size,$offset){
        $this->db->select("kc.*,e.name as ename");
        $this->db->from("keywords_category kc");
        $this->db->join("employee e","e.user_id=kc.user_id","left");
        $this->db->limit($size,$offset);
        $cate=$this->db->get()->result_array();
        return $cate;
    }

    /**
     * 关键词类型日志列表
     */
    public function  get_category_log($size,$offset){
        $this->db->select("*,e.name as ename");
        $this->db->limit($size,$offset);
        $this->db->order_by("update_time desc");
        $this->db->join("employee e","e.user_id=keywords_category_log.user_id");
        $this->db->join("keywords_category kc","kc.id=keywords_category_log.keywords_cate_id");
        $keywords_category_log=$this->db->get('keywords_category_log')->result_array();
        return $keywords_category_log;
    }

}