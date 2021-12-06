<?php
class daftar extends CI_Controller
{
    function __construct() 
	{
        parent::__construct();
        $this->load->model('user_model');
    }
    
    function index()
    {
        $data['title'] = 'Pendaftaran';
        $data['menu'] = 'daftar';
        $data['judulForm'] = 'Form Pendaftaran';
		$data['indVerifikasi'] = 'N';
		
		$this->template->load('tema', 'daftar', $data);
    }
	
	function verify($key)
	{
		if ($this->mcrud->verifyEmailID($key))
        {
			$data['title'] = 'Pendaftaran';
			$data['menu'] = 'daftar';
			$data['judulForm'] = 'Form Pendaftaran';
			$data['indVerifikasi'] = 'Y';
			
			$this->template->load('tema', 'daftar', $data);
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
		$message = 'Dear User,<br /><br />
					Please click on the below activation link to verify your email address.<br /><br /> 
					'. base_url() .'daftar/verify/' . md5($user_email) . '<br /><br /><br />
					Thanks<br />
					Mydomain Team';
		// Cek email terdaftar
		$hsl = $this->mcrud->cekEmail($user_email);
		if($hsl <= 0){
			//upload file
			$config['upload_path'] = './asset/upload/';
			$config['allowed_types'] = '*';
			$config['max_filename'] = '255';
			$config['max_size'] = '1024'; //1 MB
			$new_name = time().$user_nama;
			$config['file_name'] = $new_name;
	 
			if (isset($_FILES['file']['name'])) {
				if (0 < $_FILES['file']['error']) {
					echo json_encode(array("status" => FALSE, "msg" => 'Error during file upload' . $_FILES['file']['error']));
				} else {
					if (file_exists('./asset/upload/' . $_FILES['file']['name'])) {
						echo json_encode(array("status" => FALSE, "msg" => "Terdapat file yang sama"));
					} else {
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file')) {
							echo $this->upload->display_errors();
						} else {
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
								'user_ind' => 'F',
								'user_foto' => $new_name.'.'.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)
							);
							$this->db->insert("cpns_user",$data);
							if ($this->mcrud->sendMail($user_email, $subject, $message))
							{
								echo json_encode(array("status" => TRUE, "msg" => "Pendaftaran Sukses, Cek Email Untuk Konfirmasi !!"));				
							}
						}
					}
				}
			} else {
				echo json_encode(array("status" => FALSE, "msg" => "Pilih Gambarnya !!"));
			}
		}
	}
	}