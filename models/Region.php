<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/4
 * Time: 11:51
 */
class Region extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    //获取当前省份的城市
    public function ajax_region($province_no){

        $this->db->where('father_id',$province_no);
        $query=$this->db->get('region');
        $city=$query->result();
        $str='<select name="city_no" onchange="county(this);" class="form-control" >';
        $str .='<option  value="" selected="selected">请选择</option>';
        foreach($city as $k=>$v){
            $str.='<option value="'.$v->region_code.'">'.$v->region_name.'</option>';
        }
        $str.='</select>';
        echo $str;exit;
    }
    //获取当前城市的县区
    public function ajax_county($city_no){
        $this->db->where('father_id',$city_no);
        $query=$this->db->get('region');
        $city=$query->result();
        $str='<select name="county_no" id="county_id" class="form-control">';
        $str .='<option value="" selected="selected">请选择</option>';
        foreach($city as $k=>$v){
            $str.='<option value="'.$v->region_code.'">'.$v->region_name.'</option>';
        }
        $str.='</select>';
        echo $str;exit;
    }
    public function getList(){
        $query = $this->db->query('select region_id,region_code,region_name FROM nb_region');
        $data = $query->result_array();
        foreach ($data as $value) {
            $result[$value['region_code']] = $value;
        }
        return $result;
    }
}