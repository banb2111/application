<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/24
 * Time: 13:44
 */
class Users extends  CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->model('log_model');
    }
    public function index(){
        
        //判断是否登录
        if(!$_SESSION['user_id']){
            redirect('users/login');
        }else{
            $this->db->cache_delete_all();
            $id=$_SESSION['user_id'];
            $data['power']=$this->user_model->get_user_power($id->id);
            $user=$this->user_model->get_user($id->id);
            $data['user']=$user;
            //判断是否是主管
            $data['is_zhuguan']=$this->user_model->is_zhuguan($id->id);

            $this->load->view("index",$data);
        }
    }
    public function login(){
        if(!$_SESSION['user_id']){
            $this->input->set_cookie("username",false);
            $this->input->set_cookie("password",false);
        }
        if(empty($_POST['username']) || empty($_POST['password'])){
            $this->load->view("user/login");
        }else {
            $username = isset($_POST['username']) && !empty($_POST['username']) ? trim($_POST['username']) : '';//用户名
            $password = isset($_POST['password'])&&!empty($_POST['password'])?trim($_POST['password']):'';//密码
            $this->db->where("username",$username);
            $this->db->where('status',1);
            $this->db->select("*");
            $user=$this->db->get("user");
            $user=$user->result();
            if($_COOKIE['username']&&$_COOKIE['password']){
                if(trim($user[0]->password) == $_COOKIE['password']){
                    $data=$this->user_model->auth($_COOKIE['username'],md5($_COOKIE['password']));
                    if($data){
                        $_SESSION['user_id']=$data[0];
                        redirect('users');
                    }
                }else{
                    redirect("users/logout");
                }
            }else{
                $this->input->set_cookie("username",$username,time()+3600);
                $this->input->set_cookie("password",md5(trim($password)),time()+3600);
                $this->load->model("user_model");
                if(trim($user[0]->password) == md5(trim($password))) {
                    $data = $this->user_model->auth($username, md5($password));
                    if ($data) {
                        $_SESSION['user_id'] = $data[0];
                        redirect('users');
                    } else {
                        $this->load->view("user/login");
                    }
                }else{
                    redirect("users/logout");
                }

            }
        }
    }

    //登出
    public function logout(){
        $this->db->cache_delete_all();
        $this->input->set_cookie("username",false);
        $this->input->set_cookie("password",false);
        $_SESSION['user_id'] = 0;
        redirect("users");
    }
    //用户管理
    public function  user_admin(){
        //分页配置类
        $this->load->model('page');
        //分页处理类
        $this->load->library('pagination');
        $url = base_url().'index.php/users/menulist/user_admin?'; //导入分页类URL
        $result=$this->db->select("*,u.id as uid,e.name,d.name as dname,c.name as cname,u.type as user_type")->from("user u")
            ->join("employee e","u.id=e.user_id")
            ->join("department d","d.id=e.department_no")
            ->join("company c","c.id=e.company_id")
            ->get()->result();
        $count=count($result);
        $config=$this->page->page($url,$count);
        //分页偏移度
        $pagenum=$_GET['per_page']?$_GET['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=$config['per_page'] * ($pagenum-1);
        }
        //分页处理类
        $this->pagination->initialize($config);
        $data['users']=$this->db->select("*,u.id as uid,e.name,d.name as dname,c.name as cname,u.type as user_type")->from("user u")
            ->join("employee e","u.id=e.user_id")
            ->join("department d","d.id=e.department_no")
            ->join("company c","c.id=e.company_id")
            ->limit($config['per_page'],$offset)
            ->get()->result();
        //分页样式
        $data['pages']=$this->pagination->create_links();
        $data['power']=$this->db->get('power')->result_array();
        $this->load->view("user/user_admin",$data);
    }
    //iframe页面显示
    public function menulist(){
        if ($this->uri->segment(3) === FALSE)
        {
            $product_id = 0;
        }
        else
        {
            $product_id = $this->uri->segment(3);
        }
       if($product_id=="index_v2"){
            $this->load->view("index_v2");
        }else if($product_id=="user_admin"){
           $this->user_admin();
        }else if($product_id=="sys_structure"){
            $this->db->select("*");
            $user=$this->db->get("department");
            // $department=$user->result();
            // @zzr edit at 2016-12-09 14:57
            $department = $this->department_model->get_department_format_obj();

            // p($department);

            // die;
            $this->db->select("*");
            $user=$this->db->get("company");
            $company=$user->result();
            $this->load->view("user/sys_structure",array("department"=>$department,"company"=>$company));
        }else if($product_id=="addUser"){
            $this->db->select("*");
            $user=$this->db->get("department");
            // $department=$user->result();

            // @zzr edit at 2016-12-08 11:32 已封装在 department_model get_department_format()
            // $par_department = $this->db->get_where("department",array('no'=>1))->result_array();
            // foreach($par_department as $val){
            //     $department[] = $val;
            //     // 下一级
            //     $department_1 = $this->db->get_where("department",array('no'=>$val['id']))->result_array();
            //     foreach($department_1 as $val_1){
            //         $val_1['name'] = '&nbsp;&nbsp;&nbsp;&nbsp;--'.$val_1['name'];
            //         $department[] = $val_1;
            //         // 下二级
            //         $department_2 = $this->db->get_where("department",array('no'=>$val_1['id']))->result_array();
            //         foreach($department_2 as $val_2){
            //             $val_2['name'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--'.$val_2['name'];
            //             $department[] = $val_2;
            //         }
            //     }
            // }
            $department = $this->department_model->get_department_format();
            $this->db->select("*");
            $user=$this->db->get("company");
            $company=$user->result();

            $this->load->view("user/addUser",array("department"=>$department,"company"=>$company));
        }else if($product_id=="updatePass"){
            $this->load->view("user/updatePass");
        }else if($product_id=="user_info"){
            $this->load->view("user/user_info");
        }else if($product_id=="bag"){
            $this->load->view("bag");
        }else if($product_id=="index_v1"){
           //首页
            $this->index_list();
        }
    }
    //添加用户
    public function  user_add(){
        $username=$this->input->post("username");
        $this->db->where("username",$username);
        $this->db->select("username");
        $result=$this->db->get("user");
        $username=$result->result();
        if(!$username){
            $keyword_id=$this->input->post("keyword_id");
            //默认推广词
            if($keyword_id){
                $result=$this->db->insert("keyword",array("keyword"=>$keyword_id,"is_default"=>1));
            }
            if($result){
                $keyword_id=$this->db->insert_id();
            }
            $username=$this->input->post("username");
            $password=$this->input->post("password");
            $company_id=$this->input->post("company_id");
            $department_id=$this->input->post("department_id");
            $type=$this->input->post("type");
            $user_data=array(
                'username'=>$username,
                'password'=>md5(trim($password)),
                'type'=>$type,
                'time'=>time(),
                'status'=>1,
            );
            $result=$this->user_model->add($user_data);
            if($result){
                $this->db->where('id',$keyword_id);
                $this->db->update("keyword",array("user_id"=>$result));
                $this->db->where('username',$username);
                $user=$this->db->get('user')->result();
            }
            //添加员工信息
            $employee_data=array(
                'name'=>$_POST['name'],
                'company_id'=>$company_id,
                'department_no'=>$department_id,
                'mobile'=>$this->input->post("mobile"),
                'user_id'=>$user[0]->id,
            );
            $this->load->model('employee_model');
            $this->employee_model->add($employee_data);
            redirect("users/menulist/addUser");
        }else{
            show_error("",'500',"添加失败，该用户已存在！","users/menulist/addUser");
        }
    }
    //部门添加
    public function department_add(){
        $name=$this->input->post("name");
        $department_name=trim(preg_replace('# #', '',$name));
        if(empty($department_name)){
            show_error("",'',"部门名称不能为空！","users/menulist/sys_structure");
            return;
        }
        $department_no=$this->input->post("no");
        $sort=$this->input->post("sort");
        $description=$this->input->post("description");
        $data=array(
            "name"=>$department_name,
            'no'=>$department_no,
            'sort'=>$sort,
            'description'=>$description,
        );
        $this->load->model('department_model');
        $this->db->where("name",$department_name);
        $department=$this->db->get('department')->result();
        if($department){
            show_error("",'',"不能添加重复的部门！","users/menulist/sys_structure");
            return;
        }
        $this->department_model->add($data);
        redirect("users/menulist/sys_structure");
    }
    //添加公司
    public function company_add(){

        $name=$this->input->post("companyName");

        $company_name=trim(preg_replace('# #', '',$name));
        $introduction=$this->input->post("introduction");
        if(empty($company_name)){
            show_error("",'',"公司名称不能为空！","users/menulist/sys_structure");
            return;
        }
        $data=array(
            "name"=>$company_name,
            'introduction'=>$introduction,
        );

        $this->load->model('company_model');
        $this->db->where("name",$company_name);
        $company=$this->db->get('company')->result();
        if($company){
            show_error("",'',"不能添加重复的公司名称！","users/menulist/sys_structure");
            return;
        }
        $this->company_model->add($data);
        redirect('users/menulist/sys_structure');
    }
    public function department(){
        $this->db->select("*");
        $user=$this->db->get("department");
        $user=$user->result();
        $this->load->view("index_v3",array());
    }
    //修改密码
    public  function modify_password(){
        /* 两次密码输入必须相同 */
        $orig_password = $_POST['orig_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $id=$_SESSION['user_id'];
        $this->db->where("id",$id->id);
        $this->db->select("password");
        $result=$this->db->get("user");
        $user=$result->result();
        $orig_password=md5(trim($orig_password));
        if(trim($user[0]->password)!=$orig_password){
            show_error('','','密码输入错误','users/menulist/updatePass');
        }
        if ($new_password != $confirm_password) {
            show_error('','','两次输入的密码不一致！','users/menulist/updatePass');
        }
        if(!$new_password){
            show_error('','','请输入新密码','users/menulist/updatePass');
        }
        $this->db->where("id",$id->id);
        $new_password=md5(trim($new_password));
        $result=$this->db->update("user",array("password"=>$new_password));
        if($result){
            redirect("users/logout");
        }
    }
    /*
     * 首页显示数据
     * */
    public function index_list(){
        $id=$_SESSION['user_id'];
        $type=$_GET['type'];//1：昨天，2：近7天，3：本月
        $start_time=$_GET['start_time'];
        $end_time=$_GET['end_time'];
        $start_time=strtotime($start_time);
        $end_time=strtotime($end_time);
        //未联系客户数量
        $not_contact=$this->customer_model->not_contact($id,$start_time,$end_time);
        $data['not_contact_count']=count($not_contact);

        //已联系客户数量
        $contact=$this->customer_model->contact($id,$start_time,$end_time,$type);
        $data['contact_count']=count($contact);

        //待联系客户数量
        $to_becontact=$this->customer_model->to_becontact($id,$start_time,$end_time,$type);
        $data['to_becontact_count']=count($to_becontact);

        //签约客户数量
        $sign_customer=$this->customer_model->sign_customer($id,$start_time,$end_time,$type);
        $data['sign_customer_count']=count($sign_customer);
        $this->load->view("user/welcome",$data);


    }
    //七天新增客户统计
    public function weeks_add_cus(){
        $id=$_SESSION['user_id'];
        //7天新增客户统计
        $weeks=$this->customer_model->weekscount($id);
        $newWeeks = array();
        for($i=6,$j= 0;$i>=0;$i--)
        {
            if($weeks[$j]["time"] != date("Y-m-d", strtotime(' -'. $i . 'day'))) {
                $temp = [date("Y-m-d", strtotime(' -'. $i . 'day')), 0];
                array_push($newWeeks, $temp);
            } else {
                $temp = [$weeks[$j]["time"], (int)$weeks[$j]["num"]];
                array_push($newWeeks, $temp);
                $j++;
            }
        }
        echo json_encode($newWeeks);
    }
    public function customer_status(){
        $id=$_SESSION['user_id'];
        $status=$this->customer_model->customer_status($id);
        $cus_status=array();
        foreach($status as $k=>$v){
            if($v['status']==-1){
               $temp=['无分类',(int)$v['num']];
                array_push($cus_status,$temp);
            }else if($v['status']==1){
                $temp=['A类客户',(int)$v['num']];
                array_push($cus_status,$temp);
            }else if($v['status']==2){
                $temp=['B类客户',(int)$v['num']];
                array_push($cus_status,$temp);
            }else if($v['status']==3){
                $temp=['C类客户',(int)$v['num']];
                array_push($cus_status,$temp);
            }else if($v['status']==4){
                $temp=['D类客户',(int)$v['num']];
                array_push($cus_status,$temp);
            }
        }
//        $sign_count=$this->customer_model->sign_count($id);
//        $temp=['签约客户',(int)$sign_count[0]['num']];
//        array_push($cus_status,$temp);
        echo json_encode($cus_status);
    }
    //检查客户跟进是否超出规定时间，否则就变为公海客户
    public function  customer_change(){
        echo 1;die;
        file_put_contents('crontab.txt', date("Y-m-d H:i:s").PHP_EOL,FILE_APPEND);
        //获取设置的未跟进客户回归时间
        $time = $this->db->get('system')->result_array();
        $time = $time[0]['customer_time'];
        $this->db->select("customer.id as id");
        $this->db->where("customer.sign_status",0);
        $this->db->where('customer.public_state<>',1);
        $this->db->where('((DATE_SUB(CURDATE(), INTERVAL '.$time.' DAY) >= DATE(FROM_UNIXTIME(f.`time`)) AND customer.`follow_status` = 1) OR (DATE_SUB(CURDATE(), INTERVAL '.$time.' DAY) >= DATE(FROM_UNIXTIME(nb_customer.`create_time`)) AND nb_customer.`follow_status` = 0))');
        $this->db->join('follow_customer f','f.customer_id=customer.id','left');
        $this->db->order_by('customer.id desc');
        $follow = $this->db->get('customer')->result_array();
        echo $this->db->last_query();die;
        if(empty($follow)) return false;

        foreach($follow as $k=>$v){
            $ids[] = $v['id'];
        }
        // $this->db->where_in('id',$ids);
        // $this->db->update('customer',array("public_state"=>1));
    }


    /**
     * [syscheck_customer_topublic 系统检测根据设置时间将客户转入公海]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-10T08:55:23+0800
     * @return   [type]                   [description]
     *
     * 已加入自动执行任务
     * crontab -e
     * 1 2 * * * curl http://gl.sd.tt/index.php/users/syscheck_customer_topublic
     * 每天2点1分执行符合条件客户转入公海操作
     */
    public function syscheck_customer_topublic(){

        set_time_limit(0);
        // echo date('Y-m-d H:i:s',time());
        file_put_contents('./logs/crontab_zzr.txt', date("Y-m-d H:i:s").PHP_EOL,FILE_APPEND);
        $syssettime = $this->db->get_where('system',array('id'=>1))->row_array();

        if(isset($syssettime['customer_time']) && intval($syssettime['customer_time']) > 5){ // >5 天为安全参数,防止误设置引起错误，5需手动设置
            $syschecktime = intval($syssettime['customer_time']); //单位天

            // 第一类客户 录入客户后无跟进记录&不在公海&录入时间大于系统设置检测天数&非签约用户&非重点客户&距上次检测时间久于系统设置时间
            $where = 'create_time<'.(time() - $syschecktime*86400).' AND public_state=0 AND will_status=0 AND sign_status=0 AND follow_status=0 AND syschecktime<'.(time() - $syschecktime*86400);
            $this->db->where($where);
            $customer_cates1 = $this->db->limit(10000)->select('id,create_time,public_state,syschecktime')->get('customer')->result_array();
            // p($customer_cates1);die;
            foreach($customer_cates1 as $cus_c1_val){
                echo 'c1';
                echo date('Y-m-d H',$cus_c1_val['create_time']);
                echo "<br/>";
                //添加放入公海日志
                $result = $this->log_model->customer_operation_log($cus_c1_val['id'] , 1 , 1 , null); // 第三个参数为系统管理员id、生产环境需手动设置
                if($result){ // 添加日志成功
                    $this->db->where('id',$cus_c1_val['id']);
                    $set_result = $this->db->update('customer',array('public_state'=>1,'new_user_id'=>0,'syschecktime'=>time()));
                    if(!$set_result){ // 放入公海失败
                        $lastquery = $this->db->last_query();
                        $this->db->insert('syscheck_topulic',array('checktime'=>time(),'cus_id'=>$cus_c1_val['id'],'last_query'=>$lastquery,'log_desc'=>'系统检测将该客户放入公海时执行失败'));
                    }else{
                        // 查找并删除共享客户数据
                        $this->db->delete('share', array('customer_id' =>$cus_c1_val['id']));
                    }
                }
            }
            // 第二类客户 录入的客户有跟进记录,上次跟进时间距现在时间大于系统设置的检测时间
            $where = 'syschecktime<'.(time() - $syschecktime*86400);
            $having_where = 'mtime<'.(time() - $syschecktime*86400);
            $this->db->where($where);
            $this->db->group_by('customer_id');
            $this->db->having($having_where);
            // $this->db->order_by('time DESC');
            $customer_cates2 = $this->db->limit(10000)->select('id,customer_id,max(time) mtime,syschecktime')->get('follow_customer')->result_array();
            // echo $this->db->last_query();die;
            // p($customer_cates2);die;
            foreach($customer_cates2 as $cus_c2_val){

                // 查询客户状态
                $customer_info = $this->db->select('public_state,will_status,sign_status')->get_where('customer',array('id'=>$cus_c2_val['customer_id']))->row_array();
                if(!empty($customer_info) && ($customer_info['sign_status'] == 1 || $customer_info['will_status'] == 1 ||  $customer_info['public_state'] == 1)){
                    // 如果是签约客户&重点客户&公海客户 不执行进入公海操作
                    continue;
                }

                // echo 'c2';
                // echo date('Y-m-d H:i:s',$cus_c2_val['mtime']).'|||'.date('Y-m-d H:i:s',$cus_c2_val['syschecktime']);
                // echo "<br/>";
                // // echo date('Y-m-d H',$cus_c2_val['mtime']);
                // continue;

                //添加放入公海日志
                $result = $this->log_model->customer_operation_log($cus_c2_val['customer_id'] , 1 , 1 , null); // 第三个参数为系统管理员id、生产环境1需手动设置
                if($result){ // 添加日志成功

                    $this->db->where('id',$cus_c2_val['id']);
                    $set_result_folcus = $this->db->update('follow_customer',array('syschecktime'=>time()));

                    $this->db->where('id',$cus_c2_val['customer_id']);
                    $set_result = $this->db->update('customer',array('public_state'=>1,'new_user_id'=>0,'syschecktime'=>time()));
                    if(!$set_result){ // 放入公海失败
                        $lastquery = $this->db->last_query();
                        $this->db->insert('syscheck_topulic',array('checktime'=>time(),'cus_id'=>$cus_c2_val['customer_id'],'last_query'=>$lastquery,'log_desc'=>'系统检测将该客户放入公海时执行失败'));
                    }else{
                        // 查找并删除共享客户数据
                        $this->db->delete('share', array('customer_id' =>$cus_c2_val['customer_id']));
                        // 放入公海的客户日志
                        @file_put_contents('./logs/'.date('Ymd').'.txt', $cus_c2_val['customer_id'].' at '.date('Y-m-d H:i:s',time()).PHP_EOL ,FILE_APPEND);
                    }
                }
            }
        }
    }



    //员工离职操作
    public function ajax_user_status(){
        $user_id=$_POST['user_id'];
        $this->db->where('id',$user_id);
        $result=$this->db->update('user',array('status'=>0));
        if($result){
            echo "true";
        }else{
            echo "false";
        }
    }
    //设置主管弹出部门员工
    public function users_department(){
        $id=$_POST['de_id'];
        $sql="select e.* from nb_department d LEFT JOIN nb_employee e on e.department_no =d.id where d.id=".$id;
        $users=$this->db->query($sql)->result_array();

        $id=$_POST['de_id'];
        $sql="select dm.user_id from nb_department d LEFT JOIN nb_division_manager dm on dm.department_id=d.id where d.id=".$id;
        $users2=$this->db->query($sql)->result_array();
        // @zzr edit at 2016-12-07 10:13
        foreach($users2 as $val){
            $dm_users[] = $val['user_id'];
        }
        foreach($users as $key => $user){
            if(in_array($users[$key]['user_id'] , $dm_users)){
                $users[$key]['state'] = 1;
            }else{
                $users[$key]['state'] = 0;
            }
        }

        // for($i=0,$j=0;$i<count($users);$i++){
        //     if(!isExist($users[$i]['user_id'],$dm_users)){
        //         $users[$i]["state"]=0;
        //     }else{
        //         $users[$i]['state']=1;
        //         $j++;
        //     }
        // }        
        echo json_encode($users);
    }
    //设置部门主管
    public function set_department_boss(){
        $id=$_POST['user_id'];
        $department_id=$_POST['department_id'];
        $user_id=explode(",",$id);
        $this->db->where("department_id",$department_id);

        $this->db->delete("division_manager");
        foreach(array_filter($user_id) as $k=>$v){
            $this->db->insert("division_manager",array("department_id"=>$department_id,"user_id"=>$v));
        }
        echo "true";
    }
    //获取指定销售人员
    public function get_users(){
        $depart_id=$_POST['department_id'];
        //指定销售的所有人
        $pagenum=$_POST['per_page']?$_POST['per_page']:1;
        if($pagenum==1){
            $offset=0;
        }else{
            $offset=10 * ($pagenum-1);
        }
        if($depart_id!=null){
            $this->db->where("d.id",$depart_id);
        }
        $this->db->where("user.status",1);
        $this->db->select("user.*,e.name as ename,d.name as dname,user.username as usname");
        $this->db->join("employee e","e.user_id=user.id","left");
        $this->db->join("department d" ,"d.id=e.department_no");
        $this->db->limit(10,$offset);
        $sale_users=$this->db->get('user')->result_array();
        echo json_encode($sale_users);
    }
    //弹出用户总数
    public function get_user_count(){
        $depart_id=$_POST['department_id'];
        if($depart_id!=null){
            $this->db->where("d.id",$depart_id);
        }
        $this->db->select("user.*,e.name as ename,d.name as dname,user.username as usname");
        $this->db->join("employee e","e.user_id=user.id","left");
        $this->db->join("department d" ,"d.id=e.department_no");
        $sale_users=$this->db->get('user')->result_array();
        echo count($sale_users);
    }
}