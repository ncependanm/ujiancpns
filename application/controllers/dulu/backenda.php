<?php
class backend extends CI_Controller{
    
    var $folder =   "backend";
    var $tables =   "tbl_user";
    var $pk     =   "user_id";
    
    function __construct() {
        parent::__construct();
        $this->load->helper('captcha','string');
    }
    
    function index()
    {
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Login Administrasi - SIAKAD ONLINE";

		$this->load->view('backend/login',$data);
    }
	
}