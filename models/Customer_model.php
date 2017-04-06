<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/28
 * Time: 9:20
 */
class Customer_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 查询我的客户
     *
     * @param $linkType  联系类型
     * //[0:默认， 1 未联系，2 待联系，3 已联系 ]
     * @param $linkDay  联系  时间
     * [0 :默认，]
     * @param  $sortType
     * o 默认 创建时间升序； 1 名称升序 2 最后跟进时间倒叙  3 创建时间倒叙
     *       后来增加(20161219) 10 按录入时间升序 11 按导入公海时间升序
     * $searchType
     * 1 客户 2 qq 3 手机 4 邮箱 10 推广客户 11 客户联系人 12 按客户所有人搜索
     * $searchText
     * $noassgin_flag true时为售前录入的未指派客户
     * $is_sq         true时为售前角色
     * $chids         为客户来源渠道筛选条件
     * $only_chis     只看下级录入的客户
     */
	 
    function queryCustomer($user, $size, $offset, $linkType = 0,
                           $linkDay = 0, $sortType = 0, $status, $tag,$searchType, $searchText,
                           $createStartTime, $createEndTime, $isPublic , $zhuguan = false ,$will_status = "", $sign_status = "" , $share_status = false,$noassgin_flag = false ,$is_sq = false ,$chids = null ,$only_chis = false , $this_cusids = null , $user_chis = null) {

        set_time_limit(0);
        // ini_set('memory_limit' , '1024M'); 

        if($share_status&&$size|$sortType){
            $this->db->select(
                "distinct('customer.id'),customer.*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,k.keyword as keyword");
        }else if($size|$sortType){
            // @zzr edit at 2016-12-20 09:51
            if(empty($size) && !empty($sortType)){
                $this->db->select("count(nb_customer.id) as num ");
            }else{
                $this->db->select(
                "*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job");
            }

        }else if(!$size|!$sortType&&!$share_status) {
            $this->db->select("count(nb_customer.id) as num ");
        }else if($share_status&&!$size|!$sortType){
            $this->db->select("count(distinct(nb_customer.id)) as num ");
        }

        //联系状态查询
        $start = $linkDay == 5 ? 4 : $linkDay;//5天内 包含第4天
        $end = $linkDay + 1;
        if($linkDay!=null){
            $startDay = strtotime(date("Y-m-d",strtotime("+$start day")));
            $endDay = strtotime(date("Y-m-d",strtotime("+$end day")));
            switch($linkType) {
                case 1:$this->db->where("customer.follow_status",0);break;
                case 2:
                    $this->db->group_by("fc.customer_id");
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                    $this->db->where("fc.next_time>=",$startDay);
                    $this->db->where("fc.next_time<",$endDay);
                    break;
                case 3:
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");

                    $this->db->group_by("fc.customer_id");

                    $this->db->where("fc.time>",$startDay);

                    $this->db->where("fc.time<",$endDay);
                    break;
                default:
            }
        }


        switch($sortType) {//排序处理
            // case 1:$this->db->order_by('time desc'); break;
            case 1:
                if($linkType != 2 && $linkType != 3){
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                }
                $this->db->group_by('nb_customer.id');
                $this->db->order_by('time desc'); 
                break;
            case 2:$this->db->order_by('CONVERT(`nb_customer`.name USING gbk ) ');break;
            case 3:$this->db->order_by('customer.create_time desc');break;
            case 10 : $this->db->order_by('customer.create_time desc'); break;
            case 11 : $this->db->order_by('cc.add_time desc'); break;
            default : $this->db->order_by('create_time desc');
        }

        // 无，A，B，C，D类客户
        if(isset($status)&&$status!=null){
            $statusArray=explode(",",$status);
            $this->db ->where_in("customer.status",array_filter($statusArray));
        }

        //标签查询
        if($tag){
            $tags=explode(",",$tag);
            $tags= array_filter($tags);
            $this->db->join("custom_tag ct","customer.id=ct.cus_id","left");
            $this->db->group_by("ct.cus_id");
            $this->db->where_in("ct.tag_id",$tags);
        }

        //重点客户
        if($will_status<>""){

            $will_status= substr($will_status,0,-1);

            $will_status=explode(",",$will_status);
            $this->db->where_in("will_status",$will_status);

        }
        //推广客户
        if($sign_status<>""){
            $sign_status=substr($sign_status,0,-1);
            $sign_status=explode(",",$sign_status);
            $this->db->where_in("sign_status",$sign_status);
        }

        //搜索条件查询
        switch($searchType) {
            case 1:$this->db->like('customer.name', $searchText, 'both');break;
            case 2:$this->db->like('link.mobile', $searchText, 'both');break;
            case 3:$this->db->like('link.qq', $searchText, 'both');break;
            case 4:$this->db->like('link.email', $searchText, 'both');break;
            case 10:$this->db->where('extend_status',1);break;
            case 11:$this->db->like('link.name', $searchText, 'both');break;
            case 12:$this->db->where('customer.new_user_id', $searchText);break;
            default:
        }
        // 按来源渠道搜索用于售前客服
        if($searchType >= 20){
            $this->db->where("(channel_id in(".$searchType.") or channel_id_2 in(".$searchType.") or channel_id_3 in(".$searchType."))");
        }


        //录入时间段查询
        if($createStartTime&&$createEndTime){
            $start_time= strtotime($createStartTime);
            $end_time= strtotime($createEndTime);
            $this->db->where("customer.create_time>=",$start_time);
            $this->db->where("customer.create_time<",$end_time);

        }

        //是否是公海
        if($isPublic) {
            $this->db->where("customer.public_state",1);
        }else if(!empty($user_chis)){
            $user_chis_arr = explode('|', $user_chis);
            if(isset($user_chis_arr[1]) && $user_chis_arr[1] == 5){
                $this->db->where("customer.custom_service",$user_chis_arr[0]);
            }else{
                $this->db->where("customer.new_user_id",$user_chis_arr[0]);    
            }
            $this->db->where("customer.public_state",0);
        }else if($zhuguan!="admin"&&$zhuguan) {
            //主管，客户信息显示全部部门
            $this->db->join("employee e","customer.creator=e.user_id","left");
            $this->db->join("department d","e.department_no=d.id","left");
            $this->db->where("customer.public_state",0);

            if(is_array($zhuguan)){
                $this->db->where_in('d.id',$zhuguan);
            }else{
                if($is_sq){
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("((nb_customer.custom_service != ".$user->id." or nb_customer.creator != ".$user->id." or nb_customer.new_user_id != ".$user->id.") and d.id=".$zhuguan.")");
                    }else{
                        $this->db->where("(nb_customer.custom_service=".$user->id." or d.id=".$zhuguan.")");    
                    }
                    // $this->db->where("d.id",$zhuguan);
                }else{
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
                    }
                    $this->db->where("d.id",$zhuguan);
                }
            }

            // @zzr edit at 2016-12-09 11:21
            if($noassgin_flag){ // 查询售前客服未指派的客户
                $this->db->where("nb_customer.new_user_id = nb_customer.custom_service");
            }
        }else if($zhuguan=="admin"){
            //管理员客户信显示全部用户的客户
            $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
        }else if($share_status==1){
            //共享客户
            $this->db->where("s.share",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($share_status==2){
            //共享客户
            $this->db->where("s.be_shared",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($is_sq){
            $this->db->where("(nb_customer.custom_service=".$user->id.")");
        }else if($noassgin_flag){ // 未指派客户
            $this->db->where("nb_customer.new_user_id = nb_customer.custom_service and nb_customer.new_user_id = ".$user->id);
        }else if($this_cusids === '' || !empty($this_cusids)){
            $this_cusids = empty($this_cusids) ? 0 : $this_cusids;
            $this->db->where('nb_customer.id in('.$this_cusids.')');
        }else{
            //不是公海，创建人是登陆用户  或者  所有人是登陆用户
            $this->db->where("customer.public_state",0);
            $this->db->where("((nb_customer.creator = ".$user->id." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$user->id.")");
        }

        //分页
        if($size && $offset||$offset==0){
            $this->db->limit($size,$offset);
        }

        // @zzr edit at 2016-12-20 10:08 来源渠道组合查询条件
        if(!empty($chids)){
            $chids = trim($chids,',');
            if(!in_array('-1', explode(',' , trim($chids,',')))){
                $this->db->where("(channel_id in(".$chids.") or channel_id_2 in(".$chids.") or channel_id_3 in(".$chids."))");
            }
        }

        // @zzr edit at 2016-12-20 10:08 按放入公海时间倒叙
        if($sortType == 11){
            $this->db->join('customer_change cc','customer.id=cc.customer_id','left');
            $this->db->where('cc.change_type',1);
            $this->db->group_by('nb_customer.id');
        }

		//$this->db->where("customer.is_huixiao=0");
		
        $this->db->join('keyword k','customer.keyword_id=k.id','left');//关键词
        $this->db->join('linkman link','customer.linkman_id=link.id','left');
        $this->db->join("custom_position cp","cp.id=link.position_id","left");

        $query = $this->db->get('customer');

        // echo $this->db->last_query();
        // // die;

        return $query;
    }	 
    function queryCustomer2($user, $size, $offset, $linkType = 0,
                           $linkDay = 0, $sortType = 0, $status, $tag,$searchType, $searchText,
                           $createStartTime, $createEndTime, $isPublic , $zhuguan = false ,$will_status = "", $sign_status = "" , $share_status = false,$noassgin_flag = false ,$is_sq = false ,$chids = null ,$only_chis = false , $this_cusids = null , $user_chis = null) {

        set_time_limit(0);
        // ini_set('memory_limit' , '1024M'); 

        if($share_status&&$size|$sortType){
            $this->db->select(
                "distinct('customer.id'),customer.*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,k.keyword as keyword,s.*,u.*,e.name as ename,");
        }else if($size|$sortType){
            // @zzr edit at 2016-12-20 09:51
            if(empty($size) && !empty($sortType)){
                $this->db->select("count(nb_customer.id) as num ");
            }else{
                $this->db->select(
                "*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job");
            }

        }else if(!$size|!$sortType&&!$share_status) {
            $this->db->select("count(nb_customer.id) as num ");
        }else if($share_status&&!$size|!$sortType){
            $this->db->select("count(distinct(nb_customer.id)) as num ");
        }

        //联系状态查询
        $start = $linkDay == 5 ? 4 : $linkDay;//5天内 包含第4天
        $end = $linkDay + 1;
        if($linkDay!=null){
            $startDay = strtotime(date("Y-m-d",strtotime("+$start day")));
            $endDay = strtotime(date("Y-m-d",strtotime("+$end day")));
            switch($linkType) {
                case 1:$this->db->where("customer.follow_status",0);break;
                case 2:
                    $this->db->group_by("fc.customer_id");
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                    $this->db->where("fc.next_time>=",$startDay);
                    $this->db->where("fc.next_time<",$endDay);
                    break;
                case 3:
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");

                    $this->db->group_by("fc.customer_id");

                    $this->db->where("fc.time>",$startDay);

                    $this->db->where("fc.time<",$endDay);
                    break;
                default:
            }
        }


        switch($sortType) {//排序处理
            // case 1:$this->db->order_by('time desc'); break;
            case 1:
                if($linkType != 2 && $linkType != 3){
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                }
                $this->db->group_by('nb_customer.id');
                $this->db->order_by('time desc'); 
                break;
            case 2:$this->db->order_by('CONVERT(`nb_customer`.name USING gbk ) ');break;
            case 3:$this->db->order_by('customer.create_time desc');break;
            case 10 : $this->db->order_by('customer.create_time desc'); break;
            case 11 : $this->db->order_by('cc.add_time desc'); break;
            default : $this->db->order_by('create_time desc');
        }

        // 无，A，B，C，D类客户
        if(isset($status)&&$status!=null){
            $statusArray=explode(",",$status);
            $this->db ->where_in("customer.status",array_filter($statusArray));
        }

        //标签查询
        if($tag){
            $tags=explode(",",$tag);
            $tags= array_filter($tags);
            $this->db->join("custom_tag ct","customer.id=ct.cus_id","left");
            $this->db->group_by("ct.cus_id");
            $this->db->where_in("ct.tag_id",$tags);
        }

        //重点客户
        if($will_status<>""){

            $will_status= substr($will_status,0,-1);

            $will_status=explode(",",$will_status);
            $this->db->where_in("will_status",$will_status);

        }
        //推广客户
        if($sign_status<>""){
            $sign_status=substr($sign_status,0,-1);
            $sign_status=explode(",",$sign_status);
            $this->db->where_in("sign_status",$sign_status);
        }

        //搜索条件查询
        switch($searchType) {
            case 1:$this->db->like('customer.name', $searchText, 'both');break;
            case 2:$this->db->like('link.mobile', $searchText, 'both');break;
            case 3:$this->db->like('link.qq', $searchText, 'both');break;
            case 4:$this->db->like('link.email', $searchText, 'both');break;
            case 10:$this->db->where('extend_status',1);break;
            case 11:$this->db->like('link.name', $searchText, 'both');break;
            case 12:$this->db->where('customer.new_user_id', $searchText);break;
            default:
        }
        // 按来源渠道搜索用于售前客服
        if($searchType >= 20){
            $this->db->where("(channel_id in(".$searchType.") or channel_id_2 in(".$searchType.") or channel_id_3 in(".$searchType."))");
        }


        //录入时间段查询
        if($createStartTime&&$createEndTime){
            $start_time= strtotime($createStartTime);
            $end_time= strtotime($createEndTime);
            $this->db->where("customer.create_time>=",$start_time);
            $this->db->where("customer.create_time<",$end_time);

        }

        //是否是公海
        if($isPublic) {
            $this->db->where("customer.public_state",1);
        }else if(!empty($user_chis)){
            $user_chis_arr = explode('|', $user_chis);
            if(isset($user_chis_arr[1]) && $user_chis_arr[1] == 5){
                $this->db->where("customer.custom_service",$user_chis_arr[0]);
            }else{
                $this->db->where("customer.new_user_id",$user_chis_arr[0]);    
            }
            $this->db->where("customer.public_state",0);
        }else if($zhuguan!="admin"&&$zhuguan) {
            //主管，客户信息显示全部部门
            $this->db->join("employee e","customer.creator=e.user_id","left");
            $this->db->join("department d","e.department_no=d.id","left");
            $this->db->where("customer.public_state",0);

            if(is_array($zhuguan)){
                $this->db->where_in('d.id',$zhuguan);
            }else{
                if($is_sq){
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("((nb_customer.custom_service != ".$user->id." or nb_customer.creator != ".$user->id." or nb_customer.new_user_id != ".$user->id.") and d.id=".$zhuguan.")");
                    }else{
                        $this->db->where("(nb_customer.custom_service=".$user->id." or d.id=".$zhuguan.")");    
                    }
                    // $this->db->where("d.id",$zhuguan);
                }else{
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
                    }
                    $this->db->where("d.id",$zhuguan);
                }
            }

            // @zzr edit at 2016-12-09 11:21
            if($noassgin_flag){ // 查询售前客服未指派的客户
                $this->db->where("nb_customer.new_user_id = nb_customer.custom_service");
            }
        }else if($zhuguan=="admin"){
            //管理员客户信显示全部用户的客户
            $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
        }else if($share_status==1){
            //共享客户
            $this->db->where("s.share",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($share_status==2){
            //共享客户
            $this->db->where("s.be_shared",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($is_sq){
            $this->db->where("(nb_customer.custom_service=".$user->id.")");
        }else if($noassgin_flag){ // 未指派客户
            $this->db->where("nb_customer.new_user_id = nb_customer.custom_service and nb_customer.new_user_id = ".$user->id);
        }else if($this_cusids === '' || !empty($this_cusids)){
            $this_cusids = empty($this_cusids) ? 0 : $this_cusids;
            $this->db->where('nb_customer.id in('.$this_cusids.')');
        }else{
            //不是公海，创建人是登陆用户  或者  所有人是登陆用户
            $this->db->where("customer.public_state",0);
            $this->db->where("((nb_customer.creator = ".$user->id." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$user->id.")");
        }

        //分页
        if($size && $offset||$offset==0){
            $this->db->limit($size,$offset);
        }

        // @zzr edit at 2016-12-20 10:08 来源渠道组合查询条件
        if(!empty($chids)){
            $chids = trim($chids,',');
            if(!in_array('-1', explode(',' , trim($chids,',')))){
                $this->db->where("(channel_id in(".$chids.") or channel_id_2 in(".$chids.") or channel_id_3 in(".$chids."))");
            }
        }

        // @zzr edit at 2016-12-20 10:08 按放入公海时间倒叙
        if($sortType == 11){
            $this->db->join('customer_change cc','customer.id=cc.customer_id','left');
            $this->db->where('cc.change_type',1);
            $this->db->group_by('nb_customer.id');
        }
		if($_GET["sousuo_text2"]){
			$ename=$_GET["sousuo_text2"];
			$this->db->where('e.name',$ename);
		}
		
		//$this->db->where("customer.is_huixiao=0");
		
        $this->db->join('keyword k','customer.keyword_id=k.id','left');//关键词
        $this->db->join('linkman link','customer.linkman_id=link.id','left');
        $this->db->join("custom_position cp","cp.id=link.position_id","left");
		
		$this->db->join("user u","u.id=s.share","left");
		$this->db->join("employee e","e.user_id=u.id","left");
        $query = $this->db->get('customer');
		//$query = $this->db->select('*');
        // echo $this->db->last_query();
        // // die;

        return $query;
    }
 

    function queryCustomer_my($user, $size, $offset, $linkType = 0,
                           $linkDay = 0, $sortType = 0, $status, $tag,$searchType, $searchText,
                           $createStartTime, $createEndTime, $isPublic , $zhuguan = false ,$will_status = "", $sign_status = "" , $share_status = false,$noassgin_flag = false ,$is_sq = false ,$chids = null ,$only_chis = false , $this_cusids = null , $user_chis = null) {

        set_time_limit(0);
        // ini_set('memory_limit' , '1024M'); 

        if($share_status&&$size|$sortType){
            $this->db->select(
                "distinct('customer.id'),customer.*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,k.keyword as keyword");
        }else if($size|$sortType){
            // @zzr edit at 2016-12-20 09:51
            if(empty($size) && !empty($sortType)){
                $this->db->select("count(nb_customer.id) as num ");
            }else{
                $this->db->select(
                "*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,e.name as ename");
            }

        }else if(!$size|!$sortType&&!$share_status) {
            $this->db->select("count(nb_customer.id) as num ");
        }else if($share_status&&!$size|!$sortType){
            $this->db->select("count(distinct(nb_customer.id)) as num ");
        }

        //联系状态查询
        $start = $linkDay == 5 ? 4 : $linkDay;//5天内 包含第4天
        $end = $linkDay + 1;
        if($linkDay!=null){
            $startDay = strtotime(date("Y-m-d",strtotime("+$start day")));
            $endDay = strtotime(date("Y-m-d",strtotime("+$end day")));
            switch($linkType) {
                case 1:$this->db->where("customer.follow_status",0);break;
                case 2:
                    $this->db->group_by("fc.customer_id");
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                    $this->db->where("fc.next_time>=",$startDay);
                    $this->db->where("fc.next_time<",$endDay);
                    break;
                case 3:
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");

                    $this->db->group_by("fc.customer_id");

                    $this->db->where("fc.time>",$startDay);

                    $this->db->where("fc.time<",$endDay);
                    break;
                default:
            }
        }


        switch($sortType) {//排序处理
            // case 1:$this->db->order_by('time desc'); break;
            case 1:
                if($linkType != 2 && $linkType != 3){
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                }
                $this->db->group_by('nb_customer.id');
                $this->db->order_by('time desc'); 
                break;
            case 2:$this->db->order_by('CONVERT(`nb_customer`.name USING gbk ) ');break;
            case 3:$this->db->order_by('customer.create_time desc');break;
            case 10 : $this->db->order_by('customer.create_time desc'); break;
            case 11 : $this->db->order_by('cc.add_time desc'); break;
            default : $this->db->order_by('create_time desc');
        }

        // 无，A，B，C，D类客户
        if(isset($status)&&$status!=null){
            $statusArray=explode(",",$status);
            $this->db ->where_in("customer.status",array_filter($statusArray));
        }

        //标签查询
        if($tag){
            $tags=explode(",",$tag);
            $tags= array_filter($tags);
            $this->db->join("custom_tag ct","customer.id=ct.cus_id","left");
            $this->db->group_by("ct.cus_id");
            $this->db->where_in("ct.tag_id",$tags);
        }

        //重点客户
        if($will_status<>""){

            $will_status= substr($will_status,0,-1);

            $will_status=explode(",",$will_status);
            $this->db->where_in("will_status",$will_status);

        }
        //推广客户
        if($sign_status<>""){
            $sign_status=substr($sign_status,0,-1);
            $sign_status=explode(",",$sign_status);
            $this->db->where_in("sign_status",$sign_status);
        }

        //搜索条件查询
        switch($searchType) {
            case 1:$this->db->like('customer.name', $searchText, 'both');break;
            case 2:$this->db->like('link.mobile', $searchText, 'both');break;
            case 3:$this->db->like('link.qq', $searchText, 'both');break;
            case 4:$this->db->like('link.email', $searchText, 'both');break;
            case 10:$this->db->where('extend_status',1);break;
            case 11:$this->db->like('link.name', $searchText, 'both');break;
            case 12:$this->db->where('customer.new_user_id', $searchText);break;
            default:
        }
        // 按来源渠道搜索用于售前客服
        if($searchType >= 20){
            $this->db->where("(channel_id in(".$searchType.") or channel_id_2 in(".$searchType.") or channel_id_3 in(".$searchType."))");
        }


        //录入时间段查询
        if($createStartTime&&$createEndTime){
            $start_time= strtotime($createStartTime);
            $end_time= strtotime($createEndTime);
            $this->db->where("customer.create_time>=",$start_time);
            $this->db->where("customer.create_time<",$end_time);

        }

        //是否是公海
        if($isPublic) {
            $this->db->where("customer.public_state",1);
        }else if(!empty($user_chis)){
            $user_chis_arr = explode('|', $user_chis);
            if(isset($user_chis_arr[1]) && $user_chis_arr[1] == 5){
                $this->db->where("customer.custom_service",$user_chis_arr[0]);
            }else{
                $this->db->where("customer.new_user_id",$user_chis_arr[0]);    
            }
            $this->db->where("customer.public_state",0);
        }else if($zhuguan!="admin"&&$zhuguan) {
            //主管，客户信息显示全部部门
            $this->db->join("employee e","customer.creator=e.user_id","left");
            $this->db->join("department d","e.department_no=d.id","left");
            $this->db->where("customer.public_state",0);

            if(is_array($zhuguan)){
                $this->db->where_in('d.id',$zhuguan);
            }else{
                if($is_sq){
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("((nb_customer.custom_service != ".$user->id." or nb_customer.creator != ".$user->id." or nb_customer.new_user_id != ".$user->id.") and d.id=".$zhuguan.")");
                    }else{
                        $this->db->where("(nb_customer.custom_service=".$user->id." or d.id=".$zhuguan.")");    
                    }
                    // $this->db->where("d.id",$zhuguan);
                }else{
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
                    }
                    $this->db->where("d.id",$zhuguan);
                }
            }

            // @zzr edit at 2016-12-09 11:21
            if($noassgin_flag){ // 查询售前客服未指派的客户
                $this->db->where("nb_customer.new_user_id = nb_customer.custom_service");
            }
        }else if($zhuguan=="admin"){
            //管理员客户信显示全部用户的客户
            $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
        }else if($share_status==1){
            //共享客户
            $this->db->where("s.share",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($share_status==2){
            //共享客户
            $this->db->where("s.be_shared",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($is_sq){
            $this->db->where("(nb_customer.custom_service=".$user->id.")");
        }else if($noassgin_flag){ // 未指派客户
            $this->db->where("nb_customer.new_user_id = nb_customer.custom_service and nb_customer.new_user_id = ".$user->id);
        }else if($this_cusids === '' || !empty($this_cusids)){
            $this_cusids = empty($this_cusids) ? 0 : $this_cusids;
            $this->db->where('nb_customer.id in('.$this_cusids.')');
        }else{
            //不是公海，创建人是登陆用户  或者  所有人是登陆用户
            $this->db->where("customer.public_state",0);
            $this->db->where("((nb_customer.creator = ".$user->id." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$user->id.")");
        }

        //分页
        if($size && $offset||$offset==0){
            $this->db->limit($size,$offset);
        }

        // @zzr edit at 2016-12-20 10:08 来源渠道组合查询条件
        if(!empty($chids)){
            $chids = trim($chids,',');
            if(!in_array('-1', explode(',' , trim($chids,',')))){
                $this->db->where("(channel_id in(".$chids.") or channel_id_2 in(".$chids.") or channel_id_3 in(".$chids."))");
            }
        }

        // @zzr edit at 2016-12-20 10:08 按放入公海时间倒叙
        if($sortType == 11){
            $this->db->join('customer_change cc','customer.id=cc.customer_id','left');
            $this->db->where('cc.change_type',1);
            $this->db->group_by('nb_customer.id');
        }

		//$this->db->where("customer.is_huixiao=0");
		
        $this->db->join('keyword k','customer.keyword_id=k.id','left');//关键词
        $this->db->join('linkman link','customer.linkman_id=link.id','left');
        $this->db->join("custom_position cp","cp.id=link.position_id","left");
		
		
		$this->db->join("user u","u.id=customer.creator","left");
		$this->db->join("employee e","e.user_id=u.id","left");
        $query = $this->db->get('customer');
		//$query = $this->db->select('*');
         //echo $this->db->last_query();
         //die;		


        // echo $this->db->last_query();
        // // die;

        return $query;
    }

    function queryCustomer_sea($user, $size, $offset, $linkType = 0,
                           $linkDay = 0, $sortType = 0, $status, $tag,$searchType, $searchText,
                           $createStartTime, $createEndTime, $isPublic , $zhuguan = false ,$will_status = "", $sign_status = "" , $share_status = false,$noassgin_flag = false ,$is_sq = false ,$chids = null ,$only_chis = false , $this_cusids = null , $user_chis = null) {

        set_time_limit(0);
        // ini_set('memory_limit' , '1024M'); 

        if($share_status&&$size|$sortType){
            $this->db->select(
                "distinct('customer.id'),customer.*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,k.keyword as keyword");
        }else if($size|$sortType){
            // @zzr edit at 2016-12-20 09:51
            if(empty($size) && !empty($sortType)){
                $this->db->select("count(nb_customer.id) as num ");
            }else{
                $this->db->select(
                "*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,e.name as ename,d.name as dname");
            }

        }else if(!$size|!$sortType&&!$share_status) {
            $this->db->select("count(nb_customer.id) as num ");
        }else if($share_status&&!$size|!$sortType){
            $this->db->select("count(distinct(nb_customer.id)) as num ");
        }

        //联系状态查询
        $start = $linkDay == 5 ? 4 : $linkDay;//5天内 包含第4天
        $end = $linkDay + 1;
        if($linkDay!=null){
            $startDay = strtotime(date("Y-m-d",strtotime("+$start day")));
            $endDay = strtotime(date("Y-m-d",strtotime("+$end day")));
            switch($linkType) {
                case 1:$this->db->where("customer.follow_status",0);break;
                case 2:
                    $this->db->group_by("fc.customer_id");
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                    $this->db->where("fc.next_time>=",$startDay);
                    $this->db->where("fc.next_time<",$endDay);
                    break;
                case 3:
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");

                    $this->db->group_by("fc.customer_id");

                    $this->db->where("fc.time>",$startDay);

                    $this->db->where("fc.time<",$endDay);
                    break;
                default:
            }
        }


        switch($sortType) {//排序处理
            // case 1:$this->db->order_by('time desc'); break;
            case 1:
                if($linkType != 2 && $linkType != 3){
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                }
                $this->db->group_by('nb_customer.id');
                $this->db->order_by('time desc'); 
                break;
            case 2:$this->db->order_by('CONVERT(`nb_customer`.name USING gbk ) ');break;
            case 3:$this->db->order_by('customer.create_time desc');break;
            case 10 : $this->db->order_by('customer.create_time desc'); break;
            case 11 : $this->db->order_by('cc.add_time desc'); break;
            default : $this->db->order_by('create_time desc');
        }

        // 无，A，B，C，D类客户
        if(isset($status)&&$status!=null){
            $statusArray=explode(",",$status);
            $this->db ->where_in("customer.status",array_filter($statusArray));
        }

        //标签查询
        if($tag){
            $tags=explode(",",$tag);
            $tags= array_filter($tags);
            $this->db->join("custom_tag ct","customer.id=ct.cus_id","left");
            $this->db->group_by("ct.cus_id");
            $this->db->where_in("ct.tag_id",$tags);
        }

        //重点客户
        if($will_status<>""){

            $will_status= substr($will_status,0,-1);

            $will_status=explode(",",$will_status);
            $this->db->where_in("will_status",$will_status);

        }
        //推广客户
        if($sign_status<>""){
            $sign_status=substr($sign_status,0,-1);
            $sign_status=explode(",",$sign_status);
            $this->db->where_in("sign_status",$sign_status);
        }

        //搜索条件查询
        switch($searchType) {
            case 1:$this->db->like('customer.name', $searchText, 'both');break;
            case 2:$this->db->like('link.mobile', $searchText, 'both');break;
            case 3:$this->db->like('link.qq', $searchText, 'both');break;
            case 4:$this->db->like('link.email', $searchText, 'both');break;
            case 10:$this->db->where('extend_status',1);break;
            case 11:$this->db->like('link.name', $searchText, 'both');break;
            case 12:$this->db->where('customer.new_user_id', $searchText);break;
            default:
        }
        // 按来源渠道搜索用于售前客服
        if($searchType >= 20){
            $this->db->where("(channel_id in(".$searchType.") or channel_id_2 in(".$searchType.") or channel_id_3 in(".$searchType."))");
        }


        //录入时间段查询
        if($createStartTime&&$createEndTime){
            $start_time= strtotime($createStartTime);
            $end_time= strtotime($createEndTime);
            $this->db->where("customer.create_time>=",$start_time);
            $this->db->where("customer.create_time<",$end_time);

        }

        //是否是公海
        if($isPublic) {
            $this->db->where("customer.public_state",1);
        }else if(!empty($user_chis)){
            $user_chis_arr = explode('|', $user_chis);
            if(isset($user_chis_arr[1]) && $user_chis_arr[1] == 5){
                $this->db->where("customer.custom_service",$user_chis_arr[0]);
            }else{
                $this->db->where("customer.new_user_id",$user_chis_arr[0]);    
            }
            $this->db->where("customer.public_state",0);
        }else if($zhuguan!="admin"&&$zhuguan) {
            //主管，客户信息显示全部部门
            $this->db->join("employee e","customer.creator=e.user_id","left");
            $this->db->join("department d","e.department_no=d.id","left");
            $this->db->where("customer.public_state",0);

            if(is_array($zhuguan)){
                $this->db->where_in('d.id',$zhuguan);
            }else{
                if($is_sq){
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("((nb_customer.custom_service != ".$user->id." or nb_customer.creator != ".$user->id." or nb_customer.new_user_id != ".$user->id.") and d.id=".$zhuguan.")");
                    }else{
                        $this->db->where("(nb_customer.custom_service=".$user->id." or d.id=".$zhuguan.")");    
                    }
                    // $this->db->where("d.id",$zhuguan);
                }else{
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
                    }
                    $this->db->where("d.id",$zhuguan);
                }
            }

            // @zzr edit at 2016-12-09 11:21
            if($noassgin_flag){ // 查询售前客服未指派的客户
                $this->db->where("nb_customer.new_user_id = nb_customer.custom_service");
            }
        }else if($zhuguan=="admin"){
            //管理员客户信显示全部用户的客户
            $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
        }else if($share_status==1){
            //共享客户
            $this->db->where("s.share",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($share_status==2){
            //共享客户
            $this->db->where("s.be_shared",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($is_sq){
            $this->db->where("(nb_customer.custom_service=".$user->id.")");
        }else if($noassgin_flag){ // 未指派客户
            $this->db->where("nb_customer.new_user_id = nb_customer.custom_service and nb_customer.new_user_id = ".$user->id);
        }else if($this_cusids === '' || !empty($this_cusids)){
            $this_cusids = empty($this_cusids) ? 0 : $this_cusids;
            $this->db->where('nb_customer.id in('.$this_cusids.')');
        }else{
            //不是公海，创建人是登陆用户  或者  所有人是登陆用户
            $this->db->where("customer.public_state",0);
            $this->db->where("((nb_customer.creator = ".$user->id." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$user->id.")");
        }

        //分页
        if($size && $offset||$offset==0){
            $this->db->limit($size,$offset);
        }

        // @zzr edit at 2016-12-20 10:08 来源渠道组合查询条件
        if(!empty($chids)){
            $chids = trim($chids,',');
            if(!in_array('-1', explode(',' , trim($chids,',')))){
                $this->db->where("(channel_id in(".$chids.") or channel_id_2 in(".$chids.") or channel_id_3 in(".$chids."))");
            }
        }

        // @zzr edit at 2016-12-20 10:08 按放入公海时间倒叙
        if($sortType == 11){
            $this->db->join('customer_change cc','customer.id=cc.customer_id','left');
            $this->db->where('cc.change_type',1);
            $this->db->group_by('nb_customer.id');
        }

		if($_GET["department"]){
			$this->db->where("customer.department_no=".$_GET["department"]);			
		}
		$this->db->where("customer.is_huixiao=0");
		
        $this->db->join('keyword k','customer.keyword_id=k.id','left');//关键词
        $this->db->join('linkman link','customer.linkman_id=link.id','left');
        $this->db->join("custom_position cp","cp.id=link.position_id","left");
		
		
		$this->db->join("user u","u.id=customer.creator","left");
		$this->db->join("employee e","e.user_id=u.id","left");
		
		$this->db->join("department d","d.id=e.department_no","left");
		
		//$this->db->limit(0, 100);
		
        $query = $this->db->get('customer');
		//$query = $this->db->select('*');
         //echo $this->db->last_query();
         //die;		


        // echo $this->db->last_query();
        // die;

        return $query;
    }


	
    function queryCustomer_sea_hx($user, $size, $offset, $linkType = 0,
                           $linkDay = 0, $sortType = 0, $status, $tag,$searchType, $searchText,
                           $createStartTime, $createEndTime, $isPublic , $zhuguan = false ,$will_status = "", $sign_status = "" , $share_status = false,$noassgin_flag = false ,$is_sq = false ,$chids = null ,$only_chis = false , $this_cusids = null , $user_chis = null) {

        set_time_limit(0);
        // ini_set('memory_limit' , '1024M'); 

        if($share_status&&$size|$sortType){
            $this->db->select(
                "distinct('customer.id'),customer.*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,k.keyword as keyword");
        }else if($size|$sortType){
            // @zzr edit at 2016-12-20 09:51
            if(empty($size) && !empty($sortType)){
                $this->db->select("count(nb_customer.id) as num ");
            }else{
                $this->db->select(
                "*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,e.name as ename,d.name as dname");
            }

        }else if(!$size|!$sortType&&!$share_status) {
            $this->db->select("count(nb_customer.id) as num ");
        }else if($share_status&&!$size|!$sortType){
            $this->db->select("count(distinct(nb_customer.id)) as num ");
        }

        //联系状态查询
        $start = $linkDay == 5 ? 4 : $linkDay;//5天内 包含第4天
        $end = $linkDay + 1;
        if($linkDay!=null){
            $startDay = strtotime(date("Y-m-d",strtotime("+$start day")));
            $endDay = strtotime(date("Y-m-d",strtotime("+$end day")));
            switch($linkType) {
                case 1:$this->db->where("customer.follow_status",0);break;
                case 2:
                    $this->db->group_by("fc.customer_id");
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                    $this->db->where("fc.next_time>=",$startDay);
                    $this->db->where("fc.next_time<",$endDay);
                    break;
                case 3:
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");

                    $this->db->group_by("fc.customer_id");

                    $this->db->where("fc.time>",$startDay);

                    $this->db->where("fc.time<",$endDay);
                    break;
                default:
            }
        }


        switch($sortType) {//排序处理
            // case 1:$this->db->order_by('time desc'); break;
            case 1:
                if($linkType != 2 && $linkType != 3){
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                }
                $this->db->group_by('nb_customer.id');
                $this->db->order_by('time desc'); 
                break;
            case 2:$this->db->order_by('CONVERT(`nb_customer`.name USING gbk ) ');break;
            case 3:$this->db->order_by('customer.create_time desc');break;
            case 10 : $this->db->order_by('customer.create_time desc'); break;
            case 11 : $this->db->order_by('cc.add_time desc'); break;
            default : $this->db->order_by('create_time desc');
        }

        // 无，A，B，C，D类客户
        if(isset($status)&&$status!=null){
            $statusArray=explode(",",$status);
            $this->db ->where_in("customer.status",array_filter($statusArray));
        }

        //标签查询
        if($tag){
            $tags=explode(",",$tag);
            $tags= array_filter($tags);
            $this->db->join("custom_tag ct","customer.id=ct.cus_id","left");
            $this->db->group_by("ct.cus_id");
            $this->db->where_in("ct.tag_id",$tags);
        }

        //重点客户
        if($will_status<>""){

            $will_status= substr($will_status,0,-1);

            $will_status=explode(",",$will_status);
            $this->db->where_in("will_status",$will_status);

        }
        //推广客户
        if($sign_status<>""){
            $sign_status=substr($sign_status,0,-1);
            $sign_status=explode(",",$sign_status);
            $this->db->where_in("sign_status",$sign_status);
        }

        //搜索条件查询
        switch($searchType) {
            case 1:$this->db->like('customer.name', $searchText, 'both');break;
            case 2:$this->db->like('link.mobile', $searchText, 'both');break;
            case 3:$this->db->like('link.qq', $searchText, 'both');break;
            case 4:$this->db->like('link.email', $searchText, 'both');break;
            case 10:$this->db->where('extend_status',1);break;
            case 11:$this->db->like('link.name', $searchText, 'both');break;
            case 12:$this->db->where('customer.new_user_id', $searchText);break;
            default:
        }
        // 按来源渠道搜索用于售前客服
        if($searchType >= 20){
            $this->db->where("(channel_id in(".$searchType.") or channel_id_2 in(".$searchType.") or channel_id_3 in(".$searchType."))");
        }


        //录入时间段查询
        if($createStartTime&&$createEndTime){
            $start_time= strtotime($createStartTime);
            $end_time= strtotime($createEndTime);
            $this->db->where("customer.create_time>=",$start_time);
            $this->db->where("customer.create_time<",$end_time);

        }

        //是否是公海
        if($isPublic) {
            $this->db->where("customer.public_state",1);
        }else if(!empty($user_chis)){
            $user_chis_arr = explode('|', $user_chis);
            if(isset($user_chis_arr[1]) && $user_chis_arr[1] == 5){
                $this->db->where("customer.custom_service",$user_chis_arr[0]);
            }else{
                $this->db->where("customer.new_user_id",$user_chis_arr[0]);    
            }
            $this->db->where("customer.public_state",0);
        }else if($zhuguan!="admin"&&$zhuguan) {
            //主管，客户信息显示全部部门
            $this->db->join("employee e","customer.creator=e.user_id","left");
            $this->db->join("department d","e.department_no=d.id","left");
            $this->db->where("customer.public_state",0);

            if(is_array($zhuguan)){
                $this->db->where_in('d.id',$zhuguan);
            }else{
                if($is_sq){
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("((nb_customer.custom_service != ".$user->id." or nb_customer.creator != ".$user->id." or nb_customer.new_user_id != ".$user->id.") and d.id=".$zhuguan.")");
                    }else{
                        $this->db->where("(nb_customer.custom_service=".$user->id." or d.id=".$zhuguan.")");    
                    }
                    // $this->db->where("d.id",$zhuguan);
                }else{
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
                    }
                    $this->db->where("d.id",$zhuguan);
                }
            }

            // @zzr edit at 2016-12-09 11:21
            if($noassgin_flag){ // 查询售前客服未指派的客户
                $this->db->where("nb_customer.new_user_id = nb_customer.custom_service");
            }
        }else if($zhuguan=="admin"){
            //管理员客户信显示全部用户的客户
            $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
        }else if($share_status==1){
            //共享客户
            $this->db->where("s.share",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($share_status==2){
            //共享客户
            $this->db->where("s.be_shared",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($is_sq){
            $this->db->where("(nb_customer.custom_service=".$user->id.")");
        }else if($noassgin_flag){ // 未指派客户
            $this->db->where("nb_customer.new_user_id = nb_customer.custom_service and nb_customer.new_user_id = ".$user->id);
        }else if($this_cusids === '' || !empty($this_cusids)){
            $this_cusids = empty($this_cusids) ? 0 : $this_cusids;
            $this->db->where('nb_customer.id in('.$this_cusids.')');
        }else{
            //不是公海，创建人是登陆用户  或者  所有人是登陆用户
            $this->db->where("customer.public_state",0);
            $this->db->where("((nb_customer.creator = ".$user->id." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$user->id.")");
        }

        //分页
        //if($size && $offset||$offset==0){
         //   $this->db->limit($size,$offset);
       // }
		
        // @zzr edit at 2016-12-20 10:08 来源渠道组合查询条件
        if(!empty($chids)){
            $chids = trim($chids,',');
            if(!in_array('-1', explode(',' , trim($chids,',')))){
                $this->db->where("(channel_id in(".$chids.") or channel_id_2 in(".$chids.") or channel_id_3 in(".$chids."))");
            }
        }

        // @zzr edit at 2016-12-20 10:08 按放入公海时间倒叙
        if($sortType == 11){
            $this->db->join('customer_change cc','customer.id=cc.customer_id','left');
            $this->db->where('cc.change_type',1);
            $this->db->group_by('nb_customer.id');
        }

		$this->db->where("customer.is_huixiao=1");
		
        $this->db->join('keyword k','customer.keyword_id=k.id','left');//关键词
        $this->db->join('linkman link','customer.linkman_id=link.id','left');
        $this->db->join("custom_position cp","cp.id=link.position_id","left");
		
		
		$this->db->join("user u","u.id=customer.creator","left");
		$this->db->join("employee e","e.user_id=u.id","left");
		
		$this->db->join("department d","d.id=e.department_no","left");
		
		//$b=$offset;
		
		//if($offset>100){
		////	$rand=rand(100,$offset);
		//	$b=$rand-100;
		//	$this->db->limit($b,$rand);			
		//}
		
		$this->db->limit(100,0);
		
		
        $query = $this->db->get('customer');
		//$query = $this->db->select('*');
         //echo $this->db->last_query();
         //die;		


       // echo $this->db->last_query();
    //  die;

        return $query;
    }

	
	

    function queryCustomer_hx($user, $size, $offset, $linkType = 0,
                           $linkDay = 0, $sortType = 0, $status, $tag,$searchType, $searchText,
                           $createStartTime, $createEndTime, $isPublic , $zhuguan = false ,$will_status = "", $sign_status = "" , $share_status = false,$noassgin_flag = false ,$is_sq = false ,$chids = null ,$only_chis = false , $this_cusids = null , $user_chis = null) {

        set_time_limit(0);
        // ini_set('memory_limit' , '1024M'); 

        if($share_status&&$size|$sortType){
            $this->db->select(
                "distinct('customer.id'),customer.*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,k.keyword as keyword");
        }else if($size|$sortType){
            // @zzr edit at 2016-12-20 09:51
            if(empty($size) && !empty($sortType)){
                $this->db->select("count(nb_customer.id) as num ");
            }else{
                $this->db->select(
                "*,customer.status as sta ,customer.name as cname ,customer.id as cus_id,customer.address,link.name as linkman_name, link.mobile as linkman_mobile,(select time from nb_follow_customer where customer_id=nb_customer.id order by time desc limit 1) as time,cp.name as linkman_job,e.name as ename,d.name as dname");
            }

        }else if(!$size|!$sortType&&!$share_status) {
            $this->db->select("count(nb_customer.id) as num ");
        }else if($share_status&&!$size|!$sortType){
            $this->db->select("count(distinct(nb_customer.id)) as num ");
        }

        //联系状态查询
        $start = $linkDay == 5 ? 4 : $linkDay;//5天内 包含第4天
        $end = $linkDay + 1;
        if($linkDay!=null){
            $startDay = strtotime(date("Y-m-d",strtotime("+$start day")));
            $endDay = strtotime(date("Y-m-d",strtotime("+$end day")));
            switch($linkType) {
                case 1:$this->db->where("customer.follow_status",0);break;
                case 2:
                    $this->db->group_by("fc.customer_id");
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                    $this->db->where("fc.next_time>=",$startDay);
                    $this->db->where("fc.next_time<",$endDay);
                    break;
                case 3:
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");

                    $this->db->group_by("fc.customer_id");

                    $this->db->where("fc.time>",$startDay);

                    $this->db->where("fc.time<",$endDay);
                    break;
                default:
            }
        }


        switch($sortType) {//排序处理
            // case 1:$this->db->order_by('time desc'); break;
            case 1:
                if($linkType != 2 && $linkType != 3){
                    $this->db->join("follow_customer fc","nb_customer.id=fc.customer_id","left");
                }
                $this->db->group_by('nb_customer.id');
                $this->db->order_by('time desc'); 
                break;
            case 2:$this->db->order_by('CONVERT(`nb_customer`.name USING gbk ) ');break;
            case 3:$this->db->order_by('customer.create_time desc');break;
            case 10 : $this->db->order_by('customer.create_time desc'); break;
            case 11 : $this->db->order_by('cc.add_time desc'); break;
            default : $this->db->order_by('create_time desc');
        }

        // 无，A，B，C，D类客户
        if(isset($status)&&$status!=null){
            $statusArray=explode(",",$status);
            $this->db ->where_in("customer.status",array_filter($statusArray));
        }

        //标签查询
        if($tag){
            $tags=explode(",",$tag);
            $tags= array_filter($tags);
            $this->db->join("custom_tag ct","customer.id=ct.cus_id","left");
            $this->db->group_by("ct.cus_id");
            $this->db->where_in("ct.tag_id",$tags);
        }

        //重点客户
        if($will_status<>""){

            $will_status= substr($will_status,0,-1);

            $will_status=explode(",",$will_status);
            $this->db->where_in("will_status",$will_status);

        }
        //推广客户
        if($sign_status<>""){
            $sign_status=substr($sign_status,0,-1);
            $sign_status=explode(",",$sign_status);
            $this->db->where_in("sign_status",$sign_status);
        }

        //搜索条件查询
        switch($searchType) {
            case 1:$this->db->like('customer.name', $searchText, 'both');break;
            case 2:$this->db->like('link.mobile', $searchText, 'both');break;
            case 3:$this->db->like('link.qq', $searchText, 'both');break;
            case 4:$this->db->like('link.email', $searchText, 'both');break;
            case 10:$this->db->where('extend_status',1);break;
            case 11:$this->db->like('link.name', $searchText, 'both');break;
            case 12:$this->db->where('customer.new_user_id', $searchText);break;
            default:
        }
        // 按来源渠道搜索用于售前客服
        if($searchType >= 20){
            $this->db->where("(channel_id in(".$searchType.") or channel_id_2 in(".$searchType.") or channel_id_3 in(".$searchType."))");
        }


        //录入时间段查询
        if($createStartTime&&$createEndTime){
            $start_time= strtotime($createStartTime);
            $end_time= strtotime($createEndTime);
            $this->db->where("customer.create_time>=",$start_time);
            $this->db->where("customer.create_time<",$end_time);

        }

        //是否是公海
        if($isPublic) {
            $this->db->where("customer.public_state",1);
        }else if(!empty($user_chis)){
            $user_chis_arr = explode('|', $user_chis);
            if(isset($user_chis_arr[1]) && $user_chis_arr[1] == 5){
                $this->db->where("customer.custom_service",$user_chis_arr[0]);
            }else{
                $this->db->where("customer.new_user_id",$user_chis_arr[0]);    
            }
            $this->db->where("customer.public_state",0);
        }else if($zhuguan!="admin"&&$zhuguan) {
            //主管，客户信息显示全部部门
            $this->db->join("employee e","customer.creator=e.user_id","left");
            $this->db->join("department d","e.department_no=d.id","left");
            $this->db->where("customer.public_state",0);

            if(is_array($zhuguan)){
                $this->db->where_in('d.id',$zhuguan);
            }else{
                if($is_sq){
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("((nb_customer.custom_service != ".$user->id." or nb_customer.creator != ".$user->id." or nb_customer.new_user_id != ".$user->id.") and d.id=".$zhuguan.")");
                    }else{
                        $this->db->where("(nb_customer.custom_service=".$user->id." or d.id=".$zhuguan.")");    
                    }
                    // $this->db->where("d.id",$zhuguan);
                }else{
                    if($only_chis){ // 只看下级录入的客户
                        $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
                    }
                    $this->db->where("d.id",$zhuguan);
                }
            }

            // @zzr edit at 2016-12-09 11:21
            if($noassgin_flag){ // 查询售前客服未指派的客户
                $this->db->where("nb_customer.new_user_id = nb_customer.custom_service");
            }
        }else if($zhuguan=="admin"){
            //管理员客户信显示全部用户的客户
            $this->db->where("(nb_customer.creator != ".$user->id." or  (nb_customer.new_user_id != ".$user->id." and nb_customer.creator !=".$user->id.") )");
        }else if($share_status==1){
            //共享客户
            $this->db->where("s.share",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($share_status==2){
            //共享客户
            $this->db->where("s.be_shared",$this->user_id);
            $this->db->join("share s","s.customer_id=customer.id","left");
        }else if($is_sq){
            $this->db->where("(nb_customer.custom_service=".$user->id.")");
        }else if($noassgin_flag){ // 未指派客户
            $this->db->where("nb_customer.new_user_id = nb_customer.custom_service and nb_customer.new_user_id = ".$user->id);
        }else if($this_cusids === '' || !empty($this_cusids)){
            $this_cusids = empty($this_cusids) ? 0 : $this_cusids;
            $this->db->where('nb_customer.id in('.$this_cusids.')');
        }else{
            //不是公海，创建人是登陆用户  或者  所有人是登陆用户
            $this->db->where("customer.public_state",0);
            $this->db->where("((nb_customer.creator = ".$user->id." and  nb_customer.new_user_id = 0 ) or nb_customer.new_user_id=".$user->id.")");
        }

        //分页
        if($size && $offset||$offset==0){
            $this->db->limit($size,$offset);
        }

        // @zzr edit at 2016-12-20 10:08 来源渠道组合查询条件
        if(!empty($chids)){
            $chids = trim($chids,',');
            if(!in_array('-1', explode(',' , trim($chids,',')))){
                $this->db->where("(channel_id in(".$chids.") or channel_id_2 in(".$chids.") or channel_id_3 in(".$chids."))");
            }
        }

        // @zzr edit at 2016-12-20 10:08 按放入公海时间倒叙
        if($sortType == 11){
            $this->db->join('customer_change cc','customer.id=cc.customer_id','left');
            $this->db->where('cc.change_type',1);
            $this->db->group_by('nb_customer.id');
        }

		$this->db->where("customer.is_huixiao=1");
        $this->db->join('keyword k','customer.keyword_id=k.id','left');//关键词
        $this->db->join('linkman link','customer.linkman_id=link.id','left');
        $this->db->join("custom_position cp","cp.id=link.position_id","left");
		
		
		$this->db->join("user u","u.id=customer.creator","left");
		$this->db->join("employee e","e.user_id=u.id","left");
		
		$this->db->join("department d","d.id=e.department_no","left");
        $query = $this->db->get('customer');
		//$query = $this->db->select('*');
         //echo $this->db->last_query();
        // die;		


        // echo $this->db->last_query();
        // // die;

        return $query;
    }

	
	
	
 /**
     * 验证手机号唯一 企业名称唯一
     * @param $mobile
     * @param $id
     * @return mixed
     */
    function verifyNewCustomer($name, $mobile, $id) {
        $this->db->select("*,customer.name as cname,l.name as lname,p.name as pname,e.name as ename,customer.id as cid,l.mobile as lmobile");
        $this->db->join("linkman l","customer.linkman_id=l.id","left");
        $this->db->join("custom_position p","l.position_id=p.id");
        $this->db->join("employee e","e.user_id=customer.new_user_id","left");
        if($name) {
            $this->db->where('customer.name',$name);
        } else {
            $this->db->where('l.mobile',$mobile);
        }

        $this->db->where('l.customer_id!=',$id);
        $result=$this->db->get('customer');
        if($result->result_array()){
            $this->db->select("*,customer.name as cname,l.name as lname,p.name as pname,e.name as ename,customer.id as cid,l.mobile as lmobile");
            $this->db->join("linkman l","customer.linkman_id=l.id","left");
            $this->db->join("custom_position p","l.position_id=p.id");
            // $this->db->join("employee e","e.user_id=customer.creator","left");
            // @zzr edit at 2016-12-22 17:40
            $this->db->join("employee e","e.user_id=customer.new_user_id","left");
            if($name) {
                $this->db->where('customer.name',$name);
            } else {
                $this->db->where('l.mobile',$mobile);
            }
            $this->db->where('l.customer_id!=',$id);
            $result=$this->db->get('customer');
        }

        return $result->result();
    }

    //录入客户
    public function add($data){
        $result=$this->db->insert('customer',$data);
        return $result;
    }
    //客户职位
    public function get_position(){
        $result=$this->db->get('custom_position');
        return $result->result();
    }
    //根据手机号查询客户
    public function mobile_customer($mobile,$id){
            $this->db->select("*,customer.name as cname,l.name as lname,p.name as pname");
            $this->db->join("linkman l","customer.linkman_id=l.id","left");
            $this->db->join("custom_position p","l.position_id=p.id");
            $this->db->where('l.mobile',$mobile);
            $this->db->where('l.customer_id!=',$id);
            $result=$this->db->get('customer');
        return $result->result();
    }
    //根据企业名称查询客户是否存在
    public function cusname_customer($name,$id){
            $this->db->select("*,customer.name as cname,l.name as lname,p.name as pname,customer.id as cid");
            $this->db->join("linkman l","customer.linkman_id=l.id");
            $this->db->join("custom_position p","l.position_id=p.id");
            $this->db->where('customer.name',$name);
            $this->db->where('customer.id!=',$id);
            $result=$this->db->get('customer');
        return $result->result();
    }
    //单个客户的详细信息
    public function customer_info($id,$public){
        $this->db->select("*,customer.status as sta ,customer.followstage as folstage ,customer.name as cname ,customer.id as cus_id,e.name as ename");
        $this->db->join("user u","customer.creator=u.id","left");
        $this->db->join("employee e","e.user_id=u.id","left");
        //关键词
        $this->db->join('keyword k','customer.keyword_id=k.id','left');
        $this->db->where('customer.id',$id);
        $query=$this->db->get('customer')->result();
        //客户流转历史
        $this->db->where('customer_id',$id);
        $this->db->order_by('add_time desc');
        $this->db->limit(4);
        $customer_change=$this->db->get('customer_change')->result_array();

        foreach($query as  $k=>$v){
            $linkman=$this->linkman_model->cus_linkman($v->cus_id);
            $query[$k]->linkman= $linkman;
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
        $str="";
        foreach($query as $k=>$v) {
            if ($v->create_time) {
                $str.='<div class="mt49 ml9">';
                if(!$public){
                    $str.='
                            <h4>客户分类</h4>
                            <select class="form-control" onchange="status_change(this)">';
                    if($v->sta==-1){
                        $str.='  <option value="-1" selected="selected">无分类</option>';
                    }else{
                        $str.='  <option value="-1">无分类</option>';
                    }
                    if($v->sta==1){
                        $str.='  <option selected="selected" value="1">A</option>';
                    }else{
                        $str.='  <option value="1">A类客户</option>';
                    }
                    if($v->sta==2){
                        $str.='  <option selected="selected" value="2">B</option>';
                    }else{
                        $str.='  <option value="2">B类客户</option>';
                    }
                    if($v->sta==3){
                        $str.='  <option selected="selected" value="3">C</option>';
                    }else{
                        $str.='  <option value="3">C类客户</option>';
                    }
                    if($v->sta==4){
                        $str.='  <option selected="selected" value=4">D</option>';
                    }else{
                        $str.='  <option value="4">D类客户</option>';
                    }

                    $str.='  </select>';
                    // @zzr edit at 2016-12-23 08:32 新增客户
                     $str.='
                            <h4>跟进阶段</h4>
                            <select class="form-control" onchange="followstage_change(this)">';
                    if($v->folstage == -1){
                        $str.='  <option value="0" selected="selected">初期</option>';
                    }else{
                        $str.='  <option value="0">初期</option>';
                    }
                    if($v->folstage == 1){
                        $str.='  <option selected="selected" value="1">需求调研</option>';
                    }else{
                        $str.='  <option value="1">需求调研</option>';
                    }
                    if($v->folstage == 2){
                        $str.='  <option selected="selected" value="2">已立项</option>';
                    }else{
                        $str.='  <option value="2">已立项</option>';
                    }
                    if($v->folstage == 3){
                        $str.='  <option selected="selected" value="3">已报价</option>';
                    }else{
                        $str.='  <option value="3">已报价</option>';
                    }
                    if($v->folstage == 4){
                        $str.='  <option selected="selected" value=4">合同跟进</option>';
                    }else{
                        $str.='  <option value="4">合同跟进</option>';
                    }
                    if($v->folstage == 5){
                        $str.='  <option selected="selected" value=5">签约</option>';
                    }else{
                        $str.='  <option value="5">签约</option>';
                    }

                    $str.='  </select>';
                }
                $str .='<h4 class="mt15">客户所属变更历史</h4>';
                foreach($customer_change as $key=>$log){
                    if($log['change_type']==0){
                        $str.='<p class="customerTime">'.date('Y-m-d H:i:s',$log['add_time']).'由'.$log['cus_to'].'操作</p>';
                        $str.='<p class="customerName">'.$log['cus_from'].' <i class="fa fa-long-arrow-right"></i> '.$log['cus_to'].' </p>';
                    }else if($log['change_type']==1){
                        $str.='<p class="customerTime">'.date('Y-m-d H:i:s',$log['add_time']).'</p>';
                        $str.='<p class="customerName">'.$log['change_text'].' </p>';
                    }else if($log['change_type']==2){
                        // $str.='<p class="customerTime">'.date('Y-m-d H:i:s',$log['add_time']).'由'.$log['cus_to'].'操作</p>';
                        // @zzr edit at 2016-12-21 11:29
                        $str.='<p class="customerTime">'.date('Y-m-d H:i:s',$log['add_time']).'由'.$log['cus_from'].'操作</p>';
                        $str.='<p class="customerName">'.$log['cus_from'].' <i class="fa fa-long-arrow-right"></i> '.$log['cus_to'].' </p>';
                        // @zzr edit at 2016-12-21 11:29
                        // $str.='<p class="customerName">'.$log['change_text'];
                    }else if($log['change_type']==3){
                        $str.='<p class="customerTime">'.date('Y-m-d H:i:s',$log['add_time']).'由'.$log['cus_to'].'操作</p>';
                        $str.='<p class="customerName">'.$log['cus_from'].'分享给'.$log['cus_to'].' </p>';
                    }

                }
                $str .= '
                <h4 class="mt15">联系人信息</h4>';
                foreach($v->linkman as $key=>$val){
                    if($val->lname){
                        $str.='<p>'.$val->lname.'';
                    }else{
                        $str.='<p>未知';
                    }
                    $str.='&nbsp;&nbsp;&nbsp;'.$val->cpname.'</p>
                       ';
                    $str .= ' <p style="font-size: 15px; color: #00B2E2;">'.$val->mobile.'</p>';
                    // @zzr edit at 2016-12-20 11:51
                    $str .= ' <p style="font-size: 15px; color: #00B2E2;">'.$val->cus_tel.'</p>';
                    if($val->qq){
                        $str.=' <p><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=' . $val->qq . '&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:' . $val->qq . ':51" alt="点击进行和客户聊天" title="点击进行和客户聊天"/></a><span style="font-size:10px;">(' .$val->qq . ')</span></p>';
                    }
                    $str.=' <p>'.$val->email.'</p>
                           <p>'.$val->URL.'</p>';
                }
                $str .= '
                <h4 class="mt15">详细信息</h4>
                <div class="">
                    <span>客户预算</span>
                     <p>' . $v->budget . '元</p>
                </div>
                <div class="">
                    <span>创建时间</span>
                     <p>' . date("Y-m-d H:i:s", $v->create_time) . '</p>
                </div>';
            }
            if ($v->ename) {
                $str .= ' <div class="">
                    <span>录入人</span>
                  <p>' . $v->ename . '</p>
                </div>';
            }
            if ($v->corporate_name) {
                $str .= '<div class="">
                    <span>法定代表人</span>
                    <p>' . $v->corporate_name . '</p>
                </div>';
            }
            if ($v->bd_ranking) {
                $str .= ' <div class="">
                    <span>页数</span>
                  <p>' . $v->bd_ranking . '</p>
                </div>';
            }
            if ($v->keyword) {
                $str .= ' <div class="">
                    <span>推广词</span>
                  <p>' . $v->keyword . '</p>
                </div>';
            }
            if ($v->province_no) {
                $str .= ' <div class="">
                    <span>区域</span>
                     <p>' . $v->province_no . $v->city_no . $v->county_no . '</p>
                </div>';
            }
            if ($v->company_size) {
                $str .= ' <div class="">
                    <span>公司规模</span>
                  <p>' . $v->company_size . '</p>
                </div>';
            }
            if ($v->address) {
                $str .= ' <div class="">
                    <span>公司地址</span>
                  <p>' . $v->address . '</p>
                </div>';
            }
            if ($v->cus_content) {
                $str .= ' <div class="">
                    <span>公司简介</span>
                  <p>' . $v->cus_content . '</p>
                </div>';
            }
            $str.='  </div>';
        }
        return $str;
    }
    //客户联系人
    public function linkman_cus($id,$public)
    {
        $this->db->where('customer_id', $id);
        $this->db->select('*,linkman.name as lname,cp.name as cpname,linkman.id as lid');
        $this->db->join('custom_position cp', "cp.id=linkman.position_id");
        $result = $this->db->get('linkman')->result();
        // echo json_encode($result);
        $str = '
                                    <thead>
                                    <tr class="fb">
                                        <td>姓名</td>
                                        <td>手机号码</td>
                                        <td>职位</td>
                                        <td>QQ</td>
                                        <td>E-mail</td>
                                    </tr>
                                    </thead>
                                   ';

        $linkman_log_str = '<th><tr class="fb"><td>姓名</td><td>修改时间</td><td>操作人</td><td colspan=2>变更内容</td></tr></th>';
        $linkman_ids = '';

        foreach ($result as $k => $v) {
            $str.=' <tr>';
            if(!$public){
                // $str.=' <td><a class="link" onclick="up_linkman(obj)" data-href="'.base_url().'index.php/customer/update_linkman?&link_id='.$v->lid.'" >' . $v->lname . '</a></td>';
                // // @zzr edit at 2017-01-12 17:25
                $str.=' <td><a class="cus_linkman_info" link_id="'.$v->lid.'" >' . $v->lname . '</a></td>';
            }else{
                $str.=' <td>' . $v->lname . '</td>';
            }
            $str.=' <td>'.$v->mobile.'</td>
                                        <td>'.$v->cpname.'</td>
                                        <td>' . $v->qq . '</td>
                                        <td><a href="mailto:' . $v->email . '" style="font-weight:bold;">' . $v->email . '</a></td>
                                    </tr>';
            $linkman_ids = $linkman_ids . ($v->lid).',';
        }

        // 联系人手机号变更记录表
        $this->db->select('ll.cus_id,ll.user_id,ll.add_time,ll.link_text,ll.link_from,ll.link_to,e.name,l.name as lname');
        $this->db->from('linkman_log ll');
        $this->db->join('employee e','e.user_id=ll.user_id','left');
        $this->db->join('linkman l','l.id=ll.cus_id','left');
        $this->db->order_by('ll.add_time desc');
        $this->db->where('ll.cus_id in('.trim($linkman_ids , ',').')');                    
        $linkman_logs = $this->db->get()->result_array();

        foreach($linkman_logs as $value){
            $linkman_log_str = $linkman_log_str.
                '<tr><td>'.$value['lname'].'</td>'.
                '<td>'. date('Y-m-d H:i',$value['add_time']).'</td>'.
                '<td>'.$value['name'].'</td>'.
                '<td colspan=2>'.$value['link_from'].' <b> >>></b><br/> '.$value['link_to'].'</td></tr>';
        }

        if($linkman_log_str != '<th><tr class="fb"><td>姓名</td><td>修改时间</td><td>操作人</td><td colspan=2>变更内容</td></tr></th>'){
            $str = $str.'<tr border="0"><td colspan=5 style="border:none"></tr>
                        <tr border="0"><td colspan=5 style="border:none"></tr>
                        <tr border="0"><td colspan=5 style="border:none"></tr>
                        <tr><td colspan=5><b>客户联系人手机号变更记录</b></td></tr>';
            $str = $str.$linkman_log_str;
        }

        return $str;
    }
    //未联系
    public function not_contact($id){
        $this->db->where('creator',$id->id);
        $this->db->where('follow_status',0);
        $not_contact=$this->db->get('customer')->result_array();
        return $not_contact;
    }
    //已联系
    public function contact($id,$start_time,$end_time,$type){
        $sql="select * from nb_customer c LEFT  JOIN  nb_follow_customer f on c.id=f.customer_id where (c.creator = ".$id->id."  or  c.new_user_id = ".$id->id.")";
        if($start_time&&$end_time){
            $sql.=" and f.time>=".$start_time." and f.time<".$end_time;
        }
        if($type==1){
            $yday=strtotime(date("Y-m-d",strtotime("-1 day")));
            $today=strtotime(date("Y-m-d"));
            $sql.=" and f.time>= ".$yday." and f.time<".$today;
        }else if($type==2){
            $sql.=" and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(f.time))";
        }else if($type==3){
            $sql.=" and  DATE_FORMAT(FROM_UNIXTIME(f.time), '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m' )";
        }else if(!$start_time&&!$end_time){
            $today_time=strtotime(date("Y-m-d"));
            $tomorrow_time=strtotime(date("Y-m-d",strtotime("+1 day")));
            $sql.=" and f.time>=".$today_time." and f.time<".$tomorrow_time;
        }
        $sql.=" group by f.customer_id";
        $contact=$this->db->query($sql)->result_array();
        return $contact;
    }
    //待联系
    public function to_becontact($id,$start_time,$end_time,$type){
        $sql="select * from nb_customer c LEFT  JOIN  nb_follow_customer f on c.id=f.customer_id where (c.creator = ".$id->id."  or  c.new_user_id = ".$id->id.")";
        if($start_time&&$end_time){
            $sql.=" and f.next_time>=".$start_time." and f.next_time<".$end_time;
        }
        if($type==1){
            $yday=strtotime(date("Y-m-d",strtotime("-1 day")));
            $today=strtotime(date("Y-m-d"));
            $sql.=" and f.next_time>= ".$yday." and f.next_time<".$today;
        }else if($type==2){
            $sql.=" and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(f.next_time))";
        }else if($type==3){
            $sql.=" and  DATE_FORMAT(FROM_UNIXTIME(f.next_time), '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m' )";
        }else if(!$start_time&&!$end_time){
            $today_time=strtotime(date("Y-m-d"));
            $tomorrow_time=strtotime(date("Y-m-d",strtotime("+1 day")));
            $sql.=" and f.next_time>=".$today_time." and f.next_time<".$tomorrow_time;
        }
        $sql.=" group by f.customer_id";
        $to_becontact=$this->db->query($sql)->result_array();
        return $to_becontact;
    }
    //已签约
    public function sign_customer($id,$start_time,$end_time,$type){
        $sql="select * from nb_customer c left join nb_customer_log cl on c.id=cl.cus_id
      WHERE
	c.sign_status = 1 AND cl.type_log = 3
	AND  c.public_state=0
      AND
      (c.creator = ".$id->id."  or  c.new_user_id = ".$id->id.")
      ";
        if($start_time&&$end_time){
            $sql.=" and cl.add_time>=".$start_time." and cl.add_time<".$end_time;
        }
        if($type==1){
            $yday=strtotime(date("Y-m-d",strtotime("-1 day")));
            $today=strtotime(date("Y-m-d"));
            $sql.=" and cl.add_time>= ".$yday." and cl.add_time<".$today;
        }else if($type==2){
            $sql.=" and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(cl.add_time))";
        }else if($type==3){
            $sql.=" and  DATE_FORMAT(FROM_UNIXTIME(cl.add_time), '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m' )";
        }else if(!$start_time&&!$end_time){
            $today_time=strtotime(date("Y-m-d"));
            $tomorrow_time=strtotime(date("Y-m-d",strtotime("+1 day")));
            $sql.=" and cl.add_time>=".$today_time." and cl.add_time<".$tomorrow_time;
        }
        $sign_customer=$this->db->query($sql)->result_array();
        return $sign_customer;
    }
    //近7日添加客户统计
    public function weekscount($id){
        $weeks=$this->db->query('select count(id) as num, date(from_unixtime(`create_time`)) as time from `nb_customer` where date_sub(curdate(), INTERVAL 6 DAY) <= date(from_unixtime(`create_time`)) and creator='.$id->id.' GROUP BY date(from_unixtime(`create_time`))')->result_array();
        return $weeks;
    }
    //客户分类统计
    public function customer_status($id){
        $cus_status=$this->db->query('select COUNT(id) as num,status from nb_customer where (creator='.$id->id.' or new_user_id='.$id->id.') and public_state=0   GROUP BY `status`')->result_array();
        return $cus_status;
    }
//    public function sign_count($id){
//        $sign=$this->db->query('select count(id) as num from nb_customer where creator='.$id->id.' and sign_status=1 or(public_state=2 and new_user_id='.$id->id.')')->result_array();
//        return $sign;
//    }
//意向客户的数量
    public function will_count(){
        $will_count=$this->db->get('system')->result_array();
        return $will_count[0]['will_count'];
    }
    //我的意向客户数量
    public function my_will_count($id){
        $this->db->where("will_status",1);
        $this->db->where('(nb_customer.creator = '.$id.' or nb_customer.new_user_id = '.$id.')');
        $my_will=$this->db->get('customer')->result_array();
        return count($my_will);
    }
}