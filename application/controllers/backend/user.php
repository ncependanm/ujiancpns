<?php
class user extends CI_Controller{
    
    var $folder =   "backend/user";
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
        $data['menu'] = "user";
        $data['subMenu'] = "admin";
		
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
			'user_password' => MD5($this->input->post('user_password')),
			'user_akses' => 'A'
			);
        $this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE));
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
}