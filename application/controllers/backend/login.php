<?php
class login extends CI_Controller{
    
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
        $data['judulHalaman'] = "Login Administrasi - CPNS";

		$this->load->view('backend/login',$data);
    }
		
	function auth()
	{
		$username   =  $this->input->post('user_username');
        $password   =  $this->input->post('user_password');
        $sql    =   "SELECT * FROM cpns_user WHERE (user_email = '". $username ."' OR user_username = '". $username ."') 
						AND user_password = MD5('". $password ."')";
        /*$login=  $this->db->get_where('tbl_user',array('user_username'=>$username,'user_password'=>  md5($password)));*/
        if($this->db->query($sql)->num_rows() > 0)
        {
            $r=  $this->db->query($sql)->row_array();
			$sql    =   "SELECT * FROM cpns_user WHERE (user_email = '". $username ."' OR user_username = '". $username ."') AND user_status = 1";
			if($this->db->query($sql)->num_rows() > 0)
			{
				$nama = "";
				$data=array('user_id'=>$r['user_id'],
							'user_email'=>$r['user_email'],
							'user_nama'=>$r['user_nama'],
							'user_no_hp'=>  $r['user_no_hp'],
							'user_akses'=> $r['user_akses'],
							'user_ind'=>$r['user_ind']
							);
				$this->session->set_userdata($data);
				echo json_encode(array("status" => TRUE, "msg" => "Sukses"));	
			} else {
				echo json_encode(array("status" => FALSE, "msg" => "Email Belum Diverifikasi"));
			}
        }else{
			echo json_encode(array("status" => FALSE, "msg" => "Username atau password salah"));							
		}
		
	}
	
	function logout()
    {
        $this->session->sess_destroy();
        redirect('backend/login');
    }
	
	function send(){
		$email   =  $this->input->post('send_email');
		$sql    =   "SELECT * FROM cpns_user WHERE user_email = '". $email ."'";
        if($this->db->query($sql)->num_rows() > 0)
        {
            $r=  $this->db->query($sql)->row_array();
			// Kirim Email
			$subject = 'Verify Your Email Address';
			$message = 'Kepada User,<br /><br />
					Silahkan klik link di bawah untuk melakukan reset password untuk akun dengan alamat email anda ini.<br /><br /> 
					'. base_url() .'backend/login/resetPassword/' . md5($email) . '<br /><br /><br />
					Terima Kasih<br /><br />
					tocpns.co.id';
					if ($this->mcrud->sendMail($email, $subject, $message))
					{
						echo json_encode(array("status" => TRUE, "msg" => "Cara Merubah Password Sudah dikirim, Cek Email Anda !!"));				
					}
        }else{
			echo json_encode(array("status" => FALSE, "msg" => "Email Belum Terdaftar"));							
		}
	}
	
	function resetPassword($key)
	{
		$sql    =   "SELECT * FROM cpns_user WHERE md5(user_email) = '". $key ."'";
        if($this->db->query($sql)->num_rows() > 0)
        {
            $r=  $this->db->query($sql)->row_array();
			$data['desc'] = "";
			$data['info'] = "";
			$data['idUser'] = $r['user_id'];
			$data['judulHalaman'] = "Lupa Password - CPNS";

			$this->load->view('backend/forgot',$data);
		}
	}
	
	function resetSubmit(){
		$id = $this->input->post('user_id');
		$password = $this->input->post('user_password');
		if ($this->mcrud->resetPassword($id, MD5($password)))
        {
			echo json_encode(array("status" => TRUE));
		}
	}
	
}