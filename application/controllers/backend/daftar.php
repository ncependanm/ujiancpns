<?php
class daftar extends CI_Controller
{
	
    var $folder =   "backend";
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
        $data['judulForm'] = 'Form Pendaftaran';
		$data['indVerifikasi'] = 'N';

		$this->template->load('tema', 'backend/daftar/index', $data);
    }
	
	function verify($key)
	{
		if ($this->mcrud->verifyEmailID($key))
        {
			$data['title'] = 'Pendaftaran';
			$data['menu'] = 'daftar';
			$data['judulForm'] = 'Form Pendaftaran';
			$data['indVerifikasi'] = 'Y';
			
			$this->template->load('tema', 'backend/daftar/index', $data);
		}
	}
	
	public function upload_file()
	{					
		$user_nama = $_POST["user_nama"];
		$user_no_hp = $_POST["user_no_hp"];
		$user_username = $_POST["user_username"];
		$user_email = $_POST["user_email"];
		$user_tgl_lahir = $_POST["user_tgl_lahir"];
		$user_password = $_POST["user_password"];
		$user_asal_sekolah = $_POST["user_asal_sekolah"];
		$user_kelas = $_POST["user_kelas"];
		$user_alamat = $_POST["user_alamat"];
		// Kirim Email
		$subject = 'Verify Your Email Address';
		$message = 'Kepada User,<br /><br />
					Selamat anda sudah terdaftar di tocpns.co.id, Silahkan klik link di bawah untuk melakukan verifikasi alamat email anda.<br /><br /> 
					'. base_url() .'backend/daftar/verify/' . md5($user_email) . '<br /><br /><br />
					Terima Kasih<br /><br />
					tocpns.co.id';
		// Cek email terdaftar
		$hsl = $this->mcrud->cekEmail($user_email);
		if($hsl <= 0){
			$hsl = $this->mcrud->cekUsername($user_username);
			if($hsl <= 0){
				$data = array(
								'user_nama' => $user_nama,
								'user_email' => $user_email,
								'user_username' => $user_username,
								'user_no_hp' => $user_no_hp,
								'user_password' => MD5($user_password),
								'user_tgl_lahir' => $user_tgl_lahir,
								'user_asal_sekolah' => $user_asal_sekolah,
								'user_kelas' => $user_kelas,
								'user_alamat' => $user_alamat,
								'user_akses' => 'S',
								'user_ind' => 'F'
							);
							$this->db->insert("cpns_user",$data);
							if ($this->mcrud->sendMail($user_email, $subject, $message))
							{
								echo json_encode(array("status" => TRUE, "msg" => "Pendaftaran Sukses, Cek Email Untuk Konfirmasi !!"));				
							}
			} else {
				echo json_encode(array("status" => FALSE, "msg" => "Username Sudah Terdaftar !!"));
			}
		} else {
				echo json_encode(array("status" => FALSE, "msg" => "Alamat Email Sudah Terdaftar !!"));
		}
	}
	}