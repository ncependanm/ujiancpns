<?php
class daftar extends CI_Controller
{
	
    var $folder =   "";
    var $tables =   "tbl_user";
    var $pk     =   "user_id";
	
    function __construct() 
	{
        parent::__construct();
        $this->load->model('user_model');
    }
    
    function index()
    {
		
        $data['title'] = 'Pendaftaran - CPNS';
        $data['menu'] = 'daftar';
        $data['judulForm'] = 'Test Kirim Email';
		$data['indVerifikasi'] = 'N';

		$this->template->load('tema', 'daftar/index', $data);
    }
	
	public function upload_file()
	{					
		$user_email = "ncependanmms@gmail.com";
		// Kirim Email
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />
					Please click on the below activation link to verify your email address.<br /><br /> 
					'. base_url() .'backend/daftar/verify/' . md5($user_email) . '<br /><br /><br />
					Thanks<br />
					Mydomain Team';

							if ($this->mcrud->sendMail($user_email, $subject, $message))
							{
								echo json_encode(array("status" => TRUE, "msg" => "Pendaftaran Sukses, Cek Email Untuk Konfirmasi !!"));				
							} else {
					echo json_encode(array("status" => FALSE, "msg" => "ERROR"));
}
	}
	}