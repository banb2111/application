<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/5
 * Time: 9:07
 */
class Log_model extends  CI_Model{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 客户操作日志添加
     *
     * @param $customer_id //客户id
     * @param $change_type //日志类型
     * @param $in_user_id //放入人
     * @param $operation_id //改变人
     */
    public function customer_operation_log($customer_id,$change_type,$in_user_id,$operation_id){
        $this->db->where('id',$customer_id);
        $cus=$this->db->get('customer')->result_array();

        if(empty($cus[0]['id'])){
            return false;
        }

        $data=array(
            'customer_id'=>$cus[0]['id'],
            'add_time'=>time(),
            'operation_id'=>$operation_id,//改变人
            'change_type'=>$change_type,//放入公海
            'user_id'=>$in_user_id,//放入人
        );
        //放入人查询
        $user=$this->user_model->get_user_name($in_user_id);
        if($operation_id!=null){
            //捡回人
            $user2=$this->user_model->get_user_name($operation_id);
            $data['cus_to']=$user2;
            $data['cus_from']=$user;
            //日志记录
            $data['change_text']=$user2."捡回客户".$cus[0]['name'].",从".$user."->".$user2."";
        }else{
            //日志记录
            $data['change_text']=$user."把".$cus[0]['name']."客户放入公海";
        }
        //插入日志
        $result=$this->db->insert('customer_change',$data);
        return $result;
    }
    /**
     * 联系人变更日志
     * @param  $customer_id //客户
     * @param  $link_id     //联系人id
     * @param  user_id      //修改人
     * @param  $name        //修改联系人名称
     * @param  $mobile      //修改联系人电话
     */
    public function update_linkman_log($customer_id,$link_id,$user_id,$name,$mobile){
        //修改客户
        $customer=$this->db->query('select *,c.`name` as cname,l.name as lname from nb_customer c join nb_linkman l on  c.linkman_id=l.id where c.id='.$customer_id)->result_array();
        //修改人
        $this->db->where('user.id',$user_id);
        $this->db->join('user',"user.id=employee.user_id");
        $user_name=$this->db->get('employee')->result_array();
        //修改的联系人
        $this->db->where('id',$link_id);
        $linkman=$this->db->get('linkman')->result_array();
        //修改的名称,日志追加
        if($linkman[0]['name']!=$name){
            $name_data=array(
                'cus_id'=>$linkman[0]["id"],
                'user_id'=>$user_id,
                'add_time'=>time(),
                'link_from'=>$linkman[0]['name'],
                'link_to'=>$name
            );
            $name_data['link_text']=$user_name[0]['name']."修改了".$customer[0]['cname']."客户的联系人的名称从".$linkman[0]['name']."修改成".$this->input->post('name')."";
            $result=$this->db->insert('linkman_log',$name_data);
        }
        //修改的电话，日志追加
        if($linkman[0]['mobile']!=$mobile){
            $mobile_data=array(
                'cus_id'=>$linkman[0]["id"],
                'user_id'=>$user_id,
                'add_time'=>time(),
                'link_from'=>$linkman[0]['mobile'],
                'link_to'=>$mobile
            );
            $mobile_data['link_text']=$user_name[0]['name']."修改了".$customer[0]['cname']."客户的联系人的手机号从".$linkman[0]['mobile']."修改成".$this->input->post('mobile')."";
           $result= $this->db->insert('linkman_log',$mobile_data);
        }
        return $result;
    }
    /**
     * 客户变更日志
     * @param  $customer_id //客户id
     * @param  $user_id     //修改人
     * @param  $name        //修改的企业名称
     * @param  $mobile      //修改的电话
     */
    public function update_customer_log($customer_id,$user_id,$name,$mobile){
        $customer=$this->db->query('select *,c.`name` as cname,l.name as lname from nb_customer c join nb_linkman l on  c.linkman_id=l.id where c.id='.$customer_id)->result_array();
        //用户名
        $this->db->where('user.id',$user_id);
        $this->db->join('user',"user.id=employee.user_id");
        $user_name=$this->db->get('employee')->result_array();
        if($customer[0]['cname']!=$name){
            $name_data=array(
                'cus_id'=>$customer_id,
                'user_id'=>$user_id,
                'add_time'=>time(),
                'cus_from'=>$customer[0]['cname'],
                'cus_to'=>$_POST['name'],
            );
            $name_data['text_log']=$user_name[0]['name']."修改了".$customer[0]['cname']."的企业名称,从".$customer[0]['cname']."修改成".$_POST['name']."";
            $result=$this->db->insert('customer_log',$name_data);
        }
        if($customer[0]['mobile']!=$mobile){
            $mobile_data=array(
                'cus_id'=>$customer_id,
                'user_id'=>$user_id,
                'add_time'=>time(),
                'cus_from'=>$customer[0]['mobile'],
                'cus_to'=>$mobile,
            );
            $mobile_data['text_log']=$user_name[0]['name']."修改了".$customer[0]['cname']."客户的默认手机号,从".$customer[0]['mobile']."修改成".$_POST['mobile']."";
            $this->db->insert('customer_log',$mobile_data);
        }
        return $result;
    }
    /**
     * 关键词类别变更日志
     * @param $id //关键词id
     * @param  $name //变更名称
     * @param  $price //变更价格
     * @param  $user_id //变更人
     */
    public function update_keywords_category_log($id,$name,$price,$user_id){
        //查询当前关键词类别
        $keywords=$this->db->get_where("keywords_category",array("id"=>$id))->result_array();
        $data=array();
        if($keywords[0]['category_name']!=$name){
            $data['ord_cate_name']=$keywords[0]['category_name'];
            $data['new_cate_name']=$name;
        }
        if($keywords[0]['category_price']!=$price){
            $data['ord_cate_price']=$keywords[0]['category_price'];
            $data['new_cate_price']=$price;
        }
        if($data){
            $data['user_id']=$user_id;
            $data['update_time']=time();
            $data['keywords_cate_id']=$id;
            $this->db->insert("keywords_category_log",$data);
        }else{
            return false;
        }
    }
    /**
     * 客户转移日志
     * @param $cus_id //转移客户id
     * @param $new_user_id //所有人
     * @param  $user_id //操作人
     */
    public function customer_transfer_log($cus_id,$new_user_id,$user_id){
        $cus_id=explode(",",$cus_id);
        foreach(array_filter($cus_id) as $k=>$v){
            $cus=$this->db->get_where("customer",array("id"=>$v))->result_array();
            $data=array(
                "customer_id"=>$v,
                "user_id"=>$user_id,
                "operation_id"=>$new_user_id,
                "change_type"=>2,//转移
                "add_time"=>time(),
            );
            //转移人
            $new_user=$this->user_model->get_user_name($new_user_id);
            //操作人
            $user=$this->user_model->get_user_name($user_id);
            $data['change_text']="".$user."把".$cus[0]['name']."客户转移到".$new_user."";
            $data['cus_from']=$user;
            $data['cus_to']=$new_user;
            $this->db->insert("customer_change",$data);
        }
    }
    /**
     * 客户分享日志
     * @param  $cus_id //共享客户
     * @param  $share_user //共享人
     * @param  $user //操作人
     */
    public function customer_share_log($cus_id,$share_user,$user){
        $cus=$this->db->get_where("customer",array("id"=>$cus_id))->result_array();
        $data=array(
            "customer_id"=>$cus_id,
            "user_id"=>$user,
            "operation_id"=>$share_user,
            "change_type"=>3,//转移
            "add_time"=>time(),
        );
        //转移人
        $new_user=$this->user_model->get_user_name($share_user);
        //操作人
        $user=$this->user_model->get_user_name($user);
        $data['change_text']="".$user."把".$cus[0]['name']."客户分享给".$new_user."";
        $data['cus_from']=$user;
        $data['cus_to']=$new_user;
        $this->db->insert("customer_change",$data);
    }

}