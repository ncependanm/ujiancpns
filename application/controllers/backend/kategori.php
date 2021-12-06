<?php
class kategori extends CI_Controller{
    
    var $folder =   "backend/kategori";
    var $tables =   "cpns_kategori_soal";
    var $pk     =   "kategori_soal_id";
    var $title  =   "Daftar Kategori Soal";
    var $titleInputan  =   "Form Kategori Soal";
    
    function __construct() {
        parent::__construct();
		$this->load->model('kategori_model','kategoriModel');
    }
    
    function index()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Kategori Soal - CPNS";
        $data['menu'] = "kategori";
        $data['subMenu'] = "";
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->kategoriModel->get_datatables();
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		
		foreach ($list as $kategori) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kategori->kategori_soal_jenis;
			$row[] = $kategori->kategori_soal_key;
			$row[] = $kategori->kategori_soal_nama;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$kategori->kategori_soal_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$kategori->kategori_soal_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kategoriModel->count_all(),
						"recordsFiltered" => $this->kategoriModel->count_filtered(),
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
			'kategori_soal_jenis' => $this->input->post('kategori_soal_jenis'),
			'kategori_soal_nama' => $this->input->post('kategori_soal_nama')
			);
        $this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE));
	}
	
	function save()
	{
		$jenis = $this->input->post('kategori_soal_jenis');
		$sql = "SELECT * FROM cpns_kategori_soal WHERE kategori_soal_jenis = '". $jenis ."'";
		$jml = $this->db->query($sql)->num_rows();
		$jml = $jml + 1;
		$key = '';
		if($jml <= 9){
			$key = $jenis . '00' . $jml;
		} else if($jml < 99){
			$key = $jenis . '0' . $jml;
		}
		$data = array(
			'kategori_soal_jenis' => $jenis,
			'kategori_soal_key' => $key,
			'kategori_soal_nama' => $this->input->post('kategori_soal_nama')
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