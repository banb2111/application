<?php
/**
 * 产品管理
 * User: Administrator
 * Date: 2016/8/9
 * Time: 18:03
 */
class  Product extends  CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 产品管理列表
     */
    public function product_list(){

        $this->load->view("product/product_list");
       
    }
    /**
     * 添加
     */
    public function add_product(){
        $this->load->view("product/add_product");
       
    }
    /**
     * 产品分类管理
     */
    public function product_class(){
        $this->load->view("product/product_class");
       
    }
    /**
     * 产品选择
     */
    public function product_select(){
        $this->load->view("product/product_select");
       
    }
    /**
     * 添加合同
     */
    public function add_contract(){
        $this->load->view("product/add_contract");
       
    }
    
    
}