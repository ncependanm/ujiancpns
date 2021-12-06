<?php
class login extends CI_Controller
{
    var $tables =   "tbl_reg_akun";
	
    function __construct() 
	{
        parent::__construct();
        $this->load->model('user_model');
    }
    
    function index()
    {
        $data['title'] = 'Login';
        $data['menu'] = 'login';
        $data['judulForm'] = 'Form Login';
		
		$this->template->load('tema', 'masuk', $data);
    }
	
	function auth()
	{
        $email = $this->input->post('user_email');
        $password = $this->input->post('user_password');
        $sql    =   "SELECT * FROM cpns_user WHERE (user_email = '". $email ."' OR user_username = '". $email ."') 
						AND user_password = MD5('". $password ."')";
		
		if($this->db->query($sql)->num_rows() > 0)
		{	
            $r=  $this->db->query($sql)->row_array();
			if($r['user_status'] == '0')
			{
				echo json_encode(array("status" => FALSE, "msg" => "Akun Belum Di Verifikasi !!"));				
			}
			else
			{
				$data=array('user_id'=>$r['user_id'],
							'user_email'=>$r['user_email'],
							'user_nama'=>$r['user_nama'],
							'user_no_hp'=>  $r['user_no_hp'],
							'user_akses'=> $r['user_akses'] 
							);
				$this->session->set_userdata($data);
				echo json_encode(array("status" => TRUE, "msg" => "Login Sukses !!"));	
			}
		}else{
			echo json_encode(array("status" => FALSE, "msg" => "Login gagal, Cek Kembali Email atau Passwordnya !!"));
		}
	}

	function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}