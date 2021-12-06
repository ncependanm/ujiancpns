<?php
class siswa extends CI_Controller{
    
    var $folder =   "backend/siswa";
    var $tables =   "cpns_user";
    var $pk     =   "user_id";
    var $title  =   "Daftar Siswa";
    var $titleInputan  =   "Form Siswa";
    
    function __construct() {
        parent::__construct();
		$this->load->model('user_model','userModel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    function index()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Siswa - CPNS";
        $data['menu'] = "user";
        $data['subMenu'] = "siswa";
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$ind = 'S';
		$list = $this->userModel->get_datatables($ind);
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->user_nama;
			$row[] = $user->user_email;
			$row[] = $user->user_username;
			$row[] = $user->user_no_hp;
			$status = "";
			if($user->user_status == 0) {
				$status = "<span class='label label-sm label-danger circle'>Belum Verifikasi</span>";
			} else if($user->user_status == 1) {
				$status = "<span class='label label-sm label-info circle'>Sudah Verifikasi</span>";
			}
			$row[] = $user->user_tgl_lahir;
			$row[] = $user->user_asal_sekolah;
			$row[] = $user->user_kelas;
			$row[] = $user->user_alamat;
			$statusSiswa = '';
			if($user->user_ind == 'F') {
				$statusSiswa = 'Free';
			} else if($user->user_ind == 'D') {
				$statusSiswa = 'Deluxe';
			} else if($user->user_ind == 'S') {
				$statusSiswa = 'Super';
			} else if($user->user_ind == 'P') {
				$statusSiswa = 'Premium';
			}
			$row[] = $statusSiswa;
			$foto = "<img width='100%' src='" .base_url() .'asset/upload/'. $user->user_foto. "'>";
			$row[] = $foto;
			$row[] = $status;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$user->user_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$user->user_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->userModel->count_all($ind),
						"recordsFiltered" => $this->userModel->count_filtered($ind),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function prepareEdit($id)
    {
            $data = $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            echo json_encode($data);
    }
    function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'user_nama' => $this->input->post('user_nama'),
			'user_email' => $this->input->post('user_email'),
			'user_username' => $this->input->post('user_username'),
			'user_no_hp' => $this->input->post('user_no_hp'),
			'user_tgl_lahir' => $this->input->post('user_tgl_lahir'),
			'user_asal_sekolah' => $this->input->post('user_asal_sekolah'),
			'user_kelas' => $this->input->post('user_kelas'),
			'user_alamat' => $this->input->post('user_alamat'),
			'user_ind' => $this->input->post('user_ind'),
			'user_akses' => 'S'
			);
        $this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE));
	}
	
	function save()
	{
		$user_email = $this->input->post('user_email');
		$user_username = $this->input->post('user_username');
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
				$data = array('user_nama' => $this->input->post('user_nama'),
								'user_email' => $user_email,
								'user_username' => $user_username,
								'user_no_hp' => $this->input->post('user_no_hp'),
								'user_password' => MD5($this->input->post('user_password')),
								'user_tgl_lahir' => $this->input->post('user_tgl_lahir'),
								'user_asal_sekolah' => $this->input->post('user_asal_sekolah'),
								'user_kelas' => $this->input->post('user_kelas'),
								'user_alamat' => $this->input->post('user_alamat'),
								'user_ind' => $this->input->post('user_ind'),
								'user_akses' => 'S'
							);
							$this->db->insert($this->tables,$data);
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
	
    function delete($id)
    {
        $chekid = $this->db->get_where($this->tables,array($this->pk=>$id));
        if($chekid>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $id);
        }
        echo json_encode(array("status" => TRUE));
    }
	public function upload(){
		  $fileName = $this->input->post('file', TRUE);

		  $config['upload_path'] = './asset/upload/'; 
		  $config['file_name'] = $fileName;
		  $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
		  $config['max_size'] = 10000;

		  $this->load->library('upload', $config);
		  $this->upload->initialize($config); 
		  
		  if (!$this->upload->do_upload('file')) {
		   $error = array('error' => $this->upload->display_errors());
		   $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
		   redirect('backend/siswa/index'); 
		  } else {
		   $media = $this->upload->data();
		   $inputFileName = 'asset/upload/'.$media['file_name'];
		   
		   try {
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		   } catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		   }

		   $sheet = $objPHPExcel->getSheet(0);
		   $highestRow = $sheet->getHighestRow();
		   $highestColumn = $sheet->getHighestColumn();

		   for ($row = 2; $row <= $highestRow; $row++){  
			 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
			   NULL,
			   TRUE,
			   FALSE);
			 $data = array(
			 "user_nama"=> $rowData[0][0],
			 "user_email"=> $rowData[0][1],
			 "user_username"=> $rowData[0][2],
			 "user_no_hp"=> $rowData[0][3],
			 "user_password"=> MD5($rowData[0][4]),
			 "user_tgl_lahir"=> $rowData[0][5],
			 "user_alamat"=> $rowData[0][6],
			 "user_asal_sekolah"=> $rowData[0][7],
			 "user_kelas"=> $rowData[0][8],
			 "user_akses"=> 'S',
			 "user_status"=> '1',
			 "user_ind"=> 'F'
			);
			$this->db->insert("cpns_user",$data);
		   } 
		   $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
		   $this->index();
		  }  
	} 
	
}