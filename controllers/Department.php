<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/7
 * Time: 16:37
 */

class Department extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('buildtreearray');
        $this->load->helper('common_helper');
        session_start();
    }
    public function department_tree(){
        $data=$this->db->where('display = 1')->select("id ,no,name as text,description,sort")->from("department")->get()->result();
        $bta = new BuildTreeArray($data,'id','no',0);
        $data = $bta->getTreeArray();
        echo json_encode($data);
    }


}
class BuildTreeArray
{
    private $idKey = 'id'; //主键的键名
    private $fidKey = 'fid'; //父ID的键名
    private $root = 0; //最顶层fid
    private $data = array(); //源数据
    private $treeArray = array(); //属性数组

    function __construct($data,$idKey,$fidKey,$root) {
        if($idKey) $this->idKey = $idKey;
        if($fidKey) $this->fidKey = $fidKey;
        if($root) $this->root = $root;
        if($data) {
            $this->data = $data;
            $this->getChildren($this->root);
        }
    }

    /**
     * 获得一个带children的树形数组
     * @return multitype:
     */
    public function getTreeArray()
    {
        //去掉键名
        return array_values($this->treeArray);
    }

    /**
     * @param int $root 父id值
     * @return null or array
     */
    private function getChildren($root)
    {

        foreach ($this->data as &$node){
            if(is_object($node)){
                $node=get_object_vars($node);
            }

            if($root == $node[$this->fidKey]){
                $node['nodes'] = $this->getChildren($node[$this->idKey]);
                $children[] = $node;
            }
            //只要一级节点
            if($this->root == $node[$this->fidKey]){
                $this->treeArray[$node[$this->idKey]] = $node;
            }
        }
        return $children;
    }
}