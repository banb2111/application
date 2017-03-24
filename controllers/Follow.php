<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/30
 * Time: 11:06
 */
class Follow extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        session_start();
    }
    public function menulist()
    {
        if ($this->uri->segment(3) === FALSE) {
            $product_id = 0;
        } else {
            $product_id = $this->uri->segment(3);
        }
        if ($product_id == "follow_customer") {
            $this->add_follow_customer();
        }
    }
    //添加客户跟进
    public  function add_follow_customer(){
        $id=$_SESSION['user_id'];
        $customer_id=$_POST['customer_id'];
        $next_time=strtotime($this->input->post('next_time'));
        $data=array(
            'customer_id'=>$this->input->post('customer_id'),
            'follower_id'=>$id->id,
            'time'=>time(),
            'type'=>$this->input->post('type'),
            'content'=>$this->input->post('content'),
            'next_time'=>$next_time,
        );
        $result=$this->db->insert('follow_customer',$data);
        if($result){
            $this->db->where('id',$customer_id);
            $this->db->update('customer',array('follow_status'=>1));
            echo 'succ';
        }else{
            echo 'err';
        }
    }

    /**
     * [add_follow_cusdemand 新增客户需求记录]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-23T09:17:28+0800
     */
    public  function add_follow_cusdemand(){
        $id=$_SESSION['user_id'];
        $customer_id = trim($_POST['customer_id']);
        $next_time=strtotime($this->input->post('next_time'));
        $data=array(
            'customer_id'=>$this->input->post('customer_id'),
            'follower_id'=>$id->id,
            'time'=>time(),
            'type'=>$this->input->post('type'),
            'content'=>$this->input->post('content'),
            'next_time'=>$next_time,
        );
        $result=$this->db->insert('follow_cusdemand',$data);
        if($result){
            $this->db->where('id',$customer_id);
            $this->db->update('customer',array('follow_status'=>1));
            echo 'succ';
        }else{
            echo 'err';
        }
    }

    /**
     * [add_follow_cusprice 添加客户报价记录]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-23T09:42:07+0800
     */
     public  function add_follow_cusprice(){
        $id=$_SESSION['user_id'];
        $customer_id = trim($_POST['customer_id']);
        $next_time=strtotime($this->input->post('next_time'));
        $data=array(
            'customer_id'=>$this->input->post('customer_id'),
            'follower_id'=>$id->id,
            'time'=>time(),
            'type'=>$this->input->post('type'),
            'content'=>$this->input->post('content'),
            'next_time'=>$next_time,
        );
        $result=$this->db->insert('follow_cusprice',$data);
        if($result){
            $this->db->where('id',$customer_id);
            $this->db->update('customer',array('follow_status'=>1));
            echo 'succ';
        }else{
            echo 'err';
        }
    }


    //获取客户的跟进记录
    public function  follow_customer(){
        $cus_id=$_POST['customer_id']?$_POST['customer_id']:0;
        $result=$this->db->select('*,f.content as fcontent,e.name as ename,f.time as ftime,f.type as ftype')
            ->from('follow_customer f')
            ->join('customer c','c.id=f.customer_id')
            ->join('user u','u.id=f.follower_id')
            ->join('employee e','u.id=e.user_id')
            ->where('f.customer_id',$cus_id)
            ->order_by('f.time desc')->get();
        $follow=$result->result();
        $str="";
        foreach($follow as $k=>$v){
            $follow_time[date('Y-m-d',$v->ftime)][]=array(
                'ename'=>$v->ename,
                'next_time'=>$v->next_time,
                'fcontent'=>$v->fcontent,
                'ftype'=>$v->ftype,
                'time'=>$v->ftime,
            );
            }
//        echo "<pre>";
//        print_r($follow_time);
//        echo "</pre>";
        foreach($follow_time as $key=>$f){
            $str.='
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="line_date">
                                    <span></span>'.$key.'
                                </div>
                            </div>';
            foreach($f as $key1=>$value){
                $str.=' <div class="col-lg-12">
                                <div class="feed">
                                    <div class="feed-title">
                                        <span class="topImg">
                                            <img src="'.base_url().'/static/img/avatar_person.png" alt="">
                                        </span>
                                        <span class="userNameShow">'.$value['ename'].'</span>
                                    </div>
                                     <div class="feed-border">
                                                <div class="icon"><div class="iconbg"></div></div>';
                                                if($value['ftype']==1){
                                                    $str.='<div class="body" style="font-size: 12px; color:#1ab394;">电话</div>';
                                                }else if($value['ftype']==2){
                                                    $str.='<div class="body" style="font-size: 12px; color:#1ab394;">邮件</div>';
                                                }else if($value['ftype']==3){
                                                    $str.='<div class="body" style="font-size: 12px;color:#1ab394;">QQ</div>';
                                                }else if($value['ftype']==4){
                                                    $str.='<div class="body" style="font-size: 12px; color:#1ab394;" >微信</div>';
                                                }
                                                $str.='<div class="body">'.$value['fcontent'].'</div>
                                                <div class="bar">
                                                    <span class="date f12">
                                                        <i class="fa fa-clock-o"></i>
                                                        <b class="fn">'.date('Y-m-d H:i:s',$value['time']).'</b>
                                                    </span>
                                                   ';
                                                    if($value['next_time']){
                                                        $str.= ' <span style="display: inline;" title="下次联系时间" class="nextdate f12"><i class="fa fa-bell-o"></i> <b class="fn">'.date('Y-m-d H:i:s',$value['next_time']).'</b></span>';
                                                    }
                                    $str.='  </div>
                                            </div>
                                        </div>

                                    </div>
                                    ';
            }
            $str.='</div>';
        }
        echo $str; exit;
    }


    /**
     * [follow_cusdemand 获取客户需求跟进记录]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-23T09:23:06+0800
     * @return   [type]                   [description]
     */
    public function  follow_cusdemand(){
        $cus_id=$_POST['customer_id']?$_POST['customer_id']:0;
        $result=$this->db->select('*,f.content as fcontent,e.name as ename,f.time as ftime,f.type as ftype')
            ->from('follow_cusdemand f')
            ->join('customer c','c.id=f.customer_id')
            ->join('user u','u.id=f.follower_id')
            ->join('employee e','u.id=e.user_id')
            ->where('f.customer_id',$cus_id)
            ->order_by('f.time desc')->get();
        $follow=$result->result();
        $str="";
        foreach($follow as $k=>$v){
            $follow_time[date('Y-m-d',$v->ftime)][]=array(
                'ename'=>$v->ename,
                'next_time'=>$v->next_time,
                'fcontent'=>$v->fcontent,
                'ftype'=>$v->ftype,
                'time'=>$v->ftime,
            );
            }
//        echo "<pre>";
//        print_r($follow_time);
//        echo "</pre>";
        foreach($follow_time as $key=>$f){
            $str.='
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="line_date">
                                    <span></span>'.$key.'
                                </div>
                            </div>';
            foreach($f as $key1=>$value){
                $str.=' <div class="col-lg-12">
                                <div class="feed">
                                    <div class="feed-title">
                                        <span class="topImg">
                                            <img src="'.base_url().'/static/img/avatar_person.png" alt="">
                                        </span>
                                        <span class="userNameShow">'.$value['ename'].'</span>
                                    </div>
                                     <div class="feed-border">
                                                <div class="icon"><div class="iconbg"></div></div>';
                                                if($value['ftype']==1){
                                                    $str.='<div class="body" style="font-size: 12px; color:#1ab394;">电话</div>';
                                                }else if($value['ftype']==2){
                                                    $str.='<div class="body" style="font-size: 12px; color:#1ab394;">邮件</div>';
                                                }else if($value['ftype']==3){
                                                    $str.='<div class="body" style="font-size: 12px;color:#1ab394;">QQ</div>';
                                                }else if($value['ftype']==4){
                                                    $str.='<div class="body" style="font-size: 12px; color:#1ab394;" >微信</div>';
                                                }
                                                $str.='<div class="body">'.$value['fcontent'].'</div>
                                                <div class="bar">
                                                    <span class="date f12">
                                                        <i class="fa fa-clock-o"></i>
                                                        <b class="fn">'.date('Y-m-d H:i:s',$value['time']).'</b>
                                                    </span>
                                                   ';
                                                    if($value['next_time']){
                                                        $str.= ' <span style="display: inline;" title="下次联系时间" class="nextdate f12"><i class="fa fa-bell-o"></i> <b class="fn">'.date('Y-m-d H:i:s',$value['next_time']).'</b></span>';
                                                    }
                                    $str.='  </div>
                                            </div>
                                        </div>

                                    </div>
                                    ';
            }
            $str.='</div>';
        }
        echo $str; exit;
    }



    /**
     * [follow_cusprice 获取客户报价记录]
     * @author   zzr QQ:836663500
     * @datetime 2016-12-23T09:44:18+0800
     * @return   [type]                   [description]
     */
    public function  follow_cusprice(){
        $cus_id=$_POST['customer_id']?$_POST['customer_id']:0;
        $result=$this->db->select('*,f.content as fcontent,e.name as ename,f.time as ftime,f.type as ftype')
            ->from('follow_cusprice f')
            ->join('customer c','c.id=f.customer_id')
            ->join('user u','u.id=f.follower_id')
            ->join('employee e','u.id=e.user_id')
            ->where('f.customer_id',$cus_id)
            ->order_by('f.time desc')->get();
        $follow=$result->result();
        $str="";
        foreach($follow as $k=>$v){
            $follow_time[date('Y-m-d',$v->ftime)][]=array(
                'ename'=>$v->ename,
                'next_time'=>$v->next_time,
                'fcontent'=>$v->fcontent,
                'ftype'=>$v->ftype,
                'time'=>$v->ftime,
            );
            }
//        echo "<pre>";
//        print_r($follow_time);
//        echo "</pre>";
        foreach($follow_time as $key=>$f){
            $str.='
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="line_date">
                                    <span></span>'.$key.'
                                </div>
                            </div>';
            foreach($f as $key1=>$value){
                $str.=' <div class="col-lg-12">
                                <div class="feed">
                                    <div class="feed-title">
                                        <span class="topImg">
                                            <img src="'.base_url().'/static/img/avatar_person.png" alt="">
                                        </span>
                                        <span class="userNameShow">'.$value['ename'].'</span>
                                    </div>
                                     <div class="feed-border">
                                                <div class="icon"><div class="iconbg"></div></div>';
                                                $str.='<div class="body">报价金额:'.$value['ftype'].'元<br/>'.$value['fcontent'].'</div>
                                                <div class="bar">
                                                    <span class="date f12">
                                                        <i class="fa fa-clock-o"></i>
                                                        <b class="fn">'.date('Y-m-d H:i:s',$value['time']).'</b>
                                                    </span>
                                                   ';
                                                    if($value['next_time']){
                                                        $str.= ' <span style="display: inline;" title="下次联系时间" class="nextdate f12"><i class="fa fa-bell-o"></i> <b class="fn">'.date('Y-m-d H:i:s',$value['next_time']).'</b></span>';
                                                    }
                                    $str.='  </div>
                                            </div>
                                        </div>

                                    </div>
                                    ';
            }
            $str.='</div>';
        }
        echo $str; exit;
    }

    //弹出信息
    public function followa_alert(){
        $id=$_SESSION['user_id'];
        $now_time=strtotime(date("Y-m-d H:i",time()));
        $this->db->select("*,customer.name as cname,f.next_time,customer.id as cuid,customer.status as custatus");
        $this->db->join('follow_customer f','customer.id=f.customer_id');
        $this->db->where('customer.creator',$id->id);
        $this->db->where('f.next_time>',$now_time-30);
        $this->db->where('f.sure',0);
        $this->db->order_by('f.next_time asc');
        $follow=$this->db->get('customer')->result_array();
        if($follow){
            echo json_encode($follow);
        }else{
            echo "false";;
        }
    }
    //七天跟进统计
    public function ajax_follow_weeks(){
        $id=$_SESSION['user_id'];
        $sql="SELECT
	count(f.id) AS num,
	date(from_unixtime(f.time)) AS time
            FROM
	`nb_customer` c
            LEFT JOIN nb_follow_customer f ON f.customer_id = c.id
            WHERE
	date_sub(curdate(), INTERVAL 6 DAY) <= date(from_unixtime(f.time))
            AND
	f.follower_id = ".$id->id."
            GROUP BY
	date(from_unixtime(f.time));";
        $follow_count=$this->db->query($sql)->result_array();
        $newWeeks = array();
        for($i=6,$j= 0;$i>=0;$i--)
        {
            if($follow_count[$j]["time"] != date("Y-m-d", strtotime(' -'. $i . 'day'))) {
                $temp = [date("Y-m-d", strtotime(' -'. $i . 'day')), 0];
                array_push($newWeeks, $temp);
            } else {
                $temp = [$follow_count[$j]["time"], (int)$follow_count[$j]["num"]];
                array_push($newWeeks, $temp);
                $j++;
            }
        }
        echo json_encode($newWeeks);
    }
}