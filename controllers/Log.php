<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 10:13
 */
class Log extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('customer_model');
        $this->load->model('linkman_model');
        session_start();
    }


    public  function customer_circulation_log(){
        $this->load->view("log/customer_circulation_log");
    }


     public  function customer_log(){
        $this->load->view("log/customer_log");
    }


     public  function customer_link_log(){
        $this->load->view("log/customer_link_log");
    }
    
}    