<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/28
 * Time: 9:18
 */
// ini_set("display_errors", "On");
// error_reporting(E_ALL | E_STRICT);
class Customer extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->user_model->is_login();
        $this->load->model('channel_model');
        $this->load->model('log_model');
        $this->load->helper('common_helper');
        $this->load->helper('form');
    }
    //跳转路径
    public function menulist()
    {
        // if ($this->uri->segment(3) === FALSE) {
        //     $product_id = 0;
        // } else {
        //     $product_id = $this->uri->segment(3);
        // }
        // @zzr edit at 2016-12-09 10:57
        $product_id = $this->uri->segment(3,0);

        if ($product_id == "cusMan") {
            $this->index();
        } else if ($product_id == "hx_cusMan") {
          $this->hx_cusMan();			
        } else if ($product_id == "add_customer") {
          $this->customer_add();
        } else if ($product_id == "hx_add_customer") {
          $this->hx_customer_add();		  
        }else if ($product_id == "myshare") {
            $this->load->view("myshare");
        }else if ($product_id == "threeRemind") {
            $this->load->view("threeRemind");
        }else if ($product_id == "tenRemind") {
            $this->load->view("tenRemind");
        }else if ($product_id == "con_customer") {
            $this->linkman();
        }else if ($product_id == "batch_customer") {
             $this->load->view("batch_customer");
        }else if($product_id == "public_customer"){
            $this->public_customer();
        }else if($product_id == "hx_public_customer"){
            $this->hx_public_customer();			
        }else if($product_id=="systemSettings"){
           $this->regression_public();
        }else if($product_id=="noassign_customer"){
           $this->noassign_customer();
        }else if($product_id=="will_customer"){
           $this->will_customer();
        }else if($product_id=="want_topublic"){
           $this->want_topublic();
        }
    }

    //我的客户
    public function index($repeat_customer)
    {
        $id=$_SESSION['user_id'];
        $status=$_GET['status']?$_GET['status']:"";
        $tag=$_GET['tag'];
        $url = base_url().'index.php/customer/menulist/cusMan?'; //导入分页类URL
        if($status){
            $url.="&status=".$_GET['status'];
        }
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        $linkType=$_GET['linkType'];
        if($linkType!=null){
            $url.="&linkType=".$_GET['linkType'];
        }
        //联系状态查询
        $linkDay=$_GET['linkDay'];
        if($linkDay!=null){
            $url.="&linkDay=".$_GET['linkDay'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType!=null){
            $url.="&sortType=".$_GET['sortType'];
        }
        //是否是公海
        $isPublic=$_GET['isPublic'];
        if($isPublic!=null){
            $url.="&isPublic=".$_GET['isPublic'];
        }
        //按时间段查询 开始时间
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        //结束时间
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }
        //重点客户
        $will_status=$_GET['will_status'];
        if($will_status<>""){
            $url.="&will_status=".$_GET['will_status'];
        }
        //签约客户
        $sign_status=$_GET['sign_status'];
        if($sign_status<>""){
            $url.="&sign_status=".$_GET['sign_status'];
        }
        // 搜索类型
        $type = $this->input->get('type');
        $sousuo_text = trim($_GET['sousuo_text']);
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==2){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==3){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==4){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==11){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==12){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }else{
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }
        }elseif(!empty($type)){
            $url.="&type=".$type;
        }
        //判断是否是主管
        $zhuguan=$_GET['zhuguan'];
        if($zhuguan!=null){
            $zhuguan=$this->user_model->is_zhuguan($id->id);
            $zhuguan=$zhuguan[0]['department_id'];
            $url.="&zhuguan=".$_GET['zhuguan'];
        }
        // @zzr edit at 2016-12-12 15:22 是不是售前客服
        $is_sq = $id->type == 5 ? true : false;
        $result=$this->customer_model->queryCustomer($id,"","",$linkType,$linkDay,$sortType,$status,
            $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguan,$will_status,$sign_status,false,false,$is_sq);
    
        if(count($result->result_array()) > 1){
            $count = count($result->result_array());
        }else{
            $count = $result->result_array()[0]['num'];
        }


        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页
        // @zzr edit at 2016-12-12 15:22 是不是售前客服
        $is_sq = $id->type == 5 ? true : false;
		//2017
        $result=$this->customer_model->queryCustomer_my($id,$config['per_page'],$offset,$linkType,
            $linkDay,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguan,
            $will_status,$sign_status,false,false,$is_sq);
        $customerData= $result->result();
         //echo $this->db->last_query();
        // die;
        //p($customerData);
        // die;

        $regionResult =$this->region->getList();
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $data['customer'][$k] = $v;
            
            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }

            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->customer_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];
        }
        $data['pages']=$this->pagination->create_links();
        $data['status']=$status;
        $data['tag']=$tag;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;
        if($repeat_customer){
            $data['repeat_customer']=$repeat_customer;
        }
        //重点客户
        $data['will_status']=$will_status;
        //签约客户
        $data['sign_status']=$sign_status;
        //权限
        $data['power']=$this->user_model->get_user_power($id->id);
        //意向客户数量
        $data['will_count']=$this->customer_model->will_count();
        //我的客户意向数量
        $data['my_will_count']=$this->customer_model->my_will_count($id->id);
        //售前客服显示
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();
        //所有部门
        $data['department_list']=$this->department_model->get_department_format();

        // 获取当前页url
        $_SESSION['cur_url'] = $_SERVER['REQUEST_URI'];

        $data['position']=$this->customer_model->get_position();

        // 客户来源渠道
        $data['all_channels'] = $this->channel_model->getall_channel_format();
        $this->load->view('customer/cusMan', $data);
    }
//2017
    public function hx_cusMan($repeat_customer)
    {
        $id=$_SESSION['user_id'];
        $status=$_GET['status']?$_GET['status']:"";
        $tag=$_GET['tag'];
        $url = base_url().'index.php/customer/menulist/cusMan?'; //导入分页类URL
        if($status){
            $url.="&status=".$_GET['status'];
        }
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        $linkType=$_GET['linkType'];
        if($linkType!=null){
            $url.="&linkType=".$_GET['linkType'];
        }
        //联系状态查询
        $linkDay=$_GET['linkDay'];
        if($linkDay!=null){
            $url.="&linkDay=".$_GET['linkDay'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType!=null){
            $url.="&sortType=".$_GET['sortType'];
        }
        //是否是公海
        $isPublic=$_GET['isPublic'];
        if($isPublic!=null){
            $url.="&isPublic=".$_GET['isPublic'];
        }
        //按时间段查询 开始时间
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        //结束时间
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }
        //重点客户
        $will_status=$_GET['will_status'];
        if($will_status<>""){
            $url.="&will_status=".$_GET['will_status'];
        }
        //签约客户
        $sign_status=$_GET['sign_status'];
        if($sign_status<>""){
            $url.="&sign_status=".$_GET['sign_status'];
        }
        // 搜索类型
        $type = $this->input->get('type');
        $sousuo_text = trim($_GET['sousuo_text']);
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==2){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==3){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==4){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==11){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==12){
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }else{
                $url.="&type=".$type."&sousuo_text=".trim($_GET['sousuo_text']);
            }
        }elseif(!empty($type)){
            $url.="&type=".$type;
        }
        //判断是否是主管
        $zhuguan=$_GET['zhuguan'];
        if($zhuguan!=null){
            $zhuguan=$this->user_model->is_zhuguan($id->id);
            $zhuguan=$zhuguan[0]['department_id'];
            $url.="&zhuguan=".$_GET['zhuguan'];
        }
        // @zzr edit at 2016-12-12 15:22 是不是售前客服
        $is_sq = $id->type == 5 ? true : false;
        $result=$this->customer_model->queryCustomer_hx($id,"","",$linkType,$linkDay,$sortType,$status,
            $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguan,$will_status,$sign_status,false,false,$is_sq);
    
        if(count($result->result_array()) > 1){
            $count = count($result->result_array());
        }else{
            $count = $result->result_array()[0]['num'];
        }


        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页
        // @zzr edit at 2016-12-12 15:22 是不是售前客服
        $is_sq = $id->type == 5 ? true : false;
		//2017
        $result=$this->customer_model->queryCustomer_hx($id,$config['per_page'],$offset,$linkType,
            $linkDay,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguan,
            $will_status,$sign_status,false,false,$is_sq);
        $customerData= $result->result();
         //echo $this->db->last_query();
        // die;
        //p($customerData);
        // die;

        $regionResult =$this->region->getList();
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $data['customer'][$k] = $v;
            
            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }

            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->customer_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];
        }
        $data['pages']=$this->pagination->create_links();
        $data['status']=$status;
        $data['tag']=$tag;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;
        if($repeat_customer){
            $data['repeat_customer']=$repeat_customer;
        }
        //重点客户
        $data['will_status']=$will_status;
        //签约客户
        $data['sign_status']=$sign_status;
        //权限
        $data['power']=$this->user_model->get_user_power($id->id);
        //意向客户数量
        $data['will_count']=$this->customer_model->will_count();
        //我的客户意向数量
        $data['my_will_count']=$this->customer_model->my_will_count($id->id);
        //售前客服显示
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();
        //所有部门
        $data['department_list']=$this->department_model->get_department_format();

        // 获取当前页url
        $_SESSION['cur_url'] = $_SERVER['REQUEST_URI'];

        $data['position']=$this->customer_model->get_position();

        // 客户来源渠道
        $data['all_channels'] = $this->channel_model->getall_channel_format();
        $this->load->view('customer/hx_cusMan', $data);
    }




    /**
     * [want_topublic 即将调入公海的客户]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-22T08:37:54+0800
     * @return   [type]                   [description]
     */
    public function want_topublic(){

        $id=$_SESSION['user_id'];
        $status=$_GET['status']?$_GET['status']:"";
        $tag=$_GET['tag'];
        $url = base_url().'index.php/customer/menulist/want_topublic?'; //导入分页类URL
        if($status){
            $url.="&status=".$_GET['status'];
        }
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        $linkType=$_GET['linkType'];
        if($linkType!=null){
            $url.="&linkType=".$_GET['linkType'];
        }
        //联系状态查询
        $linkDay=$_GET['linkDay'];
        if($linkDay!=null){
            $url.="&linkDay=".$_GET['linkDay'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType!=null){
            $url.="&sortType=".$_GET['sortType'];
        }
        //是否是公海
        $isPublic=$_GET['isPublic'];
        if($isPublic!=null){
            $url.="&isPublic=".$_GET['isPublic'];
        }
        //按时间段查询 开始时间
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        //结束时间
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }
        //重点客户
        $will_status=$_GET['will_status'];
        if($will_status<>""){
            $url.="&will_status=".$_GET['will_status'];
        }
        //签约客户
        $sign_status=$_GET['sign_status'];
        if($sign_status<>""){
            $url.="&sign_status=".$_GET['sign_status'];
        }
        $type=$_GET['type'];
        $sousuo_text=trim($_GET['sousuo_text']);
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$_GET['type']."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==2){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==3){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==4){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }
        }
        //判断是否是主管
        $zhuguan=$_GET['zhuguan'];
        if($zhuguan!=null){
            $zhuguan=$this->user_model->is_zhuguan($id->id);
            $zhuguan=$zhuguan[0]['department_id'];
            $url.="&zhuguan=".$_GET['zhuguan'];
        }


        // 复用的自动调入公海处的逻辑
        $syssettime = $this->db->get_where('system',array('id'=>1))->row_array();

        if(isset($syssettime['customer_time']) && intval($syssettime['customer_time']) > 5){ // >5 天为安全参数,防止误设置引起错误，5需手动设置
            $syschecktime = intval($syssettime['customer_time']); //单位天

            // 第一类客户 录入客户后无跟进记录&不在公海&录入时间大于系统设置检测天数&非签约用户&非重点客户&距上次检测时间久于系统设置时间
            $where = 'create_time<'.(time() - ($syschecktime-3)*86400).' AND create_time>'.(time() - $syschecktime*86400).' AND public_state=0 AND will_status=0 AND sign_status=0 AND follow_status=0 AND new_user_id='.$id->id;
            $this->db->where($where);
            $customer_cates1 = $this->db->limit(10000)->select('id')->get('customer')->result_array();
            // echo $this->db->last_query();die;
            $this_cusids = '';
            foreach($customer_cates1 as $cus_c1_val){
                $this_cusids = $this_cusids . $cus_c1_val['id'].',';
            }

            // 第二类客户 录入的客户有跟进记录,上次跟进时间距现在时间大于系统设置的检测时间
            $where = 'follower_id='.$id->id;
            $having_where = 'mtime<'.(time() - ($syschecktime-3)*86400).' AND mtime>'.(time() - $syschecktime*86400);
            $this->db->where($where);
            $this->db->group_by('customer_id');
            $this->db->having($having_where);
            // $this->db->order_by('time DESC');
            $customer_cates2 = $this->db->limit(10000)->select('id,customer_id,max(time) mtime')->get('follow_customer')->result_array();
            // echo $this->db->last_query();die;
            // p($customer_cates2);die;
            foreach($customer_cates2 as $cus_c2_val){
               $this_cusids = $this_cusids . $cus_c2_val['customer_id'].',';
            }
        }
        // 即将调入公海符合条件的客户ID
        $this_cusids = trim($this_cusids , ',');
        // p($this_cusids);die;

        // @zzr edit at 2016-12-12 15:22 是不是售前客服
        $is_sq = false;
        $result=$this->customer_model->queryCustomer($id,"","",$linkType,$linkDay,$sortType,$status,
            $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguan,$will_status,$sign_status,false,false,$is_sq,null,false,$this_cusids); // $this_cusids 为获取指定的客户id
        $count=$result->result_array()[0]['num'];
        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页
        // @zzr edit at 2016-12-12 15:22 是不是售前客服
        $result=$this->customer_model->queryCustomer($id,$config['per_page'],$offset,$linkType,
            $linkDay,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguan,
            $will_status,$sign_status,false,false,$is_sq,null,false,$this_cusids); // $this_cusids 为获取指定的客户id);
        $customerData= $result->result();

        // p($customerData);
        // die;

        $regionResult =$this->region->getList();
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $data['customer'][$k] = $v;
            
            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }

            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->customer_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];
        }
        $data['pages']=$this->pagination->create_links();
        $data['status']=$status;
        $data['tag']=$tag;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;
        if($repeat_customer){
            $data['repeat_customer']=$repeat_customer;
        }
        //重点客户
        $data['will_status']=$will_status;
        //签约客户
        $data['sign_status']=$sign_status;
        //权限
        $data['power']=$this->user_model->get_user_power($id->id);
        //意向客户数量
        $data['will_count']=$this->customer_model->will_count();
        //我的客户意向数量
        $data['my_will_count']=$this->customer_model->my_will_count($id->id);
        //售前客服显示
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();
        //所有部门
        $data['department_list']=$this->department_model->get_department_format();

        $this->load->view('customer/wanttopublic', $data);

    }


    //部门主管客户信息
    public function zhuguan_customer(){
        $id=$_SESSION['user_id'];
        // @zzr edit at 2016-12-08 17:30 
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();

        $status=$_GET['status']?$_GET['status']:"";
        $tag=$_GET['tag'];
        $url = base_url().'index.php/customer/zhuguan_customer?'; //导入分页类URL
        if($status){
            $url.="&status=".$_GET['status'];
        }
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        $linkType=$_GET['linkType'];
        if($linkType!=null){
            $url.="&linkType=".$_GET['linkType'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType!=null){
            $url.="&sortType=".$_GET['sortType'];
        }
        //查询该用户下的客户
        $user_chis = trim($_GET['user_chis']);
        if($user_chis != null){
            $url.="&user_chis=".$_GET['user_chis'];
            $user_info = $this->db->get_where('user',array('id'=>$user_chis))->row_array();
            if(!empty($user_info['type'])){
                $user_chis = $user_chis.'|'.$user_info['type'];
            }
            $user_info = $this->db->get_where('employee',array('user_id'=>$user_chis))->row_array();
            $data['user_chis_name'] = $user_info['name'];
        }
        //是否是公海
        $isPublic=$_GET['isPublic'];
        if($isPublic!=null){
            $url.="&isPublic=".$_GET['isPublic'];
        }
        //按时间段查询
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }

        //重点客户
        $will_status=$_GET['will_status'];
        if($will_status<>""){
            $url.="&will_status=".$_GET['will_status'];
        }
        //签约客户
        $sign_status=$_GET['sign_status'];
        if($sign_status<>""){
            $url.="&sign_status=".$_GET['sign_status'];
        }

        $type=$_GET['type'];
        $sousuo_text=trim($_GET['sousuo_text']);
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$_GET['type']."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==2){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==3){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==4){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }
        }
        //判断是否是主管
        $zhuguan=$_GET['zhuguan'];
        if($zhuguan!=null){
            if($zhuguan=='admin'){
                $zhuguan="admin";
                $url.="&zhuguan=".$_GET['zhuguan'];
                $zhuguans = $zhuguan;
            }else{
                $zhuguan=$this->user_model->is_zhuguan($id->id);
                $zhuguan=$zhuguan[0]['department_id'];
                $url.="&zhuguan=".$_GET['zhuguan'];


                $departments = $this->db->select('id,no,name')->get_where('department',array('no'=>$zhuguan))->result_array();
                if(!empty($departments)){
                    $zhuguans[] = $zhuguan;
                    foreach($departments as $dval){
                        if(!empty($dval['id'])){
                            $zhuguans[] = $dval['id'];    
                        }
                    }
                    $zhuguans = array_unique($zhuguans);
                }else{
                    $zhuguans = $zhuguan;
                }
                
            }
        }

        // @zzr edit at 2016-12-20 17:18是不是售前客服
        $is_sq = $id->type == 5 ? true : false;
        $result=$this->customer_model->queryCustomer($id,null,null,null,null,$sortType,$status, $tag,$type,$sousuo_text,
            $start_time,$end_time,$isPublic,$zhuguans,$will_status,$sign_status,false,false,$is_sq,null,true,null,$user_chis);

        if($sortType == 1){
            $count= count($result->result_array());
        }else{
            $count=$result->result_array()[0]['num'];    
        }

        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页
        $result=$this->customer_model->queryCustomer($id,$config['per_page'],$offset,null,
            null,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,
            $isPublic,$zhuguans,$will_status,$sign_status,false,false,$is_sq,null,true,null,$user_chis);
        $customerData= $result->result();
        $positionData = $this->customer_model->get_position();

        // echo $this->db->last_query();die;

        foreach ($positionData as $k => $v) {
            $positionResult[$v->id] = $v;
        }

        $regionResult =$this->region->getList();
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $v->linkman_job=$positionResult[$v->position_id]->name;
            $data['customer'][$k] = $v;

            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }

            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->customer_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];

        }
        //选中的重点客户
        $data['will_status']=$will_status;
        //选中的签约客户
        $data['sign_status']=$sign_status;
        //分页
        $data['pages']=$this->pagination->create_links();
        //选中的客户分类
        $data['status']=$status;
        //选中的标签
        $data['tag']=$tag;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;
        // @zzr edit at 2016-12-09 10:16
        //所有部门
        $data['department_list']=$this->department_model->get_department_format();
        //权限
        $data['power']=$this->user_model->get_user_power($id->id);
        // p($data['power']);
        // 当前用户主管的部门
        $channel_ids = '';
        $mydepartment = $this->db->get_where('division_manager',array('user_id'=>$id->id))->row_array();
        if(!empty($mydepartment['department_id'])){
            $data['chis_deparments'] = array();
            $channel_ids = $mydepartment['department_id'];
            $department = $this->db->get_where('department',array('id'=>$mydepartment['department_id']))->row_array();
            $data['chis_deparments'][] = $department;
            $chis_deparments = $this->db->get_where('department',array('no'=>$mydepartment['department_id']))->result_array();
            foreach($chis_deparments as $c_d_val){
                $data['chis_deparments'][] = $c_d_val;
                $channel_ids = $channel_ids . ',' . $c_d_val['id'];
            }
        }
        $data['channel_ids'] = $channel_ids;
        // $chids_user = $this->db->where('department_no in('.$channel_ids.')')->get('employee')->result_array();

        // $data['chids_user'] = $chids_user;
        // p($chids_user);die;
        
        $data['position']=$this->customer_model->get_position();
        
        //意向客户数量
        $data['will_count']=$this->customer_model->will_count();
        //我的客户意向数量
        $data['my_will_count']=$this->customer_model->my_will_count($id->id);

        $this->load->view("customer/customer_zhuguan",$data);
    }

    /**
     * [noassign_customer 售前客服录入的未指派客户]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-08T13:32:30+0800
     * @return   [type]                   [description]
     */
    public function noassign_customer(){

        $id=$_SESSION['user_id'];
        $status=$_GET['status']?$_GET['status']:"";
        $tag=$_GET['tag'];
        $url = base_url().'index.php/customer/menulist/noassign_customer?'; //导入分页类URL
        if($status){
            $url.="&status=".$_GET['status'];
        }
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        $linkType=$_GET['linkType'];
        if($linkType!=null){
            $url.="&linkType=".$_GET['linkType'];
        }
        //联系状态查询
        $linkDay=$_GET['linkDay'];
        if($linkDay!=null){
            $url.="&linkDay=".$_GET['linkDay'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType!=null){
            $url.="&sortType=".$_GET['sortType'];
        }
        //是否是公海
        $isPublic=$_GET['isPublic'];
        if($isPublic!=null){
            $url.="&isPublic=".$_GET['isPublic'];
        }
        //按时间段查询 开始时间
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        //结束时间
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }
        //重点客户
        $will_status=$_GET['will_status'];
        if($will_status<>""){
            $url.="&will_status=".$_GET['will_status'];
        }
        //签约客户
        $sign_status=$_GET['sign_status'];
        if($sign_status<>""){
            $url.="&sign_status=".$_GET['sign_status'];
        }
        $type=$_GET['type'];
        $sousuo_text=trim($_GET['sousuo_text']);
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$_GET['type']."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==2){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==3){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==4){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }
        }
        //判断是否是主管
        $zhuguan=$_GET['zhuguan'];
        if($zhuguan!=null){
            $zhuguan=$this->user_model->is_zhuguan($id->id);
            $zhuguan=$zhuguan[0]['department_id'];
            $url.="&zhuguan=".$_GET['zhuguan'];
        }

        // @zzr edit at 2016-12-21 17:02
        $is_sq = $id->type == 5 ? true : false;
        // @zzr edit at 2016-12-09 11:26
        $result=$this->customer_model->queryCustomer($id,"","",$linkType,$linkDay,$sortType,$status,
            $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguan,$will_status,$sign_status, null , true); // 最后一个参数为 true 为查询未指派客户条件

        $count=$result->result_array()[0]['num'];

        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页
        $result=$this->customer_model->queryCustomer($id,$config['per_page'],$offset,$linkType,
            $linkDay,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguan,
            $will_status,$sign_status, null , true); // 最后一个参数为 true 为查询未指派客户条件
        $customerData= $result->result();


        $regionResult =$this->region->getList();
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $data['customer'][$k] = $v;

            // @zzr edit at 2016-12-21 16:26
            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }
            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->customer_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];

        }
        $data['pages']=$this->pagination->create_links();
        $data['status']=$status;
        $data['tag']=$tag;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;
        if($repeat_customer){
            $data['repeat_customer']=$repeat_customer;
        }
        //重点客户
        $data['will_status']=$will_status;
        //签约客户
        $data['sign_status']=$sign_status;
        //权限
        $data['power']=$this->user_model->get_user_power($id->id);
        //意向客户数量
        $data['will_count']=$this->customer_model->will_count();
        //我的客户意向数量
        $data['my_will_count']=$this->customer_model->my_will_count($id->id);
        //售前客服显示
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();

        //所有部门
        $data['department_list']=$this->department_model->get_department_format();

        $this->load->view("customer/noascustomers",$data);
    }


    /**
     * [will_customer 重点客户]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-15T16:54:55+0800
     * @return   [type]                   [description]
     */
    public function will_customer(){
        
        $id=$_SESSION['user_id'];
        $status=$_GET['status']?$_GET['status']:"";
        $tag=$_GET['tag'];
        $url = base_url().'index.php/customer/menulist/will_customer?'; //导入分页类URL
        if($status){
            $url.="&status=".$_GET['status'];
        }
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        $linkType=$_GET['linkType'];
        if($linkType!=null){
            $url.="&linkType=".$_GET['linkType'];
        }
        //联系状态查询
        $linkDay=$_GET['linkDay'];
        if($linkDay!=null){
            $url.="&linkDay=".$_GET['linkDay'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType!=null){
            $url.="&sortType=".$_GET['sortType'];
        }
        //是否是公海
        $isPublic=$_GET['isPublic'];
        if($isPublic!=null){
            $url.="&isPublic=".$_GET['isPublic'];
        }
        //按时间段查询 开始时间
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        //结束时间
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }
        //重点客户
        $will_status = $this->input->get('will_status');
        if($will_status<>""){
            $url.="&will_status=".$_GET['will_status'];
        }
        //签约客户
        $sign_status=$_GET['sign_status'];
        if($sign_status<>""){
            $url.="&sign_status=".$_GET['sign_status'];
        }
        $type=$_GET['type'];
        $sousuo_text=trim($_GET['sousuo_text']);
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$_GET['type']."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==2){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==3){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==4){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }
        }
        //判断是否是主管
        $zhuguan = $this->input->get('zhuguan');
        if($zhuguan!=null){
            if($zhuguan=='admin'){
                $zhuguan="admin";
                $url.="&zhuguan=".$_GET['zhuguan'];
                $zhuguans = $zhuguan;
            }else{
                $zhuguan=$this->user_model->is_zhuguan($id->id);
                $zhuguan=$zhuguan[0]['department_id'];
                $url.="&zhuguan=".$_GET['zhuguan'];

                $departments = $this->db->select('id,no,name')->get_where('department',array('no'=>$zhuguan))->result_array();
                if(!empty($departments)){
                    $zhuguans[] = $zhuguan;
                    foreach($departments as $dval){
                        if(!empty($dval['id'])){
                            $zhuguans[] = $dval['id'];    
                        }
                    }
                    $zhuguans = array_unique($zhuguans);
                }else{
                    $zhuguans = $zhuguan;
                }
            }
        }
        // @zzr edit at 2016-12-20 16:30是不是售前客服
        $is_sq = $id->type == 5 ? true : false;
        // @zzr edit at 2016-12-09 11:26
        $result=$this->customer_model->queryCustomer($id,"","",$linkType,$linkDay,$sortType,$status,
            $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguans,$will_status,$sign_status, null , false , $is_sq); // 最后一个参数为 true 为查询未指派客户条件

        if($sortType == 1){
            $count= count($result->result_array());
        }else{
            $count=$result->result_array()[0]['num'];    
        }

        // p($count);die;

        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页
        $result=$this->customer_model->queryCustomer($id,$config['per_page'],$offset,$linkType,
            $linkDay,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,$zhuguans,
            $will_status,$sign_status, null , false, $is_sq); // 最后一个参数为 true 为查询未指派客户条件
        $customerData= $result->result();


        $regionResult =$this->region->getList();
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $data['customer'][$k] = $v;

            // @zzr edit at 2016-12-21 16:26
            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }

            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->customer_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];

        }
        $data['pages']=$this->pagination->create_links();
        $data['status']=$status;
        $data['tag']=$tag;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;
        if($repeat_customer){
            $data['repeat_customer']=$repeat_customer;
        }
        //重点客户
        $data['will_status']=$will_status;
        //签约客户
        $data['sign_status']=$sign_status;
        //权限
        $data['power']=$this->user_model->get_user_power($id->id);
        //意向客户数量
        $data['will_count']=$this->customer_model->will_count();
        //我的客户意向数量
        $data['my_will_count']=$this->customer_model->my_will_count($id->id);
        //售前客服显示
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();

        //所有部门
        $data['department_list']=$this->department_model->get_department_format();

        // 获取当前页url
        $_SESSION['cur_url'] = $_SERVER['REQUEST_URI'];


        $data['position']=$this->customer_model->get_position();

        $this->load->view("customer/willcustomer",$data);
    }


    //客户详情
    public function customer_details(){
        $id=$_GET['id'];
        $this->db->where('id',$id);
        $data['customer']=$this->db->get('customer')->result_array();
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        $this->load->view('customer/cus_details',$data);
    }
    //公海客户
    public function public_customer()
    {
        $id=$_SESSION['user_id'];
        $tag=$this->input->get('tag');
        $status = $_GET['status'] ? $this->input->get('status') : "";
        $chids = $_GET['chids'] ? $this->input->get('chids') : "";
        $url = base_url().'index.php/customer/menulist/public_customer?'; //导入分页类URL
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        if($status){
            $url.="&status=".$_GET['status'];
        }
        $linkType=$_GET['linkType'];
        if($linkType){
            $url.="&linkType=".$_GET['linkType'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType){
            $url.="&sortType=".$_GET['sortType'];
        }
        //是否是公海
        $isPublic=$_GET['isPublic'];
        if($isPublic){
            $url.="&isPublic=".$_GET['isPublic'];
        }
        //按时间段查询
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }
        $type=$_GET['type'];
        $sousuo_text=trim($_GET['sousuo_text']);
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$_GET['type']."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==2){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==3){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==4){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==10){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }
        }
		//2017
        //if($type == 10 && empty($sousuo_text)){
        //    $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
        //}
        //$department=$this->db->get('department')->result();
		//$department = $this->department_model->get_department_format();
        $result=$this->customer_model->queryCustomer_sea(null,null,null,null,null,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,false,"","",false,false,false,$chids);
        //2017
		// @zzr edit at 2016-12-20 14:56
        if($sortType == 11){ //用于添加到公海客户降序
            $count = count($result->result_array());
        }else{
            $count = $result->result_array()[0]['num'];
        }
        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页

        
        $result=$this->customer_model->queryCustomer_sea("",$config['per_page'],$offset,null,
            null,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,false,"","",false,false,false,$chids);
        $data['customer']= $result->result();
        $customerData= $result->result();

        // echo $this->db->last_query();
        // die;		
		
		
        $positionData = $this->customer_model->get_position();
		
        foreach ($positionData as $k => $v) {
            $positionResult[$v->id] = $v;
        }

        $regionResult =$this->region->getList();
		
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $v->linkman_job=$positionResult[$v->position_id]->name;
            $data['customer'][$k] = $v;

             // @zzr edit at 2016-12-21 16:26
            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }

            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->customer_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];

        }
        //标签
        $this->db->where('user_id',1);
        $result=$this->db->get('user_label');
        $data['label']=$result->result();
        $data['pages']=$this->pagination->create_links();
        $data['status'] = $status;
        $data['chids'] = $chids;
        $data['tag'] = $tag;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;

        //售前客服显示
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();

        // 客户来源渠道
        $data['all_channels'] = $this->channel_model->getall_channel_format();

        $this->load->view('customer/public_customer', $data);
    }
 

    public function hx_public_customer()
    {
		//echo 3333;die();
        $id=$_SESSION['user_id'];
        $tag=$this->input->get('tag');
        $status = $_GET['status'] ? $this->input->get('status') : "";
        $chids = $_GET['chids'] ? $this->input->get('chids') : "";
        $url = base_url().'index.php/customer/menulist/public_customer?'; //导入分页类URL
        //标签查询
        if(isset($tag)&&$tag!=""){
            $url.="&tag=".$_GET['tag'];
        }
        if($status){
            $url.="&status=".$_GET['status'];
        }
        $linkType=$_GET['linkType'];
        if($linkType){
            $url.="&linkType=".$_GET['linkType'];
        }
        //排序
        $sortType=$_GET['sortType'];
        if($sortType){
            $url.="&sortType=".$_GET['sortType'];
        }
        //是否是公海
        $isPublic=$_GET['isPublic'];
        if($isPublic){
            $url.="&isPublic=".$_GET['isPublic'];
        }
        //按时间段查询
        $start_time=$_GET['start_time'];
        if($start_time){
            $url.="&start_time=".$_GET['start_time'];
        }
        $end_time=$_GET['end_time'];
        if($end_time){
            $url.="&end_time=".$_GET['end_time'];
        }
        $type=$_GET['type'];
        $sousuo_text=trim($_GET['sousuo_text']);
        if($type&&$sousuo_text){
            if($type==1){
                $url.="&type=".$_GET['type']."&sousuo_text=".trim($_GET['sousuo_text']);
            }elseif($type==2){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==3){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==4){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }elseif($type==10){
                $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
            }
        }
        if($type == 10 && empty($sousuo_text)){
            $url.="&type=".$_GET['type']."&sousuo_text".trim($_GET['sousuo_text']);
        }

        $result=$this->customer_model->queryCustomer_sea_hx(null,null,null,null,null,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,false,"","",false,false,false,$chids);
        // @zzr edit at 2016-12-20 14:56
        if($sortType == 11){ //用于添加到公海客户降序
            $count = count($result->result_array());
        }else{
            $count = $result->result_array()[0]['num'];
        }
        //分页
        $config=$this->page->page($url,$count);
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        $this->pagination->initialize($config);      //初始化分类页

        
        $result=$this->customer_model->queryCustomer_sea_hx("",$config['per_page'],$offset,null,
            null,$sortType,$status, $tag,$type,$sousuo_text,$start_time,$end_time,$isPublic,false,"","",false,false,false,$chids);
        $data['customer']= $result->result();
        $customerData= $result->result();

         //echo $this->db->last_query();
        // die;		
		
		
        $positionData = $this->customer_model->get_position();
		
        foreach ($positionData as $k => $v) {
            $positionResult[$v->id] = $v;
        }

        $regionResult =$this->region->getList();
		
        foreach ($customerData as $k => $v) {
            $v->province_no = $regionResult[$v->province_no]['region_name'];
            $v->city_no = $regionResult[$v->city_no]['region_name'];
            $v->county_no = $regionResult[$v->county_no]['region_name'];
            $v->linkman_job=$positionResult[$v->position_id]->name;
            $data['customer'][$k] = $v;

             // @zzr edit at 2016-12-21 16:26
            // 获取客户来源渠道信息
            $channel_str = '' ;
            if(!empty($v->channel_id)){
                $channel_ids[] = $v->channel_id;
                if(!empty($v->channel_id_2)){
                    $channel_ids[] = $v->channel_id_2;
                }
                if(!empty($v->channel_id_3)){
                    $channel_ids[] = $v->channel_id_3;
                }
                $channel_info = $this->db->select('id,channel_name')->where_in('id',$channel_ids)->get('channel')->result_array();
                
                foreach($channel_info as $cival){
                    $channel_str = $channel_str . $cival['channel_name'].'&nbsp;/&nbsp';
                }
                $data['customer'][$k]->channel_str = trim($channel_str,'/&nbsp;');
                unset($channel_ids);

                if($is_sq){
                    $user_info = $this->db->select('name')->get_where('employee',array('user_id'=>$v->new_user_id))->row_array();
                    $data['customer'][$k]->new_user_name = $user_info['name'];
                }
            }

            // 获取客户最新跟进记录
            $last_follow = $this->db->select('time,content')->order_by('time DESC')->get_where('follow_customer',array('customer_id'=>$v->customer_id))->row_array();
            $data['customer'][$k]->last_follow_time = empty($last_follow['time']) ? '' : date('Y-m-d H:i',$last_follow['time']);
            $data['customer'][$k]->last_follow_content = empty($last_follow['content']) ? '-' : $last_follow['content'];

        }
        //标签
        $this->db->where('user_id',1);
        $result=$this->db->get('user_label');
        $data['label']=$result->result();
        $data['pages']=$this->pagination->create_links();
        $data['status'] = $status;
        $data['chids'] = $chids;
        $data['tag'] = $tag;
        //标签
        $result=$this->my_tags_model->get_tags();
        $data['label']=$result->result();
        //排序
        $data['sortType']=$_GET['sortType'];
        //查询条件
        $data['type']=$type;
        $data['sousuo_text']=$sousuo_text;

        //售前客服显示
        $this->db->where('id',$id->id);
        $data['is_custom_service']=$this->db->get('user')->result_array();

        // 客户来源渠道
        $data['all_channels'] = $this->channel_model->getall_channel_format();

        $this->load->view('customer/hx_public_customer', $data);
    }
 


 //放入公海
    public function in_public_customer(){
        // $id=$_GET['cus_id'];
        // @zzr 2016-12-09 21:06
        $id = $this->input->get('cus_id');
        $user_id=$_SESSION['user_id'];        

        //日志添加
        $result=$this->log_model->customer_operation_log($id,1,$user_id->id,null);
        if($result){
            $this->db->where_in('id',$id);
            $this->db->update('customer',array("public_state"=>1,'new_user_id'=>0));
            redirect("customer/menulist/cusMan");
        }
    }
 //放入会销公海
    public function hx_in_public_customer(){
        // $id=$_GET['cus_id'];
        // @zzr 2016-12-09 21:06
        $id = $this->input->get('cus_id');
        $user_id=$_SESSION['user_id'];        

        //日志添加
        $result=$this->log_model->customer_operation_log($id,1,$user_id->id,null);
        if($result){
            $this->db->where_in('id',$id);
            $this->db->update('customer',array("public_state"=>1,'new_user_id'=>0));
            redirect("customer/menulist/hx_cusMan");
        }
    }	
    //捡回到我的客户
    public function out_public_customer(){
    $id=$_GET['cus_id'];
    $id=explode(",",$id);
    $id=array_filter($id);
    $user_id=$_SESSION['user_id'];
    if($id){
        foreach($id as $k=>$v){
            //查询放入公海的员工
            $this->db->select('user_id');
            $this->db->where('customer_id',$v);
            $this->db->where('change_type',1);
            $this->db->order_by('add_time desc');
            $this->db->limit(1);
            $cus_change=$this->db->get('customer_change')->result_array();
            if($cus_change[0]['user_id']){
                //日志添加
                $result=$this->log_model->customer_operation_log($v,0,$cus_change[0]['user_id'],$user_id->id);
            }else{
                $result=$this->log_model->customer_operation_log($v,0,$user_id->id,$user_id->id);
            }
            if($result){
                //修改状态
                $this->db->where('id',$v);
                if(intval($v) > 0){
                    $this->db->update('customer',array("public_state"=>0,'new_user_id'=>$user_id->id,'syschecktime'=>time()));

                    // @zzr edit at 2016-12-15 10:52
                    // 捡回客户后如果有跟进记录则更新最后一条跟进记录的系统检测时间
                    $this->db->where('customer_id',$v);
                    $this->db->order_by('time','DESC');
                    $this->db->update('follow_customer',array('syschecktime'=>time()));
                }
               
            }
        }
        redirect("customer/public_customer?isPublic=1");
    }
}
 
    //捡回到我的客户
    public function hx_out_public_customer(){
    $id=$_GET['cus_id'];
    $id=explode(",",$id);
    $id=array_filter($id);
    $user_id=$_SESSION['user_id'];
    if($id){
        foreach($id as $k=>$v){
            //查询放入公海的员工
            $this->db->select('user_id');
            $this->db->where('customer_id',$v);
            $this->db->where('change_type',1);
            $this->db->order_by('add_time desc');
            $this->db->limit(1);
            $cus_change=$this->db->get('customer_change')->result_array();
            if($cus_change[0]['user_id']){
                //日志添加
                $result=$this->log_model->customer_operation_log($v,0,$cus_change[0]['user_id'],$user_id->id);
            }else{
                $result=$this->log_model->customer_operation_log($v,0,$user_id->id,$user_id->id);
            }
            if($result){
                //修改状态
                $this->db->where('id',$v);
                if(intval($v) > 0){
                    $this->db->update('customer',array("public_state"=>0,'new_user_id'=>$user_id->id,'syschecktime'=>time()));

                    // @zzr edit at 2016-12-15 10:52
                    // 捡回客户后如果有跟进记录则更新最后一条跟进记录的系统检测时间
                    $this->db->where('customer_id',$v);
                    $this->db->order_by('time','DESC');
                    $this->db->update('follow_customer',array('syschecktime'=>time()));
                }
               
            }
        }
        redirect("customer/hx_public_customer?isPublic=1");
    }
}
 

 //弹出框捡入客户
    public function ajax_out_public(){
            $cus_id = trim($this->input->post('cus_id'));
            $user_id=$_SESSION['user_id'];
            if($cus_id){
                    $this->db->where('id',$cus_id);
                    $cus=$this->db->get('customer')->result_array();
                    //查询放入公海的员工
                    $this->db->select('user_id');
                    $this->db->where('customer_id',$cus_id);
                    $this->db->where('change_type',1);
                    $this->db->order_by('add_time desc');
                    $this->db->limit(1);
                    $cus_change=$this->db->get('customer_change')->result_array();
                if($cus_change[0]['user_id']){
                    //日志添加
                    $result=$this->log_model->customer_operation_log($cus_id,0,$cus_change[0]['user_id'],$user_id->id);
                }else{
                    $result=$this->log_model->customer_operation_log($cus_id,0,$user_id->id,$user_id->id);
                }
                if($result){
                    $this->db->where_in('id',$cus_id);
                    $result=$this->db->update('customer',array("public_state"=>0,'new_user_id'=>$user_id->id,'syschecktime'=>time()));
                    if($result){
                        echo "true";
                    }
                }
        }
    }
    //添加客户联系人
    public function linkman(){


        $name = $this->input->post('ladd_name');
        $ladd_mobile = $this->input->post('ladd_mobile');
        if(empty($name)){
            echo json_encode(array('s'=>'err','msg'=>"联系人姓名不能为空"));
            exit();
        }
        if(empty($ladd_mobile)){
            echo json_encode(array('s'=>'err','msg'=>"联系人手机号不能为空"));
            exit();
        }


        $data=array(
                'customer_id'=>$this->input->post('customer_id'),
                'name'=>$this->input->post('ladd_name'),
                'mobile'=>$this->input->post('ladd_mobile'),
                'qq'=>$this->input->post('ladd_qq'),
                'wechat'=>$this->input->post('ladd_wechat'),
                'email'=>$this->input->post('ladd_email'),
                'remark'=>$this->input->post('ladd_remark'),
                'position_id'=>$this->input->post('ladd_position_id'),
                'status'=>1
            );


        $this->db->where('mobile',$ladd_mobile);
        $linkman=$this->db->get('linkman')->result_array();

        if(!empty($linkman)){
            echo json_encode(array('s'=>'err','msg'=>"该手机号的客户联系人已存在"));
            exit();
        }
        $result = $this->db->insert('linkman',$data);
        if($result){
            $this->db->cache_delete_all();
            echo json_encode(array('s'=>'ok','msg'=>"添加客户联系人成功"));
        }

        // @zzr edit at 2017-01-12 17:03
        exit();

        
        // 以下是之前的方法
        //客户id
        if(!$this->input->post('name')){
            $data['position']=$this->customer_model->get_position();
            $data['cus_id'] = $this->uri->segment(3);


            $customerinfo = $this->db->get_where('customer',array('id'=>$data['cus_id']))->row_array();
            // p($customerinfo);
            $data['cus_name'] = $customerinfo['name'];

            $this->load->view('linkman/con_customer',$data);
        }else{
            if($this->input->post('name')){
                $data=array(
                    'customer_id'=>$this->input->post('cus_id'),
                    'name'=>$this->input->post('name'),
                    'mobile'=>$this->input->post('mobile'),
                    'qq'=>$this->input->post('qq'),
                    'wechat'=>$this->input->post('wechat'),
                    'email'=>$this->input->post('email'),
                    'job'=>$this->input->post('job'),
                    'remark'=>$this->input->post('remark'),
                    'position_id'=>$this->input->post('position_id'),
                    'status'=>1,
                );




                $this->db->where('mobile',$this->input->post('mobile'));
                // $this->db->or_where('name',$this->input->post('name'));
                $linkman=$this->db->get('linkman')->result_array();

                if(!empty($linkman)){
                    redirect("customer/index");
                }
                $result = $this->db->insert('linkman',$data);
                if($result){
                    $this->db->cache_delete_all();
                    redirect("customer/customer_details?&id=".$this->input->post('cus_id')."");
                }
            }
        }
    }

    //修改联系人
    public function update_linkman(){

        $name = $this->input->post('ladd_name');
        $link_id = $this->input->post('link_id');
        $ladd_mobile = $this->input->post('ladd_mobile');
         if(empty($link_id)){
            echo json_encode(array('s'=>'err','msg'=>"数据出错"));
            exit();
        }
        if(empty($name)){
            echo json_encode(array('s'=>'err','msg'=>"联系人姓名不能为空"));
            exit();
        }
        if(empty($ladd_mobile)){
            echo json_encode(array('s'=>'err','msg'=>"联系人手机号不能为空"));
            exit();
        }

        $customer_id = $this->input->post('customer_id');

        $data=array(
            'name'=>$this->input->post('ladd_name'),
            'mobile'=>$this->input->post('ladd_mobile'),
            'qq'=>$this->input->post('ladd_qq'),
            'wechat'=>$this->input->post('ladd_wechat'),
            'email'=>$this->input->post('ladd_email'),
            'remark'=>$this->input->post('ladd_remark'),
            'position_id'=>$this->input->post('ladd_position_id')
        );
        //添加日志
        $id=$_SESSION['user_id'];
        $this->log_model->update_linkman_log($customer_id,$link_id,$id->id,$this->input->post('ladd_name'),$this->input->post('ladd_mobile'));
        $this->db->where('id',$_POST['link_id']);
        $result=$this->db->update('linkman',$data);
        if($result){
            $this->db->cache_delete_all();
            echo json_encode(array('s'=>'ok','msg'=>"保存成功"));
        }else{
            echo json_encode(array('s'=>'err','msg'=>"编辑联系人失败"));
        }
        exit();






        // 以下是之前的方法
        $link_id=$_GET['link_id'];
        if(!$this->input->post('name')){
            $this->db->where('id',$link_id);
            $data['linkman']=$this->db->get('linkman')->result_array();
            $data['position']=$this->customer_model->get_position();
            $this->load->view('linkman/update_linkman',$data);
        }else{
            $data=array(
                'customer_id'=>$this->input->post('cus_id'),
                'name'=>$this->input->post('name'),
                'mobile'=>$this->input->post('mobile'),
                'qq'=>$this->input->post('qq'),
                'wechat'=>$this->input->post('wechat'),
                'email'=>$this->input->post('email'),
                'job'=>$this->input->post('job'),
                'remark'=>$this->input->post('remark'),
                'position_id'=>$this->input->post('position_id'),
            );
            //添加日志
            $id=$_SESSION['user_id'];
            $this->log_model->update_linkman_log($this->input->post('cus_id'),$_POST['link_id'],$id->id,$this->input->post('name'),$this->input->post('mobile'));
            $this->db->where('id',$_POST['link_id']);
            $result=$this->db->update('linkman',$data);
            if($result){
                $this->db->cache_delete_all();
                redirect("customer/customer_details?&id=".$this->input->post('cus_id')."");
            }
        }
    }
    //录入客户
    public function customer_add()
    {
        //录入人
        $id=$_SESSION['user_id'];

        if(!$_POST['name']){
            $province_no=$_POST['province_no'];
            if($province_no){
                $this->region->ajax_region($province_no);
            }
            $city_no=$_POST['city_no'];
            if($city_no){
                $this->region->ajax_county($city_no);
            }
            $this->db->where("user_id",$id->id);
            $this->db->where("is_default",1);
            $query=$this->db->get("keyword")->result();
            $data['keyword']=$query[0]->keyword;
            $data['position']=$this->customer_model->get_position();
            $data['keyword_id']=$query[0]->id;
            //售前客服显示
            $this->db->where('id',$id->id);
            $data['is_custom_service']=$this->db->get('user')->result_array();
            //渠道列表
            // $data['channel_list']= $this->channel_model->get_channel();
            // @zzr edit at 2016-12-07 14:33 获取顶级客户来源渠道
            $data['channel_list']= $this->channel_model->get_channel_bypid(0);
            if($id->type == 5){ // 售前客服
                $sq_add = $this->channel_model->get_channel_bychname('推广渠道');
                if(!empty($sq_add['id'])){
                    $sq_add_id = $sq_add['id'];
                }else{
                    $sq_add_id = 21; // 动态获取失败时,该值需要根据所在环境推广渠道分类id来手动设置,
                }
            }else{ // 其他角色默认销售录入
                $sq_add = $this->channel_model->get_channel_bychname('销售录入');
                if(!empty($sq_add['id'])){
                    $sq_add_id = $sq_add['id'];
                }else{
                    $sq_add_id = 20; // 动态获取失败时,该值需要根据所在环境销售录入分类id来手动设置
                }
            }

            $data['channel_list_2'] = $this->channel_model->get_channel_bypid($sq_add_id);


            //所有部门
            $data['department_list']=$this->department_model->get_department_format();

            // 客户来源渠道
            $data['all_channels'] = $this->channel_model->getall_channel_format(21);

            $this->load->view("customer/add_customer",$data);
        }else{

            //关键词
            $key_id = $this->input->post('keyword_id');
            $linkman_name = $this->input->post('linkman');
            $qq = $this->input->post('qq');
            $email = $this->input->post('email');
            $tel = $this->input->post('tel');


            // 插入客户
            $linkman_id = $this->db->insert('linkman',array("name"=>$linkman_name,'is_default'=>1,'cus_tel'=>$tel,'qq'=>$qq,'email'=>$email,'mobile'=>$_POST['mobile'],'status'=>1,'position_id'=>$_POST['position_id']));
            if($linkman_id){
                $linkman_id = $this->db->insert_id();
            }

            $data=array(
                'keyword_id'=>$key_id,
                'no'=>rand(0000,9999),
                'name'      =>$this->input->post('name'),
                'corporate_name'=>$this->input->post('corporate_name'),//法人
                'creator'=>$id->id,//录入人
                'create_time'=>time(), //录入时间
                'linkman_id'=>$linkman_id,
                'province_no'=>$this->input->post('province_no'),
                'bd_ranking'=>$this->input->post('bd_ranking'),
                'city_no'=>$this->input->post('city_no'),
                'county_no'=>$this->input->post('county_no'),
                'status'=>-1,//客户状态
                'cus_content'=>$this->input->post('content')
            );
            //售前客服-before
            // if($_POST['channel_id']!=0||$_POST['extend_xml']!=null){
            //     $data['channel_id']=$_POST['channel_id'];
            //     $data['extend_status']=$_POST['extend_xml'];
            //     $data['custom_service']=$id->id;
            // }

            // @zzr edit at 2016-12-07 14:06
            // user type=5 为售前客服标识
            if($id->type == 5){
                // $data['extend_status']  = $this->input->post('extend_xml');
                $data['extend_status']  = 1; // 是否来自推广渠道标识
                $data['custom_service'] = $id->id;
                $data['new_user_id']    = $id->id; // 售前客服录入的客户所有人默认为售前客服本身
            }elseif($id->type != 5 && $this->input->post('channel_id') == 21){ // 21为推广渠道编号，当前环境数据录不对应需手动设置
                $custom_service = $this->db->get_where('division_manager',array('department_id'=>23))->row_array(); // 23为售前客服用户类别编号,当前环境数据录不对应需手动设置
                if(!empty($custom_service['user_id'])){
                    $data['custom_service'] = $custom_service['user_id'];
                }else{ // 没有设置售前客服主管
                    $data['custom_service'] = 0;
                }
                $data['extend_status']  = 1; // 是否来自推广渠道标识
                $data['new_user_id']    = $id->id; 
            }else{ // 其他默认为销售录入
                $data['extend_status']  = 0; // 是否来自推广渠道标识
                $data['custom_service'] = 0;
                $data['new_user_id']    = $id->id;
            }
            // 新增客户来源渠道分类
            $data['channel_id']     = $this->input->post('channel_id'); // 前一版本已存在,先保留
            $data['channel_id_1']   = empty($_POST['channel_id']) ? 0 : $this->input->post('channel_id');
            $data['channel_id_2']   = empty($_POST['channel_id_2']) ? 0 : $this->input->post('channel_id_2');
            $data['channel_id_3']   = empty($_POST['channel_id_3']) ? 0 : $this->input->post('channel_id_3');

            $new_user_id_val = isset($_POST['new_user_id_val']) ? trim($this->input->post('new_user_id_val')) : '';
            if(!empty($new_user_id_val)){
                $data['new_user_id'] = $new_user_id_val;
            }

            // 客户预算
            $budget = isset($_POST['budget']) ? trim($this->input->post('budget')) : 0;
            if(!empty($budget)){
                $data['budget'] = $budget;   
            }
            

            $this->db->where('user.id',$id->id);
            $this->db->join('user',"user.id=employee.user_id");
            $user_name=$this->db->get('employee')->result_array();
            $data['department_no']=$user_name[0]['department_no'];
            $result=$this->db->insert("customer",$data);

            $customer_id=$this->db->insert_id();
            if($result){

                // @zzr edit at 2016-12-21 11:41 售前客户录入客户时进行了指派
                if(!empty($new_user_id_val) && $id->type == 5){

                    //添加变更日志
                    $user_id = $new_user_id_val; // 指定人
                    $cus_id = $customer_id; // 客户编号
                    //客户
                    $this->db->where("id",$cus_id);
                    $cus = $this->db->get("customer")->result_array();

                    //主客服
                    $this->db->where("user.id",$id->id);
                    $this->db->join("employee e" ," e.user_id=user.id");
                    $custom_service=$this->db->get("user")->result_array();

                    //指定人
                    $this->db->where("user.id",$user_id);
                    $this->db->join("employee e" ,"e.user_id=user.id");
                    $sale_user=$this->db->get("user")->result_array();

                    //插入日志
                    $data=array(
                        "customer_id"=>$cus_id,
                        "add_time"=>time(),
                        "user_id"=>$_SESSION['user_id']->id,
                        "change_type"=>2,
                        "change_text"=>"".$custom_service[0]['name']."客服把".$cus[0]['name']."客户指派给".$sale_user[0]['name']."销售",
                        "cus_from" =>$custom_service[0]['name'],
                        "cus_to" =>$sale_user[0]['name'],
                    );

                    $result=$this->db->insert("customer_change",$data);
                    if($result){
                        $this->db->where("id",$cus_id);
                        $this->db->update("customer",array("new_user_id"=>$user_id));
                    }
                }

                $this->db->where('id',$linkman_id);
                $linkman=$this->db->update('linkman',array('customer_id'=>$customer_id));
                if($linkman){
                    // 清除所有缓存文件
                    $this->db->cache_delete_all();
                    redirect("customer/menulist/add_customer");
                }
            }
        }
    }

	
    //录入会销客户
    public function hx_customer_add()
    {
        //录入人
        $id=$_SESSION['user_id'];

        if(!$_POST['name']){
            $province_no=$_POST['province_no'];
            if($province_no){
                $this->region->ajax_region($province_no);
            }
            $city_no=$_POST['city_no'];
            if($city_no){
                $this->region->ajax_county($city_no);
            }
            $this->db->where("user_id",$id->id);
            $this->db->where("is_default",1);
            $query=$this->db->get("keyword")->result();
            $data['keyword']=$query[0]->keyword;
            $data['position']=$this->customer_model->get_position();
            $data['keyword_id']=$query[0]->id;
            //售前客服显示
            $this->db->where('id',$id->id);
            $data['is_custom_service']=$this->db->get('user')->result_array();
            //渠道列表
            // $data['channel_list']= $this->channel_model->get_channel();
            // @zzr edit at 2016-12-07 14:33 获取顶级客户来源渠道
            $data['channel_list']= $this->channel_model->get_channel_bypid(0);
            if($id->type == 5){ // 售前客服
                $sq_add = $this->channel_model->get_channel_bychname('推广渠道');
                if(!empty($sq_add['id'])){
                    $sq_add_id = $sq_add['id'];
                }else{
                    $sq_add_id = 21; // 动态获取失败时,该值需要根据所在环境推广渠道分类id来手动设置,
                }
            }else{ // 其他角色默认销售录入
                $sq_add = $this->channel_model->get_channel_bychname('销售录入');
                if(!empty($sq_add['id'])){
                    $sq_add_id = $sq_add['id'];
                }else{
                    $sq_add_id = 20; // 动态获取失败时,该值需要根据所在环境销售录入分类id来手动设置
                }
            }

            $data['channel_list_2'] = $this->channel_model->get_channel_bypid($sq_add_id);


            //所有部门
            $data['department_list']=$this->department_model->get_department_format();

            // 客户来源渠道
            $data['all_channels'] = $this->channel_model->getall_channel_format(21);

            $this->load->view("customer/hx_add_customer",$data);
        }else{

            //关键词
            $key_id = $this->input->post('keyword_id');
            $linkman_name = $this->input->post('linkman');
            $qq = $this->input->post('qq');
            $email = $this->input->post('email');
            $tel = $this->input->post('tel');


            // 插入客户
            $linkman_id = $this->db->insert('linkman',array("name"=>$linkman_name,'is_default'=>1,'cus_tel'=>$tel,'qq'=>$qq,'email'=>$email,'mobile'=>$_POST['mobile'],'status'=>1,'position_id'=>$_POST['position_id']));
            if($linkman_id){
                $linkman_id = $this->db->insert_id();
            }

            $data=array(
                'keyword_id'=>$key_id,
                'no'=>rand(0000,9999),
                'name'      =>$this->input->post('name'),
                'corporate_name'=>$this->input->post('corporate_name'),//法人
                'creator'=>$id->id,//录入人
                'create_time'=>time(), //录入时间
                'linkman_id'=>$linkman_id,
                'province_no'=>$this->input->post('province_no'),
                'bd_ranking'=>$this->input->post('bd_ranking'),
                'city_no'=>$this->input->post('city_no'),
                'county_no'=>$this->input->post('county_no'),
                'status'=>-1,//客户状态
                'cus_content'=>$this->input->post('content')
            );
            //售前客服-before
            // if($_POST['channel_id']!=0||$_POST['extend_xml']!=null){
            //     $data['channel_id']=$_POST['channel_id'];
            //     $data['extend_status']=$_POST['extend_xml'];
            //     $data['custom_service']=$id->id;
            // }

            // @zzr edit at 2016-12-07 14:06
            // user type=5 为售前客服标识
            if($id->type == 5){
                // $data['extend_status']  = $this->input->post('extend_xml');
                $data['extend_status']  = 1; // 是否来自推广渠道标识
                $data['custom_service'] = $id->id;
                $data['new_user_id']    = $id->id; // 售前客服录入的客户所有人默认为售前客服本身
            }elseif($id->type != 5 && $this->input->post('channel_id') == 21){ // 21为推广渠道编号，当前环境数据录不对应需手动设置
                $custom_service = $this->db->get_where('division_manager',array('department_id'=>23))->row_array(); // 23为售前客服用户类别编号,当前环境数据录不对应需手动设置
                if(!empty($custom_service['user_id'])){
                    $data['custom_service'] = $custom_service['user_id'];
                }else{ // 没有设置售前客服主管
                    $data['custom_service'] = 0;
                }
                $data['extend_status']  = 1; // 是否来自推广渠道标识
                $data['new_user_id']    = $id->id; 
            }else{ // 其他默认为销售录入
                $data['extend_status']  = 0; // 是否来自推广渠道标识
                $data['custom_service'] = 0;
                $data['new_user_id']    = $id->id;
            }
            // 新增客户来源渠道分类
            $data['channel_id']     = $this->input->post('channel_id'); // 前一版本已存在,先保留
            $data['channel_id_1']   = empty($_POST['channel_id']) ? 0 : $this->input->post('channel_id');
            $data['channel_id_2']   = empty($_POST['channel_id_2']) ? 0 : $this->input->post('channel_id_2');
            $data['channel_id_3']   = empty($_POST['channel_id_3']) ? 0 : $this->input->post('channel_id_3');

            $new_user_id_val = isset($_POST['new_user_id_val']) ? trim($this->input->post('new_user_id_val')) : '';
            if(!empty($new_user_id_val)){
                $data['new_user_id'] = $new_user_id_val;
            }

            // 客户预算
            $budget = isset($_POST['budget']) ? trim($this->input->post('budget')) : 0;
            if(!empty($budget)){
                $data['budget'] = $budget;   
            }
            

            $this->db->where('user.id',$id->id);
            $this->db->join('user',"user.id=employee.user_id");
            $user_name=$this->db->get('employee')->result_array();
            $data['department_no']=$user_name[0]['department_no'];
			//2017
			$data['is_huixiao']="1";
            $result=$this->db->insert("customer",$data);

            $customer_id=$this->db->insert_id();
            if($result){

                // @zzr edit at 2016-12-21 11:41 售前客户录入客户时进行了指派
                if(!empty($new_user_id_val) && $id->type == 5){

                    //添加变更日志
                    $user_id = $new_user_id_val; // 指定人
                    $cus_id = $customer_id; // 客户编号
                    //客户
                    $this->db->where("id",$cus_id);
                    $cus = $this->db->get("customer")->result_array();

                    //主客服
                    $this->db->where("user.id",$id->id);
                    $this->db->join("employee e" ," e.user_id=user.id");
                    $custom_service=$this->db->get("user")->result_array();

                    //指定人
                    $this->db->where("user.id",$user_id);
                    $this->db->join("employee e" ,"e.user_id=user.id");
                    $sale_user=$this->db->get("user")->result_array();

                    //插入日志
                    $data=array(
                        "customer_id"=>$cus_id,
                        "add_time"=>time(),
                        "user_id"=>$_SESSION['user_id']->id,
                        "change_type"=>2,
                        "change_text"=>"".$custom_service[0]['name']."客服把".$cus[0]['name']."客户指派给".$sale_user[0]['name']."销售",
                        "cus_from" =>$custom_service[0]['name'],
                        "cus_to" =>$sale_user[0]['name'],
                    );

                    $result=$this->db->insert("customer_change",$data);
                    if($result){
                        $this->db->where("id",$cus_id);
                        $this->db->update("customer",array("new_user_id"=>$user_id));
                    }
                }

                $this->db->where('id',$linkman_id);
                $linkman=$this->db->update('linkman',array('customer_id'=>$customer_id));
                if($linkman){
                    // 清除所有缓存文件
                    $this->db->cache_delete_all();
                    redirect("customer/menulist/hx_add_customer");
                }
            }
        }
    }
	
	

    /**
     * [get_ch_channels 获取下级来源分类]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-08T09:51:21+0800
     * @return   [type]                   [json数组]
     */
    public function get_ch_channels(){

        if($this->input->is_ajax_request()){
            $pid = $this->input->post('pid');
            $level = $this->input->post('level');

            echo json_encode(array('s'=>'ok','chsdata'=>$this->channel_model->get_channel_bypid($pid),'level'=>$level));
            exit();
        }
    }

    /**
     * [customer_status 查询客户是否有所有人]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-09T08:47:00+0800
     * @return   [type]                   [description]
     */
    public function customer_status(){
        if($this->input->is_ajax_request()){
           $customer_id = $this->input->post('customer_id');
           $customer_info = $this->db->get_where('customer',array('id'=>$customer_id))->row_array();
           // 客户没在公海、客户已被销售人员所有
           if(isset($customer_info['new_user_id']) && $customer_info['public_state'] !=1 && $customer_info['new_user_id'] != 0 && $customer_info['new_user_id'] != $customer_info['custom_service']){
                echo 0;
                exit();
           }else{
                echo 1;
                exit();
           }
        }
    }


    //客户添加时手机的唯一性查询
    public function ajax_mobile(){
        $mobile = trim($this->input->post('mobile'));
        $id = trim($this->input->post('id'));;
        if($mobile){
            $result=$this->customer_model->verifyNewCustomer("",$mobile,$id);
            if($result){
                echo json_encode($result);
            }else{
                echo 'n';
            }
        }
    }
    //企业名称唯一性查询
    public function ajax_name(){
        $name = trim($this->input->post('name'));
        $id=$_POST['id'];
        if($name){
            $result=$this->customer_model->verifyNewCustomer($name,"",$id);
            if($result){
                echo json_encode($result);
            }else{
                echo 'n';
            }
        }
    }
    //默认值推广词更换
    public function keyword_update(){
        $id=$_SESSION['user_id'];
        $keyword=$_POST['keyword'];
        $this->db->where('user_id',$id->id);
        $query=$this->db->get("keyword")->result();
        if($query){
            $this->db->where('user_id',$id->id);
            $this->db->update("keyword",array("is_default"=>0));
        }
        $result=$this->db->insert('keyword',array("keyword"=>$keyword,"is_default"=>1,"user_id"=>$id->id));
        if($result){
            $key_id=$this->db->insert_id();
        }
        echo $key_id;
    }
    //异步查询当前用户的所有联系人
    public function ajax_linkman(){
        $cus_id=$_POST['customer_id']?$_POST['customer_id']:0;
        $public=$_POST['public'];
        $str=$this->customer_model->linkman_cus($cus_id,$public);
        echo $str;exit;
    }
    // 获取某个联系人的信息
    public function ajax_linkman_info(){
        $link_id = $this->input->post('link_id');

        $linkman = $this->db->get_where('linkman',array('id'=>$link_id))->row_array();
        if(!empty($linkman)){
            echo json_encode(array('s'=>'ok','linkman'=>$linkman));
        }else{
            echo json_encode(array('s'=>'err','msg'=>'未获取到数据'));
        }
        exit();
    }

    //客户详情信息
    public function customer_info(){
        $cus_id=$_POST['customer_id']?$_POST['customer_id']:0;
        $public=$_POST['public'];
        $str=$this->customer_model->customer_info($cus_id,$public);
        echo $str;exit;
    }
    //客户状态
    public function status_cus(){
        $cus_id=$_POST['customer_id']?$_POST['customer_id']:0;
        $this->db->where('id',$cus_id);
        $cus=$this->db->get('customer')->result();
        $status=$cus[0]->status;
        echo $status;
    }
    //修改客户分类
    public function update_status(){
        $this->db->cache_delete_all();
        $id=$_POST['id'];
        $status=$_POST['status1'];
        $this->db->where('id',$id);
        $result=$this->db->update('customer',array("status"=>$status));
        if($result){
            echo "true";
        }else{
            echo "false";
        }
    }

    /**
     * [update_followstage 更新跟进阶段]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-23T08:39:28+0800
     * @return   [type]                   [description]
     */
    public function update_followstage(){
        $this->db->cache_delete_all();
        $id=$_POST['id'];
        $status=$_POST['status1'];
        $this->db->where('id',$id);
        $result=$this->db->update('customer',array("followstage"=>$status));
        if($result){
            echo "true";
        }else{
            echo "false";
        }
    }



    public function  cus_tag_id(){
        $id=$_POST['id'];
        $user_id=$_SESSION['user_id'];
        $user_id=$user_id->id;
        $query=$this->my_tags_model->get_cus_tags($user_id,$id);
      echo json_encode($query);
    }
    //新增客户标签
    public function insert_cusTags(){

        $tags=$_POST['tags'];
        $id=$_POST['id'];
        $this->db->where("cus_id",$id);
        $state=$this->db->delete("custom_tag");
        if($state){
            $tags=explode(",",$tags);
            foreach($tags as $k=>$v){
                $state=$this->db->insert("custom_tag",array("cus_id"=>$id,"tag_id"=>$v));
            }
            if($state){
                echo "true";
            }else{
                echo "false";
            }
        }
    }
    //显示客户的标签
    public function cus_tag(){
        $this->db->cache_delete_all();
        $id=$_POST['customer_id'];
        $user_id=$_SESSION['user_id'];
        $user_id=$user_id->id;
        $query=$this->my_tags_model->get_cus_tags($user_id,$id);
        $str="";
        foreach($query as $k=>$v){
            $str.=' <span>'.$v['tag'].'</span>';
        }
        echo $str;exit;
    }
    //修改客户
    public function customer_update()
    {
        $this->db->cache_delete_all();
        $id=$_SESSION['user_id'];

        if($this->input->post('name'))
        {
            $cus_id=$_POST['cus_id'];
            //关键词
            $key=$_POST['keyword'];
            if($_POST['keyword_id']){
                $keyword_id=$_POST['keyword_id'];
                $this->db->where('id',$_POST['keyword_id']);
                $this->db->update('keyword',array("keyword"=>$key,'is_default'=>1));
            }else{
                $result=$this->db->insert('keyword',array("keyword"=>$key,'is_default'=>1));
                if($result){
                    $keyword_id=$this->db->insert_id();
                }
            }
//            $customer=$this->db->query('select *,c.`name` as cname,l.name as lname from nb_customer c left join nb_linkman l on  c.linkman_id=l.id where c.id='.$cus_id)->result_array();
//            $this->db->where('user.id',$id->id);
//            $this->db->join('user',"user.id=employee.user_id");
//            $user_name=$this->db->get('employee')->result_array();
//            if($customer[0]['mobile']!=$_POST['mobile']){
//                $mobile_data=array(
//                    'cus_id'=>$cus_id,
//                    'user_id'=>$id->id,
//                    'add_time'=>time(),
//                    'cus_from'=>$customer[0]['mobile'],
//                    'cus_to'=>$_POST['mobile'],
//                );
//                $mobile_data['text_log']=$user_name[0]['name']."修改了".$customer[0]['cname']."客户的默认手机号,从".$customer[0]['mobile']."修改成".$_POST['mobile']."";
//                $this->db->insert('customer_log',$mobile_data);
//            }
            if($_POST['linkman_id']){
                $linkman_id=$_POST['linkman_id'];
                $linkman_name=$_POST['linkman'];
                $qq=$_POST['qq'];
                $email=$_POST['email'];
                $this->db->where('id',$_POST['linkman_id']);
                $this->db->update('linkman',array("name"=>$linkman_name,'is_default'=>1,'qq'=>$qq,'email'=>$email,'mobile'=>$_POST['mobile'],'status'=>1,'position_id'=>$_POST['position_id']));
            }else{
                $linkman_name=$_POST['linkman'];
                $qq=$_POST['qq'];
                $email=$_POST['email'];
                $result=$this->db->insert('linkman',array("name"=>$linkman_name,'URL'=>$_POST['URL'],'is_default'=>1,'qq'=>$qq,'email'=>$email,'mobile'=>$_POST['mobile'],'status'=>1,'position_id'=>$_POST['position_id']));
                if($result){
                    $linkman_id=$this->db->insert_id();
                }
            }

            $data=array(
                'keyword_id'=>$keyword_id,
                'no'=>$_POST['no'],
                'name'      =>$_POST['name'],
                'corporate_name'=>$_POST['corporate_name'],
                'creator'=>$id->id,//录入人
                'create_time'=>$_POST['create_time'], //录入时间
                'linkman_id'=>$linkman_id,
                'province_no'=>$_POST['province_no'],
                'city_no'=>$_POST['city_no'],
                'county_no'=>$_POST['county_no'],
                'address'=>$_POST['address'],
                'bd_ranking'=>$_POST['bd_ranking'],
                'status'=>$_POST['status'],//客户状态
                'cus_content'=>$_POST['cus_content'],
                'channel_id'=>empty($_POST['channel_id']) ? 0 : $this->input->post('channel_id'),
                // 'extend_status'=>$_POST['extend_xml'],
            );

            $data['channel_id_1']   = empty($_POST['channel_id']) ? 0 : $this->input->post('channel_id');
            $data['channel_id_2']   = empty($_POST['channel_id_2']) ? 0 : $this->input->post('channel_id_2');
            $data['channel_id_3']   = empty($_POST['channel_id_3']) ? 0 : $this->input->post('channel_id_3');


            if($_POST['province_no']==''){
                $customer=$this->db->select("*")->from("customer")->where("id",$cus_id)->get()->result();
                $data['province_no']= $customer[0]->province_no;
                $data['city_no']= $customer[0]->city_no;
                $data['county_no']= $customer[0]->county_no;
            }
            //日志变更添加
            $this->log_model->update_customer_log($cus_id,$id->id,$_POST['name'],$_POST['mobile']);
            $this->db->where("id",$cus_id);
            $result=$this->db->update('customer',$data);
            if($result){
                if(!empty($_SESSION['cur_url'])){
                    $cur_url = str_replace('/index.php/', '', $_SESSION['cur_url']); 
                    unset($_SESSION['cur_url']);
                    redirect($cur_url);   
                }else{
                    redirect("customer/menulist/cusMan");    
                }
            }
        }else{
            $cus_id=$this->uri->segment(3);
            $data['cus_id']=$cus_id;
            $data['customer']=$this->db->select("*,l.name as lname,customer.name as cname,customer.cus_content,customer.status as sta")->from("customer")->join('linkman l','l.customer_id=customer.id','left')->where("l.customer_id",$cus_id)->where('l.is_default',1)->get()->result();
            foreach($data['customer'] as  $k=>$v){
                $linkman=$this->linkman_model->get_linkman($v->linkman_id,$v->cus_id);
                $data['customer'][$k]->linkman_name=$linkman[0]->lname;
                $data['customer'][$k]->linkman_mobile=$linkman[0]->mobile;
                $data['customer'][$k]->linkman_qq=$linkman[0]->qq;
                $data['customer'][$k]->linkman_email=$linkman[0]->email;
                if($v->province_no){
                    $this->db->where('region_code',$v->province_no);
                    $this->db->or_where('region_code',$v->city_no);
                    $this->db->or_where('region_code',$v->county_no);
                    $result=$this->db->get('region');
                    $region=$result->result();
                    $v->province_no=$region[0]->region_name;
                    $v->city_no=$region[1]->region_name;
                    $v->county_no=$region[2]->region_name;
                }
            }
            $this->db->where("id",$data['customer'][0]->keyword_id);
            $this->db->select("*");
            $result=$this->db->get('keyword');
            $data['keyword']=$result->result();
            $province_no=$_POST['province_no'];
            if($province_no){
                $this->region->ajax_region($province_no);
            }
            $city_no=$_POST['city_no'];
            if($city_no){
                $this->region->ajax_county($city_no);
            }
            $data['position']=$this->customer_model->get_position();
            //售前客服显示
            $this->db->where('id',$id->id);
            $data['is_custom_service']=$this->db->get('user')->result_array();

            if($data['is_custom_service'][0]['type'] == 5 || $data['is_custom_service'][0]['id'] == 1){
                $data['sel_disabled'] = '';
            }else{
                $data['sel_disabled'] = 'disabled="disabled"';
            }

            //渠道列表
            // $data['channel_list']= $this->channel_model->get_channel();
            // @zzr edit at 2016-12-07 14:33 获取顶级客户来源渠道
            $data['channel_list']= $this->channel_model->get_channel_bypid(0);
            if($id->type == 5){ // 售前客服
                $sq_add = $this->channel_model->get_channel_bychname('推广渠道');
                if(!empty($sq_add['id'])){
                    $sq_add_id = $sq_add['id'];
                }else{
                    $sq_add_id = 21; // 动态获取失败时,该值需要根据所在环境推广渠道分类id来手动设置,
                }
            }else{ // 其他角色默认销售录入
                $sq_add = $this->channel_model->get_channel_bychname('销售录入');
                if(!empty($sq_add['id'])){
                    $sq_add_id = $sq_add['id'];
                }else{
                    $sq_add_id = 20; // 动态获取失败时,该值需要根据所在环境销售录入分类id来手动设置
                }
            }

            $data['channel_list_2'] = $this->channel_model->get_channel_bypid($sq_add_id);

            $this->load->view("customer/update_customer",$data);
        }
    }
    //批量添加客户
    public function batch_add_customer(){
        $this->db->cache_delete_all();
        $id=$_SESSION['user_id'];
        $name=$this->input->post('name');
        $company_name=$this->input->post('company_name');
        $corporate_name= $this->input->post('corporate_name');
        $mobile=$this->input->post('mobile');
        foreach($name as $k=>$v){
            $data[$k]=array(
                "creator"=>$id->id,
                'is_company'=>1,
                'create_time'=>time(),
                'company_name'=>$company_name[$k],
                'corporate_name'=>$corporate_name[$k],
                'mobile'=>$mobile[$k],
                'name'=>$name[$k],
                'full_spell'=>'0',
                'short_spell' =>'0',
                'status'=>1,
                'keyword_id'=>1,
            );
            $this->db->where('user.id',$id->id);
            $this->db->join('user',"user.id=employee.user_id");
            $user_name=$this->db->get('employee')->result_array();
            $data['department_no']=$user_name[0]['department_no'];
            $this->db->insert('customer',$data[$k]);
        }
        redirect("customer/menulist/cusMan");
    }
//导出客户
    public function excel_out()
    {
        $id=$_SESSION['user_id'];
        $this->db->select("*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,e.name as ename,customer.province_no,customer.city_no,customer.county_no,customer.address");
        $this->db->join("user u","customer.creator=u.id");
        $this->db->join("employee e","e.user_id=u.id");
        $this->db->order_by('create_time asc');
        $this->db ->where("customer.creator",$id->id);
        $query=$this->db->get('customer');
        if(!$query){
            return false;
        }
        $data['customer']= $query->result();
        foreach($data['customer'] as  $k=>$v){
            $linkman=$this->linkman_model->get_linkman($v->linkman_id,$v->cus_id);
            $data['customer'][$k]->linkman_name=$linkman[0]->lname;
            $data['customer'][$k]->linkman_mobile=$linkman[0]->mobile;
            $data['customer'][$k]->linkman_job=$linkman[0]->cpname;
            $data['customer'][$k]->linkman_URL=$linkman[0]->URL;
            //获取关键词
            $keyword=$this->keyword_model->get_keyword($v->keyword_id);
            $v->keyword=$keyword[0]->keyword;
            if($v->province_no){
                $this->db->where('region_code',$v->province_no);
                $this->db->or_where('region_code',$v->city_no);
                $this->db->or_where('region_code',$v->county_no);
                $result=$this->db->get('region');
                $region=$result->result();
                $v->province_no=$region[0]->region_name;
                $v->city_no=$region[1]->region_name;
                $v->county_no=$region[2]->region_name;
            }
        }
        require_once dirname(dirname(__FILE__)) . '/libraries/PHPExcel.php';
        require_once dirname(dirname(__FILE__)) . '/libraries/PHPExcel/IOFactory.php';
        $PHPExcel = new PHPExcel();
        //填入表头
        $PHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '公司名称');
        $PHPExcel->setActiveSheetIndex(0)->setCellValue('B1', '联系人');
        $PHPExcel->setActiveSheetIndex(0)->setCellValue('C1', '手机');
        $PHPExcel->setActiveSheetIndex(0)->setCellValue('D1', '页数');
        $PHPExcel->setActiveSheetIndex(0)->setCellValue('E1', '法人');
        $PHPExcel->setActiveSheetIndex(0)->setCellValue('F1', '推广词');
        $PHPExcel->setActiveSheetIndex(0)->setCellValue('G1', '备注');

        $k = 1;
        foreach ($query->result() as $key => $value) {
            $k++;
            $PHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($key+2), $value->cname." ");
            if( $value->linkman_name){
                $PHPExcel->setActiveSheetIndex(0)->setCellValue('B'.($key+2), $value->linkman_name." ");
            }else{
                $PHPExcel->setActiveSheetIndex(0)->setCellValue('B'.($key+4), '未知');
            }
            $PHPExcel->setActiveSheetIndex(0)->setCellValue('C'.($key+2), $value->linkman_mobile." ");
            $PHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($key+2),$value->bd_ranking);
            $PHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($key+2), $value->corporate_name);
            $keyword_id=$value->keyword_id;
            $this->db->where('id',$keyword_id);
            $query=$this->db->get('keyword')->result();
            $PHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($key+2), $query[0]->keyword);
            $PHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($key+2), $value->cus_content );
            $PHPExcel->setActiveSheetIndex(0)->getRowDimension($key+2)->setRowHeight(30);
        }



        //设置单元格宽度
        $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);


//        $PHPExcel->getActiveSheet()->getStyle('A4:AE'.($k+2))->getFont()->setSize(10);
        //设置居中
        $PHPExcel->getActiveSheet()->getStyle('A1:AE'.($k+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //所有垂直居中
        $PHPExcel->getActiveSheet()->getStyle('A1:AE'.($k+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //设置单元格边框
        $PHPExcel->getActiveSheet()->getStyle('A1:AE'.($k))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //设置自动换行
        $PHPExcel->getActiveSheet()->getStyle('A3:AE'.($k+2))->getAlignment()->setWrapText(true);
        $PHPExcel->setActiveSheetIndex(0);
        $objWriter = IOFactory::createWriter($PHPExcel, 'Excel5');
        //发送标题强制用户下载文件
        header('Content-Type: application/vnd.ms-excel');
        //多浏览器下兼容中文标题
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $excel_name = $this->input->post("excel_name");
        if (preg_match("/MSIE/", $ua)) {
            header('Content-Disposition: attachment; filename="Shedong_' . $excel_name . '.xls"');
        } else if (preg_match("/Firefox/", $ua)) {
            header('Content-Disposition: attachment; filename*="utf8\'\'Shedong_' . $excel_name . '.xls"');
        } else {
            header('Content-Disposition: attachment; filename="Shedong_' . $excel_name . '.xls"');
        }
        header('Content-Disposition: attachment;filename="Shedong_'.$excel_name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

    //导入客户
    public function excel_in()
    {   
        $this->db->cache_delete_all();
        //获取上传的文件名
        $filename = $_FILES['filename']['name'];

        //上传到服务器上的临时文件名
        $tmp_name = $_FILES['filename']['tmp_name'];
        header("Content-Type:text/html;Charset=utf-8");
        $filePath = dirname(dirname(dirname(__FILE__))) . '/uploadfiles/file';
        $str = "";
        require_once dirname(dirname(__FILE__)) . '/libraries/PHPExcel.php';
        require_once dirname(dirname(__FILE__)) . '/libraries/PHPExcel/IOFactory.php';
        require_once dirname(dirname(__FILE__)) . '/libraries/PHPExcel/Reader/Excel5.php';
        require_once dirname(dirname(__FILE__)) . '/libraries/PHPExcel/Reader/Excel2007.php';
        $filename = explode(".", $filename);//把上传的文件名以“.”好为准做一个数组。
        $time = date("y-m-d-H-i-s");//去当前上传的时间
        $filename[0] = $time;//取文件名t替换
        $name = implode(".", $filename); //上传后的文件名
        $uploadfile = $filePath . $name;//上传后的文件名地址
        $result = move_uploaded_file($tmp_name, $uploadfile);//假如上传到当前目录下

        if ($result) {
            if($filename[1]=="xlsx"){
                $objReader = IOFactory::createReader('Excel2007');
            }else{
                $objReader = IOFactory::createReader('Excel5');
            }

            if ($objReader) {
                $objPHPExcel = $objReader->load($uploadfile);
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow(); // 取得总行数
                $highestColumn = $sheet->getHighestColumn(); // 取得总列数
                //循环读取excel文件,读取一条,插入一条
                for ($j = 2; $j <= $highestRow; $j++) {
                    for ($k = 'A'; $k <= $highestColumn; $k++) {
                        $str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                    }
                    //explode:函数把字符串分割为数组。
                    $strs = explode("\\", $str);


                    $this->db->select("*,customer.name as cname,l.mobile as lmobile");
                    // $this->db->where('customer.name',$strs[0]);
                    $this->db->join('linkman l',"l.customer_id=customer.id");
                    $this->db->where('l.mobile',$strs[2]);
                    $result=$this->db->get('customer')->result_array();
                    if(!$result){

                        // $cus_content = $strs[6];

                        // $keyword=$strs[6];
                        // $this->db->where('keyword',$keyword);
                        // $result=$this->db->get('keyword')->result();
                        $id = $_SESSION['user_id'];
                        // if(!$result){
                        //     $key= $this->db->insert('keyword',array("keyword"=>$keyword,"is_default"=>0,"user_id"=>$id->id));
                        //     if($key){
                        //         $keyword_id=$this->db->insert_id();
                        //     }
                        // }else{
                        //     $keyword_id=$result[0]->id;
                        // }
                        
                        if(empty($strs[1]) || empty($strs[2])){
                            continue;
                        }

                        $result=$this->db->insert('linkman',array("name"=>$strs[1],"mobile"=>$strs[2],"is_default"=>1,"position_id"=>1));
                        if($result){
                            $link_man_id=$this->db->insert_id();
                        }else{
                            $link_man_id=0;
                        }
                        $this->db->where('user.id',$id->id);
                        $this->db->join('user',"user.id=employee.user_id");
                        $user_name=$this->db->get('employee')->result_array();

                        $channelinfo = $this->db->get_where('channel',array('channel_name'=>$strs[5]))->row_array();

                        if(empty($channelinfo)){
                            $channel_tmp_id = 20;
                        }else{
                            $channel_tmp_id = $channelinfo['id'];
                        }

                        $part_channels = $this->channel_model->get_parchannel_bychid($channel_tmp_id);
                        
                        $channel_id = isset($part_channels[0]) ? $part_channels[0] : 20; 

                        if($channel_id == 21){ // 推广客户

                            if($id->type == 5){
                                $custom_service = $id->id;
                            }else{
                                $custom_service = 79;
                            }

                        }else{
                            $custom_service = 0;
                        }
                        
                        $data = array(
                            "no" => rand(0000,9999),
                            "name" => !empty($strs[0]) ? $strs[0] : '导入客户'.rand(10000,99999),
                            // "bd_ranking" => $strs[3],
                            "bd_ranking" => 0,
                            "corporate_name" => $strs[4],
                            "cus_content" => $strs[6],
                            "creator" => $id->id,
                            'linkman_id'=>$link_man_id,
                            "create_time" => time(),
                            // "keyword_id"=>$keyword_id,
                            'channel_id'=>$channel_id,
                            'channel_id_1'=>isset($part_channels[0]) ? $part_channels[0] : 20,
                            'channel_id_2'=>isset($part_channels[1]) ? $part_channels[1] : 0,
                            'channel_id_3'=>isset($part_channels[2]) ? $part_channels[2] : 0,
                            "status"=>-1,
                            'extend_status'=> $channel_id == 21 ? 1 : 0,
                            'custom_service'=> $custom_service,
                            'new_user_id'=>$id->id
                        );
                        $data['department_no']=$user_name[0]['department_no'];
                        $result = $this->db->insert("customer", $data);
                        $customer_id=$this->db->insert_id();
                        $this->db->where('id',$link_man_id);
                        $this->db->update("linkman",array("customer_id"=>$customer_id));
                        if (!$result) {
                            return false;
                        }
                    }else{
                        foreach($result as $k=>$v){
                            $repeat_customer[]=$v;
                        }
                    }
                    $str = "";
                }
            }
            unlink($uploadfile); //删除上传的excel文件
            // if($repeat_customer){
            //     $this->index($repeat_customer);
            //     return;
            // }
            redirect("users");
        }
    }
    //设置签约客户
    public function set_sign(){
        $user_id=$_SESSION['user_id'];
        // $id=$_POST['cus_id'];
        // 
        $id = $this->input->post('cus_id');
        $sign_val = $this->input->post('sign_val','intval');

        if(empty($sign_val)){
            // echo json_encode(array('s'=>'error','msg'=>'请设置签约金额'));
            // exit();
            $sign_val = 0;
        }

        // if(intval($sign_val) == 0){
        //     echo json_encode(array('s'=>'error','msg'=>'请输入正确的签约金额'));
        //     exit();
        // }

        $this->db->where('id',$id);
        $result=$this->db->update('customer',array('sign_status'=>1,'sign_val'=>$sign_val,'sign_time'=>time()));


        //签约客户增加日志
        $data=
            array("cus_id"=>$id,
                "user_id"=>$user_id->id,
                "add_time"=>time(),
                "type_log"=>3
                );
        //用户
        $this->db->select("e.name as ename");
        $this->db->where("user.id",$user_id->id);
        $this->db->join('employee e'," e.user_id=user.id","left");
        $user=$this->db->get("user")->result_array();
        //客户
        $this->db->where("id",$id);
        $customer=$this->db->get("customer")->result_array();
        $data['text_log']="".$user[0]['ename']."把客户".$customer[0]['name']."设置成签约客户";
        $data['cus_from']=$user[0]['ename'];
        $data['cus_to']=$customer[0]['name'];
        $this->db->insert('customer_log',$data);
        if($result){
            echo json_encode(array('s'=>'ok','msg'=>''));
            exit();
        }else{
            echo json_encode(array('s'=>'error','msg'=>'设置失败，请重试！'));
            exit();
        }
    }

    /**
     * [get_yday_chinfo 获取昨天来源渠道统计数据]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-23T11:48:30+0800
     * @return   [type]                   [description]
     */
    public function get_yday_chinfo(){
        $yesterday=strtotime(date('Y-m-d',strtotime("-1 day")));
        $today=strtotime(date('Y-m-d'));

        // 以人或部门为单位
        $user_id = $this->input->post('user_id');
        $department_id = $this->input->post('department_id');
        // $this->db->select("*");
        // $channels=$this->db->get('channel')->result_array();

        $channels = $this->channel_model->getall_channel_format(21,false);


        foreach($channels as $chkey => $chval){

            if($chval['level'] == 1){
                // 新录入
                if($user_id > 0){
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND department_no='.$department_id;
                }else{
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today;    
                }
                
                $new_add = $this->db->select('count(id) addcount')->where($where)->get('customer')->row_array();
                $channels[$chkey]['newadd_num'] = $new_add['addcount'];

                // 签单数量
                if($user_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'].' AND custom_service='.$user_id; 
                }elseif($department_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'].' AND department_no='.$department_id;
                }else{
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'];
                }

                $sign_customers = $this->db->select('count(id) signcount,sum(sign_val) signval')->where($where)->get('customer')->row_array();
                $channels[$chkey]['signcount'] = $sign_customers['signcount'];
                $channels[$chkey]['signval'] = empty($sign_customers['signval']) ? 0 : $sign_customers['signval'];


                // 跟进数量
                if($user_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'].' AND c.custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'].' AND c.department_no='.$department_id;
                }else{
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'];
                }

                $this->db->join('customer c','c.id=follow_customer.customer_id','left');
                $this->db->group_by('customer_id');
                $follow_num = $this->db->select('count(customer_id) followcount')->where($where)->get('follow_customer')->result_array();
                if(count($follow_num) > 1){
                    $channels[$chkey]['followcount'] = count($follow_num);
                }else{
                    $channels[$chkey]['followcount'] = empty($follow_num[0]['followcount']) ? 0 : $follow_num[0]['followcount'];    
                }

                // if(!empty($follow_num)){
                //     echo $this->db->last_query();
                //     p($follow_num);
                // }
                
            }

            if($chval['level'] == 2){
                // 新录入
                if($user_id > 0){
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND department_no='.$department_id;
                }else{
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today;    
                }
                
                $new_add = $this->db->select('count(id) addcount')->where($where)->get('customer')->row_array();

                $channels[$chkey]['newadd_num'] = $new_add['addcount'];

                // 签单数量
                if($user_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'].' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'].' AND department_no='.$department_id; 
                }else{
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'];    
                }
                
                $sign_customers = $this->db->select('count(id) signcount,sum(sign_val) signval')->where($where)->get('customer')->row_array();
                $channels[$chkey]['signcount'] = $sign_customers['signcount'];
                $channels[$chkey]['signval'] = empty($sign_customers['signval']) ? 0 : $sign_customers['signval'];

                 // 跟进数量
                 if($user_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'].' AND c.custom_service='.$user_id;
                 }elseif($department_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'].' AND c.department_no='.$department_id;
                 }else{
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'];    
                 }
                
                $this->db->join('customer c','c.id=follow_customer.customer_id','left');
                $this->db->group_by('customer_id');
                $follow_num = $this->db->select('count(customer_id) followcount')->where($where)->get('follow_customer')->result_array();

                if(count($follow_num) > 1){
                    $channels[$chkey]['followcount'] = count($follow_num);
                }else{
                    $channels[$chkey]['followcount'] = empty($follow_num[0]['followcount']) ? 0 : $follow_num[0]['followcount'];    
                }

                // if($chval['id'] == 63){
                //     echo $this->db->last_query();
                //     p($follow_num);
                // }
            }
        }
        // p($channels);die;
        echo json_encode($channels);
    }



    /**
     * [get_weeks_chinfo 获取近七天推广渠道客户数据]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-23T15:23:47+0800
     * @return   [type]                   [description]
     */
    public function get_weeks_chinfo(){
        $yesterday=strtotime(date('Y-m-d',strtotime("-7 day")));
        $today=strtotime(date('Y-m-d'));

        // 以人或部门为单位
        $user_id = $this->input->post('user_id');
        $department_id = $this->input->post('department_id');

        // $this->db->select("*");
        // $channels=$this->db->get('channel')->result_array();
        $channels = $this->channel_model->getall_channel_format(21,false);

        foreach($channels as $chkey => $chval){

            if($chval['level'] == 1){
                // 新录入
                if($user_id > 0){
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND department_no='.$department_id;
                }else{
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today;    
                }
                
                $new_add = $this->db->select('count(id) addcount')->where($where)->get('customer')->row_array();
                $channels[$chkey]['newadd_num'] = $new_add['addcount'];

                // 签单数量
                if($user_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'].' AND custom_service='.$user_id; 
                }elseif($department_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'].' AND department_no='.$department_id;
                }else{
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'];
                }

                $sign_customers = $this->db->select('count(id) signcount,sum(sign_val) signval')->where($where)->get('customer')->row_array();
                $channels[$chkey]['signcount'] = $sign_customers['signcount'];
                $channels[$chkey]['signval'] = empty($sign_customers['signval']) ? 0 : $sign_customers['signval'];


                // 跟进数量
                if($user_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'].' AND c.custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'].' AND c.department_no='.$department_id;
                }else{
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'];
                }

                $this->db->join('customer c','c.id=follow_customer.customer_id','left');
                $this->db->group_by('customer_id');
                $follow_num = $this->db->select('count(customer_id) followcount')->where($where)->get('follow_customer')->result_array();
                if(count($follow_num) > 1){
                    $channels[$chkey]['followcount'] = count($follow_num);
                }else{
                    $channels[$chkey]['followcount'] = empty($follow_num[0]['followcount']) ? 0 : $follow_num[0]['followcount'];    
                }

                // if(!empty($follow_num)){
                //     echo $this->db->last_query();
                //     p($follow_num);
                // }
                
            }

            if($chval['level'] == 2){
                // 新录入
                if($user_id > 0){
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND department_no='.$department_id;
                }else{
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today;    
                }
                
                $new_add = $this->db->select('count(id) addcount')->where($where)->get('customer')->row_array();

                $channels[$chkey]['newadd_num'] = $new_add['addcount'];

                // 签单数量
                if($user_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'].' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'].' AND department_no='.$department_id; 
                }else{
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'];    
                }
                
                $sign_customers = $this->db->select('count(id) signcount,sum(sign_val) signval')->where($where)->get('customer')->row_array();
                $channels[$chkey]['signcount'] = $sign_customers['signcount'];
                $channels[$chkey]['signval'] = empty($sign_customers['signval']) ? 0 : $sign_customers['signval'];

                 // 跟进数量
                 if($user_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'].' AND c.custom_service='.$user_id;
                 }elseif($department_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'].' AND c.department_no='.$department_id;
                 }else{
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'];    
                 }
                
                $this->db->join('customer c','c.id=follow_customer.customer_id','left');
                $this->db->group_by('customer_id');
                $follow_num = $this->db->select('count(customer_id) followcount')->where($where)->get('follow_customer')->result_array();

                if(count($follow_num) > 1){
                    $channels[$chkey]['followcount'] = count($follow_num);
                }else{
                    $channels[$chkey]['followcount'] = empty($follow_num[0]['followcount']) ? 0 : $follow_num[0]['followcount'];    
                }

                // if($chval['id'] == 63){
                //     echo $this->db->last_query();
                //     p($follow_num);
                // }
            }
        }
        // p($channels);die;
        echo json_encode($channels);
    }


    /**
     * [get_month_chinfo 获取本月推广渠道数据]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-23T15:29:04+0800
     * @return   [type]                   [description]
     */
    public function get_month_chinfo(){
        $yesterday=strtotime(date('Y-m-d',strtotime("-30 day")));
        $today=strtotime(date('Y-m-d'));

        // 以人或部门为单位
        $user_id = $this->input->post('user_id');
        $department_id = $this->input->post('department_id');

        // $this->db->select("*");
        // $channels=$this->db->get('channel')->result_array();
        $channels = $this->channel_model->getall_channel_format(21,false);

        foreach($channels as $chkey => $chval){

           if($chval['level'] == 1){
                // 新录入
                if($user_id > 0){
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND department_no='.$department_id;
                }else{
                    $where = 'channel_id_2='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today;    
                }
                
                $new_add = $this->db->select('count(id) addcount')->where($where)->get('customer')->row_array();
                $channels[$chkey]['newadd_num'] = $new_add['addcount'];

                // 签单数量
                if($user_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'].' AND custom_service='.$user_id; 
                }elseif($department_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'].' AND department_no='.$department_id;
                }else{
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_2='.$chval['id'];
                }

                $sign_customers = $this->db->select('count(id) signcount,sum(sign_val) signval')->where($where)->get('customer')->row_array();
                $channels[$chkey]['signcount'] = $sign_customers['signcount'];
                $channels[$chkey]['signval'] = empty($sign_customers['signval']) ? 0 : $sign_customers['signval'];


                // 跟进数量
                if($user_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'].' AND c.custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'].' AND c.department_no='.$department_id;
                }else{
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_2='.$chval['id'];
                }

                $this->db->join('customer c','c.id=follow_customer.customer_id','left');
                $this->db->group_by('customer_id');
                $follow_num = $this->db->select('count(customer_id) followcount')->where($where)->get('follow_customer')->result_array();
                if(count($follow_num) > 1){
                    $channels[$chkey]['followcount'] = count($follow_num);
                }else{
                    $channels[$chkey]['followcount'] = empty($follow_num[0]['followcount']) ? 0 : $follow_num[0]['followcount'];    
                }

                // if(!empty($follow_num)){
                //     echo $this->db->last_query();
                //     p($follow_num);
                // }
                
            }

            if($chval['level'] == 2){
                // 新录入
                if($user_id > 0){
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today.' AND department_no='.$department_id;
                }else{
                    $where = 'channel_id_3='.$chval['id'].' AND create_time>'.$yesterday.' AND create_time<'.$today;    
                }
                
                $new_add = $this->db->select('count(id) addcount')->where($where)->get('customer')->row_array();

                $channels[$chkey]['newadd_num'] = $new_add['addcount'];

                // 签单数量
                if($user_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'].' AND custom_service='.$user_id;
                }elseif($department_id > 0){
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'].' AND department_no='.$department_id; 
                }else{
                    $where = 'sign_status=1 AND sign_time>'.$yesterday.' AND sign_time<'.$today.' AND channel_id_3='.$chval['id'];    
                }
                
                $sign_customers = $this->db->select('count(id) signcount,sum(sign_val) signval')->where($where)->get('customer')->row_array();
                $channels[$chkey]['signcount'] = $sign_customers['signcount'];
                $channels[$chkey]['signval'] = empty($sign_customers['signval']) ? 0 : $sign_customers['signval'];

                 // 跟进数量
                 if($user_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'].' AND c.custom_service='.$user_id;
                 }elseif($department_id > 0){
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'].' AND c.department_no='.$department_id;
                 }else{
                    $where = 'time>'.$yesterday.' AND time<'.$today.' AND c.channel_id_3='.$chval['id'];    
                 }
                
                $this->db->join('customer c','c.id=follow_customer.customer_id','left');
                $this->db->group_by('customer_id');
                $follow_num = $this->db->select('count(customer_id) followcount')->where($where)->get('follow_customer')->result_array();

                if(count($follow_num) > 1){
                    $channels[$chkey]['followcount'] = count($follow_num);
                }else{
                    $channels[$chkey]['followcount'] = empty($follow_num[0]['followcount']) ? 0 : $follow_num[0]['followcount'];    
                }

                // if($chval['id'] == 63){
                //     echo $this->db->last_query();
                //     p($follow_num);
                // }
            }
        }
        // p($channels);die;
        echo json_encode($channels);
    }





    //新增客户数统计(全公司)
    public function ajax_add_customer(){
        $yesterday=strtotime(date('Y-m-d',strtotime("-1 day")));
        $today=strtotime(date('Y-m-d'));
        $this->db->select("count(nb_customer.id)as num,e.name as ename");
        $this->db->join("user u",'u.id=customer.creator','left');
        $this->db->join('employee e',"e.user_id=u.id",'left');
        $this->db->where('customer.create_time>=',$yesterday);
        $this->db->where('customer.create_time<',$today);
        $this->db->group_by('customer.creator');
         $this->db->order_by('count(nb_customer.id) desc');
         $this->db->limit(15);
        $customer=$this->db->get('customer')->result_array();
        echo json_encode($customer);
    }
    public function ajax_week_add(){
        $sql='SELECT count(c.id) AS num ,e.name as ename FROM `nb_customer` c
            LEFT JOIN nb_user u on u.id=c.creator
            LEFT JOIN nb_employee e on u.id=e.user_id
            WHERE
    date_sub(curdate(), INTERVAL 6 DAY) <= date(from_unixtime(c.create_time))GROUP BY c.creator ORDER BY count(c.id) desc LIMIT 15';
        $weeks=$this->db->query($sql)->result_array();
        echo json_encode($weeks);
    }
    public function ajax_month_add(){
        $sql='SELECT count(c.id) AS num ,e.name as ename FROM `nb_customer` c
            LEFT JOIN nb_user u on u.id=c.creator
            LEFT JOIN nb_employee e on u.id=e.user_id
            WHERE
    date_sub(curdate(), INTERVAL 30 DAY) <= date(from_unixtime(c.create_time))  GROUP BY c.creator ORDER BY count(c.id) desc LIMIT 15';
        $weeks=$this->db->query($sql)->result_array();
        echo json_encode($weeks);
    }
    //修改意向客户状态
    public function  will_status_update(){
        $this->db->cache_delete_all();
       $cus_id=$_POST['id'];
        $will_stauts=$_POST['will_status'];
        $this->db->where("id",$cus_id);
        $this->db->update("customer",array("will_status"=>$will_stauts));
    }
    //售前客服指定销售
    public function appoint_sale(){
        $user_id=$_POST['user_id'];
        $cus_id=$_POST['cus_id'];
        //变更日志
        $id=$_SESSION['user_id'];
        //客户
        $this->db->where("id",$cus_id);
        $cus=$this->db->get("customer")->result_array();

        //主客服
        $this->db->where("user.id",$id->id);
        $this->db->join("employee e" ," e.user_id=user.id");
        $custom_service=$this->db->get("user")->result_array();

        //指定人
        $this->db->where("user.id",$user_id);
        $this->db->join("employee e" ,"e.user_id=user.id");
        $sale_user=$this->db->get("user")->result_array();

        //插入日志
        $data=array(
            "customer_id"=>$cus_id,
            "add_time"=>time(),
            "user_id"=>$_SESSION['user_id']->id,
            "change_type"=>2,
            "change_text"=>"".$custom_service[0]['name']."客服把".$cus[0]['name']."客户指派给".$sale_user[0]['name']."销售",
            "cus_from" =>$custom_service[0]['name'],
            "cus_to" =>$sale_user[0]['name'],
        );


        $result=$this->db->insert("customer_change",$data);
        if($result){
            $this->db->where("id",$cus_id);
            $this->db->update("customer",array("new_user_id"=>$user_id));
        }
    }
    //当前客服指定的销售人
    public function appoint_users(){
        $cus_id=$_POST['customer_id'];
        $this->db->select("e.name as ename,e.mobile as emobile");
        $this->db->where('customer.id',$cus_id);
        $this->db->join("employee e","e.user_id=customer.new_user_id");
        $appoint_sale=$this->db->get("customer")->result_array();
        echo json_encode($appoint_sale);
    }
    
    /**
     * [set_tuiguang 添加客户时如果客户在公海则捡回]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-22T16:33:45+0800
     */
    public function set_tuiguang(){
        $id=$_SESSION['user_id'];
        $channel_id = $this->input->post('channel_id');
        $cus_id = $this->input->post('cus_id');


        $this_channels = $this->channel_model->get_parchannel_bychid($channel_id);

        $this->db->where("id",$cus_id);

        $data = array(
            'channel_id' => empty($this_channels[0]) ? 0 : $this_channels[0],
            'channel_id_1' => empty($this_channels[0]) ? 0 : $this_channels[0],
            'channel_id_2' => empty($this_channels[1]) ? 0 : $this_channels[1],
            'channel_id_3' => empty($this_channels[2]) ? 0 : $this_channels[2],
            'custom_service' => $id->id,
            'new_user_id' => $id->id,
            'extend_status' => 1,
            'public_state' => 0,
            'syschecktime' => time()
            );
        $result=$this->db->update("customer",$data);
        if($result){
            echo "true";
        }else{
            echo "false";
        }
    }
}