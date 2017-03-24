<?php
/**
 * 关键词类别类
 * User: Administrator
 * Date: 2016/8/8
 * Time: 13:43
 */
class Keywords_category extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $user=$_SESSION['user_id'];
        $this->user_id=$user->id;
        $this->load->model("log_model");
    }

    /**
     * 关键字列表
     *
     */
    public function keywords_list(){
        $url = base_url().'index.php/keywords_category/keywords_list?'; //导入分页类URL
        //关键词名称
        $keyword_name=$_GET['keyword'];
        if($keyword_name){
            $url.="&keyword=".$_GET['keyword'];
        }
        //关键词类别
        $category_id=$_GET['category_id'];
        if($category_id){
            $url.="&category_id=".$_GET['category_id'];
        }
        //关键词行业
        $industry_name=$_GET['industry_name'];
        if($industry_name){
            $url.="&industry_name=".$_GET['industry_name'];
        }
        $keyword=$this->keyword_model->get_keywords_list("","",$keyword_name,$category_id,$industry_name);
        $count=count($keyword);
        $config=$this->page->page($url,$count);
        $this->pagination->initialize($config);      //初始化分类页
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $data['keyword']=$this->keyword_model->get_keywords_list($config['per_page'],$offset,$keyword_name,$category_id,$industry_name);
        $industry=$this->db->get("industry")->result_array();
        //获取当前关键词的行业
        foreach( $data['keyword'] as $key=>$v){
            foreach($industry as $k=>$val ){
                if($v['kid']==$val['keyword_id']){
                    $data['keyword'][$key]['industry'].=$val["name"].",";
                }
            }
        }
        //分页
        $data['pages']=$this->pagination->create_links();
        //关键词类别
        $data['keyword_category']=$this->keyword_model->get_keyword_category();
        //关键词名称
        $data['keyword_name']=$keyword_name;
        //关键词类型查询
        $data['category_id']=$category_id;
        //行业
        $data['industry_name']=$industry_name;
        $this->load->view("keywords/keywords_list",$data);
    }
    /**
     * 关键词查询
     */
    public function keywords_select(){
        $url = base_url().'index.php/keywords_category/keywords_select?'; //导入分页类URL
        //关键词名称
        $keyword_name=$_GET['keyword'];
        if($keyword_name){
            $url.="&keyword=".$_GET['keyword'];
        }
        //关键词类别
        $category_id=$_GET['category_id'];
        if($category_id){
            $url.="&category_id=".$_GET['category_id'];
        }
        //关键词行业
        $industry_name=$_GET['industry_name'];
        if($industry_name){
            $url.="&industry_name=".$_GET['industry_name'];
        }
        $keyword=$this->keyword_model->get_keywords_list("","",$keyword_name,$category_id,$industry_name);
        $count=count($keyword);
        $config=$this->page->page($url,$count);
        $this->pagination->initialize($config);      //初始化分类页
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $data['keyword']=$this->keyword_model->get_keywords_list($config['per_page'],$offset,$keyword_name,$category_id,$industry_name);
        $industry=$this->db->get("industry")->result_array();
        //获取当前关键词的行业
        foreach( $data['keyword'] as $key=>$v){
            foreach($industry as $k=>$val ){
                if($v['kid']==$val['keyword_id']){
                    $data['keyword'][$key]['industry'].=$val["name"].",";
                }
            }
        }
        //分页
        $data['pages']=$this->pagination->create_links();
        //关键词类别
        $data['keyword_category']=$this->keyword_model->get_keyword_category();
        //关键词名称
        $data['keyword_name']=$keyword_name;
        //关键词类型查询
        $data['category_id']=$category_id;
        //行业
        $data['industry_name']=$industry_name;
        $this->load->view("keywords/keywords_select",$data);
    }

    /**
     * 添加关键词类别
     */
    public function add_keyword_category(){
        if(!$_POST['category_name']){
            $data['type']=1;
            $this->load->view("keywords/add_keyword_category",$data);
        }else{
            $category_name=$_POST['category_name'];//类别名称
            $category_price=$_POST['category_price'];//类别价格
            $data=array(
                "category_name"=>$category_name,
                "category_price"=>$category_price,
                "add_time"=>time(),
                "user_id"=>$this->user_id,
            );
            $keywords_category=$this->db->insert("keywords_category",$data);
            if($keywords_category){
                echo true;
            }else{
                echo false;
            }
        }

    }

    /**
     * 修改关键词类别
     */
    public function update_keyword_category(){
        if(!$_POST['category_name']){
            $id=$_GET['keywords_id'];
            $data['keywords']=$this->db->get_where("keywords_category",array("id"=>$id))->result_array();
            $data['type']=2;
            $this->load->view("keywords/add_keyword_category",$data);
        }else{
            $id=$_POST['keywords_id'];
            $category_name=$_POST['category_name'];//类别名称
            $category_price=$_POST['category_price'];//类别价格
            $data=array(
                "category_name"=>$category_name,
                "category_price"=>$category_price,
            );
            //关键词类别日志添加
            $this->log_model->update_keywords_category_log($id,$category_name,$category_price,$this->user_id);
            $this->db->where("id",$id);
            $keywords_category=$this->db->update("keywords_category",$data);
            if($keywords_category){
                echo true;
            }else{
                echo false;
            }
        }

    }
    /**
     * 优化设置
     *
     */
    public function  optimize_set(){
        if($_GET['id']){
            //获取要优化的关键词
            $this->db->select("*,keyword.id as kid");
            $this->db->where("keyword.id",$_GET['id']);
            $this->db->join("industry i","keyword.id=i.keyword_id","left");
            $data['keyword']=$this->db->get("keyword")->result_array();
            foreach($data['keyword'] as $k=>$v){
                if($_GET['id']==$v['keyword_id']){
                    $data['keyword']["category"].=$v['name'].",";
                }
            }
            //关键词类别
            $data['keyword_category']=$this->keyword_model->get_keyword_category();
            $this->load->view("keywords/update_keyword",$data);
        }else{
            //查询关键词的行业
            $industry_name=$_POST['industry_name'];
            $industry_name=explode(",",$industry_name);
            //插入行业
            $this->db->where("keyword_id",$_POST['keyword_id']);
            $this->db->delete("industry");
            foreach(array_filter($industry_name) as $k=>$v){
                $this->db->insert("industry",array("name"=>$v,"keyword_id"=>$_POST['keyword_id']));
            }
            $data=array(
                "category_id"=>$_POST['category_id'],
                "one_chance"=>$_POST['one_chance'],
                "one_time"=>$_POST['one_time'],
                "two_chance"=>$_POST['two_chance'],
                "two_time"=>$_POST['two_time'],
                "three_chance"=>$_POST['three_chance'],
                "three_time"=>$_POST['three_time'],
            );
            $this->db->where("id",$_POST['keyword_id']);
            $result=$this->db->update("keyword",$data);
            if($result){
                echo true;
            }else{
                echo false;
            }

        }
    }

    /**
     * 添加关键字
     *
     */
    public function add_keywords(){
        if(!$_POST['keyword']){
            $this->load->view("keywords/add_keyword");
        }else{
            //查询所有的行业
            $industry_list=$this->db->get("industry")->result_array();
            //添加关键字
            $keyword=$_POST['keyword'];
            $data=array(
                "keyword"=>$keyword,
                "add_time"=>time(),
                "user_id"=>$this->user_id,
            );
            $result=$this->db->insert("keyword",$data);
            if($result){
                $keyword_id=$this->db->insert_id();
            }
            //行业
            $industry=$_POST['industry'];
            $industry=explode(",",$industry);
            //判断当前行业是否重复，重复就不添加
            foreach(array_filter($industry) as $k=>$v){
                if(!isExist($v,$industry_list)){
                    $data=array(
                        "name"=>$v,
                        'keyword_id'=>$keyword_id,
                    );
                   $result= $this->db->insert("industry",$data);
                }
            }
            if($result){
              echo true;
            }else{
                echo false;
            }
        }
    }
    /**
     * 关键词唯一
     *
     */
    public function  keyword_only(){
        $keyword=$_POST['keyword'];
        $this->db->where("keyword",$keyword);
        $only=$this->db->get('keyword')->result_array();
        if(empty($only)){
            echo true;
        }else{
            echo false;
        }
    }
    /**
     * 关键词类别列表
     *
     */
    public function category_list(){
        $url = base_url().'index.php/keywords_category/category_list?'; //导入分页类URL
        $keyword=$this->keyword_model->get_category_list("","");
        $count=count($keyword);
        $config=$this->page->page($url,$count);
        $this->pagination->initialize($config);      //初始化分类页
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $data['category']=$this->keyword_model->get_category_list($config['per_page'],$offset);
        //分页
        $data['pages']=$this->pagination->create_links();
        $this->load->view("keywords/keywords_category",$data);
    }
    /**
     * 关键词列表变更日志列表
     */
    public function update_category_log(){
        $url = base_url().'index.php/keywords_category/update_category_log?'; //导入分页类URL
        $keyword=$this->keyword_model->get_category_log("","");
        $count=count($keyword);
        $config=$this->page->page($url,$count);
        $this->pagination->initialize($config);      //初始化分类页
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $data['category_log']=$this->keyword_model->get_category_log($config['per_page'],$offset);
        //分页
        $data['pages']=$this->pagination->create_links();
        $this->load->view("keywords/update_category_log",$data);
    }

}