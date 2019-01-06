<?php
class Template{
    protected $_CI;
    function __construct(){
        $this->_CI=&get_instance();
    }
    
    function login($template,$data=null){
        $data['_content']=$this->_CI->load->view($template,$data,true);
        $this->_CI->load->view('/template/login.php',$data);
    }

    function tables($template,$data=null){
        $data['_content']=$this->_CI->load->view($template,$data,true);
        $data['_header']=$this->_CI->load->view('header',$data,true);
        $data['_sidebar']=$this->_CI->load->view('sidebar',$data,true);
        $this->_CI->load->view('/tables.php',$data);
    }

    function forms($template,$data=null){
        $data['_content']=$this->_CI->load->view($template,$data,true);
        $data['_header']=$this->_CI->load->view('header',$data,true);
        $data['_sidebar']=$this->_CI->load->view('sidebar',$data,true);
        $this->_CI->load->view('/forms.php',$data);
    }

}