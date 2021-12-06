<?php
class profile extends CI_Controller{
    
    var $folder =   "backend/profile";
    var $tables =   "cpns_user";
    var $pk     =   "user_id";
    var $title  =   "Daftar Admin";
    var $titleInputan  =   "Form Admin";
    
    function __construct() {
        parent::__construct();
		$this->load->model('user_model','userModel');
    }
    
    function index()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data User - CPNS";
        $data['menu'] = "profile";
        $data['subMenu'] = "";
		
		$sql = "SELECT * FROM cpns_user 
				WHERE user_id = '". $this->session->userdata('user_id') ."'";	
		$data['dataUser'] = $this->db->query($sql)->result();
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$ind = 'A';
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
	
	function prepareEdit()
    {
            $data = $this->mcrud->getByID($this->tables,  $this->pk,$this->session->userdata('user_id'))->row_array();
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
			'user_alamat' => $this->input->post('user_alamat')
			);
        $this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE));
	}
	
	function updatePass()
	{
		$id = $this->input->post('id');
		if($this->input->post('user_password_old') == '')
		{
			echo json_encode(array("status" => FALSE, "msg" => "Password Lama Harus Diisi"));
		} 
		else if($this->input->post('user_password_new') == '')
		{
			echo json_encode(array("status" => FALSE, "msg" => "Password Baru Harus Diisi"));			
		} 
		else if($this->input->post('user_password_new_konfirmasi') == '')
		{
			echo json_encode(array("status" => FALSE, "msg" => "Konfirmasi Password Baru Harus Diisi"));
		}
		else
		{
			if($this->input->post('user_password_new') == $this->input->post('user_password_new_konfirmasi'))
			{
				$this->db->from('cpns_user');
				$this->db->where('user_id', $this->session->userdata('user_id'));
				$this->db->where('user_password', MD5($this->input->post('user_password_old')));

				$user = $this->db->count_all_results();
				if($user <= 0){
					echo json_encode(array("status" => FALSE, "msg" => "Password Lama Tidak Sesuai"));
				} else {
					$data = array(
						'user_password' => MD5($this->input->post('user_password_new_konfirmasi'))
						);
					$this->mcrud->update($this->tables,$data, $this->pk,$this->session->userdata('user_id'));
					echo json_encode(array("status" => TRUE));
				}
			} 
			else
			{
					echo json_encode(array("status" => FALSE, "msg" => "Konfirmasi Password Tidak Sesuai"));
			}
			
		}
	}
	
	function save()
	{
		$data = array(
			'user_nama' => $this->input->post('user_nama'),
			'user_email' => $this->input->post('user_email'),
			'user_username' => $this->input->post('user_username'),
			'user_no_hp' => $this->input->post('user_no_hp'),
			'user_password' => MD5($this->input->post('user_password')),
			'user_akses' => 'A'
		);
		$this->db->insert($this->tables,$data);
		echo json_encode(array("status" => TRUE));
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
	
	
	public function updateFoto()
	{					
			//upload file
			$config['upload_path'] = './asset/upload/';
			$config['allowed_types'] = '*';
			$config['max_filename'] = '255';
			$config['max_size'] = '1024'; //1 MB
			$new_name = time(). 'user';
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
							echo json_encode(array("status" => FALSE, "msg" => $this->upload->display_errors()));
						} else {
							$data = array(
								'user_foto' => $new_name.'.'.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)
							);
							$this->mcrud->update($this->tables,$data, $this->pk,$this->session->userdata('user_id'));
							echo json_encode(array("status" => TRUE, "msg" => "Sukses !!"));
						}
					}
				}
			} else {
				echo json_encode(array("status" => FALSE, "msg" => "Pilih Gambarnya !!"));
			}
	}
	
	
}