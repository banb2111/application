<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 10:13
 */
class Statistical extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->model('channel_model');
    }

    public  function new_customer_sta(){
        $data['chis_deparments']=$this->db->order_by('no asc')->get('department')->result_array();


        // 所有部门
        $deparments_ids = 12; //总部门商务部
        $chis_deparments = $this->db->get_where('department',array('no'=>$deparments_ids))->result_array();
        foreach($chis_deparments as $c_d_val){
            $deparments_ids = $deparments_ids . ',' . $c_d_val['id'];
        }
        $data['deparments_ids'] = $deparments_ids;



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



        $this->load->view("census/new_customer_sta",$data);
    }
    public  function all_customer_sta(){
        $data['department']=$this->db->get('department')->result_array();
        $this->load->view("census/all_customer_sta",$data);
    }
    public  function tion_customer_sta(){
        $data['department']=$this->db->get('department')->result_array();


        $data['chis_deparments']=$this->db->order_by('no asc')->get('department')->result_array();


        // 所有部门
        $deparments_ids = 12; //总部门商务部
        $chis_deparments = $this->db->get_where('department',array('no'=>$deparments_ids))->result_array();
        foreach($chis_deparments as $c_d_val){
            $deparments_ids = $deparments_ids . ',' . $c_d_val['id'];
        }
        $data['deparments_ids'] = $deparments_ids;



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



        $this->load->view("census/tion_customer_sta",$data);
    }
    public  function follow_customer_sta(){
        $data['department']=$this->db->get('department')->result_array();

        $data['chis_deparments']=$this->db->order_by('no asc')->get('department')->result_array();


        // 所有部门
        $deparments_ids = 12; //总部门商务部
        $chis_deparments = $this->db->get_where('department',array('no'=>$deparments_ids))->result_array();
        foreach($chis_deparments as $c_d_val){
            $deparments_ids = $deparments_ids . ',' . $c_d_val['id'];
        }
        $data['deparments_ids'] = $deparments_ids;



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




        $this->load->view("census/follow_customer_sta",$data);
    }
    //新增客户统计(每月)
    public function ajax_add_customer(){
        $department = $_POST['department'];
        // @zzr edit at 2017-01-13 17:29
        $channel_id = $this->input->post('channel_id');
        $year=$_POST['year'];
        $month=$_POST['month'];
        $fuzeren=$_POST['fuzeren'];
        $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
        $last_time=date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
     
        //当前月的第一天
        $BeginDate= strtotime($BeginDate);
        //当前月的最后一天
        $last_time=strtotime($last_time);
        $sql="select count(c.id)as num,DAYOFMONTH(from_unixtime(c.`create_time`)) as newtime from nb_customer c ";
        if($department){
            $sql.=" left join nb_employee e on e.user_id=c.creator";
            $sql.=" left join nb_department d on d.id=e.department_no";
        }
        if($year&&$month){
            $date="".$year."-".$month."";
            $BeginDate=date('Y-m-01', strtotime($date));
            $last_time=date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
            //当前月的第一天
            $BeginDate= strtotime($BeginDate);
            //当前月的最后一天
            $last_time=strtotime($last_time);
            $sql.="  where create_time BETWEEN ".$BeginDate." AND ".$last_time;
        }else{
            $sql.="  where create_time BETWEEN ".$BeginDate." AND ".$last_time;
        }
        if($department){

            $instr = $department;
            $chis_deparments = $this->db->get_where('department',array('no'=>$department))->result_array();
            foreach($chis_deparments as $val){
                $instr = $instr.','.$val['id'];
            }
            // $sql.=" and d.id=".$department;
            $sql.=" and d.id in(".$instr.')';
        }
        if($fuzeren){

            $sql.=" and c.creator=".$fuzeren;
            // $sql.=" and c.new_user_id=".$fuzeren;
        }

        // 按客户来源渠道筛选
        if(!empty($channel_id)){

            $chis_channels = $this->channel_model->get_chischannel_bypid($channel_id);
            $cc_str = $channel_id;
            foreach($chis_channels as $cc_val){
                $cc_str = $cc_str.','.$cc_val;
            }
            $cc_str = trim($cc_str , ',');
            $sql.=" and (c.channel_id in(".$cc_str.") OR c.channel_id_1 in(".$cc_str.") OR c.channel_id_2 in(".$cc_str.") OR c.channel_id_3 in(".$cc_str."))";
        }

        $sql.=" GROUP BY newtime";


        $month_add=$this->db->query($sql)->result_array();


        $newmonth=array();
        for($i=1,$j=0; $i<=31; $i++){
            if($month_add[$j]["newtime"] !=$i ) {
                $temp = ["".$i."", 0];
                array_push($newmonth, $temp);
            } else {
                $temp = [$month_add[$j]["newtime"], (int)$month_add[$j]["num"]];
                array_push($newmonth, $temp);
                $j++;
            }
        }
        echo json_encode($newmonth);
    }
    //客户分类统计
    public function ajax_customer_status(){
        $department=$_POST['department'];
        $year=$_POST['year'];
        $month=$_POST['month'];
        $fuzeren=$_POST['fuzeren'];
        $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
        $last_time=date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
        // @zzr edit at 2017-01-14 08:58
        $channel_id = $this->input->post('channel_id');
        //当前月的第一天
        $BeginDate= strtotime($BeginDate);
        //当前月的最后一天
        $last_time=strtotime($last_time);
        $sql="select count(c.id) as num,c.status from nb_customer c";
        if($department){
            $sql.=" left join nb_employee e on e.user_id=c.creator";
            $sql.=" left join nb_department d on d.id=e.department_no";
        }
        if($year&&$month){
            $date="".$year."-".$month."";
            $BeginDate=date('Y-m-01', strtotime($date));
            $last_time=date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
            //当前月的第一天
            $BeginDate= strtotime($BeginDate);
            //当前月的最后一天
            $last_time=strtotime($last_time);
            $sql.="  where create_time BETWEEN ".$BeginDate." AND ".$last_time;
        }else{
            $sql.="  where create_time BETWEEN ".$BeginDate." AND ".$last_time;
        }
        if($department){
            $instr = $department;
            $chis_deparments = $this->db->get_where('department',array('no'=>$department))->result_array();
            foreach($chis_deparments as $val){
                $instr = $instr.','.$val['id'];
            }
            // $sql.=" and d.id=".$department;
            $sql.=" and d.id in(".$instr.')';
        }
        if($fuzeren){
            $sql.=" and c.creator=".$fuzeren;
        }

        // 按客户来源渠道筛选
        if(!empty($channel_id)){

            $chis_channels = $this->channel_model->get_chischannel_bypid($channel_id);
            $cc_str = $channel_id;
            foreach($chis_channels as $cc_val){
                $cc_str = $cc_str.','.$cc_val;
            }
            $cc_str = trim($cc_str , ',');
            $sql.=" and (c.channel_id in(".$cc_str.") OR c.channel_id_1 in(".$cc_str.") OR c.channel_id_2 in(".$cc_str.") OR c.channel_id_3 in(".$cc_str."))";
        }


        $sql.=" group by status";
        $status=$this->db->query($sql)->result_array();
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
        echo json_encode($cus_status);
    }
    //客户跟进统计（每月）
    public function follow_count(){
        $department=$_POST['department'];
        // @zzr edit at 2017-01-13 21:41
        $channel_id = $this->input->post('channel_id');
        $year=$_POST['year'];
        $month=$_POST['month'];
        $fuzeren=$_POST['fuzeren'];
        $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
        $last_time=date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
        //当前月的第一天
        $BeginDate= strtotime($BeginDate);
        //当前月的最后一天
        $last_time=strtotime($last_time);
        $sql="select count(f.id)as num,DAYOFMONTH(from_unixtime(f.time)) as fl_time from  nb_follow_customer f ";
        $sql.="  LEFT  join nb_customer c on f.customer_id=c.id";
        if($department){
            $sql.=" left join nb_employee e on e.user_id=c.creator";
            $sql.=" left join nb_department d on d.id=e.department_no";
        }
        if($year&&$month){
            $date="".$year."-".$month."";
            $BeginDate=date('Y-m-01', strtotime($date));
            $last_time=date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
            //当前月的第一天
            $BeginDate= strtotime($BeginDate);
            //当前月的最后一天
            $last_time=strtotime($last_time);
            $sql.="  where f.time BETWEEN ".$BeginDate." AND ".$last_time;
        }else{
            $sql.="  where f.time BETWEEN ".$BeginDate." AND ".$last_time;
        }

        if($department){

            $instr = $department;
            $chis_deparments = $this->db->get_where('department',array('no'=>$department))->result_array();
            foreach($chis_deparments as $val){
                $instr = $instr.','.$val['id'];
            }
            // $sql.=" AND d.id=".$department;
            $sql.=" AND d.id in(".$instr.')';
        }


        if($fuzeren){
            $sql.=" AND c.creator=".$fuzeren;
        }


        // 按客户来源渠道筛选
        if(!empty($channel_id)){

            $chis_channels = $this->channel_model->get_chischannel_bypid($channel_id);
            $cc_str = $channel_id;
            foreach($chis_channels as $cc_val){
                $cc_str = $cc_str.','.$cc_val;
            }
            $cc_str = trim($cc_str , ',');
            $sql.=" AND (c.channel_id in(".$cc_str.") OR c.channel_id_1 in(".$cc_str.") OR c.channel_id_2 in(".$cc_str.") OR c.channel_id_3 in(".$cc_str."))";
        }



        $sql.=" GROUP BY fl_time";


        
        $month_follow_count=$this->db->query($sql)->result_array();
        $newmonth=array();
        for($i=1,$j=0; $i<=31; $i++){
            if($month_follow_count[$j]["fl_time"] !=$i ) {
                $temp = [0];
                array_push($newmonth, $temp);
            } else {
                $temp = [(int)$month_follow_count[$j]["num"]];
                array_push($newmonth, $temp);
                $j++;
            }
        }
        echo json_encode($newmonth);
    }
    //客户所有者统计
    public function all_user_owner(){
        $department=$_POST['department'];
        $sql="select count(c.id)as num, concat (left(count(c.id)/(select count(id) from nb_customer)*100,4),'%') as baifen,e.name ename FROM nb_customer c  LEFT JOIN nb_employee e on e.user_id=c.creator ";
        // 在职的
        $sql.=" left join nb_user u on u.id=c.creator";
        if($department){
            $sql.=" left join nb_department d on d.id=e.department_no";
            // $sql.=" left join nb_user u on u.id=c.new_user_id";
            $sql.=" where d.id=".$department.' AND u.status=1';
        }else{
            $sql.=" where u.status=1";
        }

        $sql.=" GROUP BY c.creator";
        $all_user=$this->db->query($sql)->result_array();
        echo json_encode($all_user);
    }
    //获取部门下的负责人
    public function employee_department(){
        $department=$_POST['department'];
        $sql="select e.user_id as eid,e.name as ename from nb_employee e left join nb_department d on e.department_no=d.id where e.department_no=".$department;
        $de=$this->db->query($sql)->result_array();
        echo json_encode($de);
    }
}