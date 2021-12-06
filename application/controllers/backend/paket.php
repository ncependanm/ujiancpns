<?php
class paket extends CI_Controller{
    
    var $folder =   "backend/paket";
    var $tables =   "cpns_paket_parent";
    var $pk     =   "paket_parent_id";
    var $title  =   "Daftar Paket Soal";
    var $titleInputan  =   "Form Paket Soal";
    
    function __construct() {
        parent::__construct();
		$this->load->model('paket_model','paketModel');
		$this->load->model('soal_model','soalModel');
    }
    
    function index()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Paket Soal - CPNS";
        $data['menu'] = "paket";
        $data['subMenu'] = "";
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->paketModel->get_datatables();
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		
		foreach ($list as $paket) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $paket->paket_parent_nama;
			$row[] = $paket->paket_parent_ket;
			$row[] = '<a class="btn btn-sm btn-info" id="addSoal" title="Tambah Soal" href="'.base_url().'backend/paket/soal/'.$paket->paket_parent_id.'">Tambah Soal</a>';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$paket->paket_parent_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Show" onclick="show('."'".$paket->paket_parent_id."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$paket->paket_parent_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->paketModel->count_all(),
						"recordsFiltered" => $this->paketModel->count_filtered(),
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
	
	function prepareTampilkanData($id)
    {
		$sql = "SELECT * FROM cpns_paket_parent cp 
				JOIN cpns_paket_detail cd ON (cp.paket_parent_id = cd.paket_detail_paket_parent_id) 
				WHERE cp.paket_parent_id = '". $id ."'";	
		$data = $this->db->query($sql)->row_array();
        echo json_encode($data);
    }
	
    function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'paket_parent_nama' => $this->input->post('paket_parent_nama'),
			'paket_parent_ket' => $this->input->post('paket_parent_ket')
			);
        $this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE));
	}
	
	function save()
	{
		$data = array(
			'paket_parent_nama' => $this->input->post('paket_parent_nama'),
			'paket_parent_ket' => $this->input->post('paket_parent_ket')
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

    function soal($id)
    {
        $data['title'] = "Daftar Soal";
        $data['titleInputan'] = "Form Cari Soal";
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Tambah Soal - CPNS";
        $data['menu'] = "paket";
        $data['subMenu'] = "";
        $data['idPaket'] = $id;
		$sql    =   "SELECT * FROM cpns_paket_detail 
							WHERE paket_detail_paket_parent_id = '". $id ."' ";
		$jmlSoalPerPaket = $this->db->query($sql)->num_rows();
		$jml = $jmlSoalPerPaket + 1;
		$data['jmlSoalTmp'] = $jmlSoalPerPaket;
		
		$this->template->load('backend/template', $this->folder.'/addSoal',$data);
    }
	
	public function loadTableSoal($type, $idPaket)
	{	
		$sql = "SELECT * FROM cpns_paket_detail WHERE paket_detail_paket_parent_id = '". $idPaket ."'";	
		$data = $this->db->query($sql)->result();
		$idSoalIN = array();
		$coma = "";
		$idSoalIN[] = '0';
        foreach ($data as $r)
        {
			$idSoalIN[] = $r->paket_detail_soal_id;
        }
		$list = $this->soalModel->get_datatables_by_type($type, $idSoalIN);
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		
		foreach ($list as $soal) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $soal->soal_sesi;
			$row[] = $soal->kategori_soal_nama;
			$row[] = $soal->soal_pertanyaan;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-danger" id="tambahData" href="javascript:void(0)" title="Hapus" data-id="'.$soal->soal_id.'"><i class="glyphicon glyphicon-plus"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->soalModel->count_all_by_type($type, $idSoalIN),
						"recordsFiltered" => $this->soalModel->count_filtered_by_type($type, $idSoalIN),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambahsoal($idParent, $idSoal, $kategoriTmpSoal)
	{
		$sql    =   "SELECT * FROM cpns_paket_detail 
							WHERE paket_detail_paket_parent_id = '". $idParent ."' ";
		$jmlSoalPerPaket = $this->db->query($sql)->num_rows();
		$jml = $jmlSoalPerPaket + 1;
		if($jml <= 35){
			if($kategoriTmpSoal == 'TWK'){
				if($jml > 100){
					echo json_encode(array("status" => FALSE, "msg" => "Soal Gagal Ditambah, Karena Sudah 100 Soal Ditambahkan", "jmlSoal" => $jmlSoalPerPaket));	
				} else {
					$data = array(
						'paket_detail_paket_parent_id' => $idParent,
						'paket_detail_soal_id' => $idSoal
					);
					$this->db->insert("cpns_paket_detail",$data);
					echo json_encode(array("status" => TRUE, "msg" => "Soal Berhasil Ditambah", "jmlSoal" => $jml));			
				}				
			} 
			else{
				echo json_encode(array("status" => FALSE, "msg" => "Sebelum menambahkan 35 soal, masih harus sesi TWK", "jmlSoal" => $jmlSoalPerPaket));
			}
		} else if($jml <= 65){
			if($kategoriTmpSoal == 'TIU'){
				if($jml > 100){
					echo json_encode(array("status" => FALSE, "msg" => "Soal Gagal Ditambah, Karena Sudah 100 Soal Ditambahkan", "jmlSoal" => $jmlSoalPerPaket));	
				} else {
					$data = array(
						'paket_detail_paket_parent_id' => $idParent,
						'paket_detail_soal_id' => $idSoal
					);
					$this->db->insert("cpns_paket_detail",$data);
					echo json_encode(array("status" => TRUE, "msg" => "Soal Berhasil Ditambah", "jmlSoal" => $jml));			
				}				
			} 
			else{
				echo json_encode(array("status" => FALSE, "msg" => "Sebelum menambahkan 65 soal, masih harus sesi TIU", "jmlSoal" => $jmlSoalPerPaket));
			}
		} else if($jml <= 100){
			if($kategoriTmpSoal == 'TKP'){
				if($jml > 100){
					echo json_encode(array("status" => FALSE, "msg" => "Soal Gagal Ditambah, Karena Sudah 100 Soal Ditambahkan", "jmlSoal" => $jmlSoalPerPaket));	
				} else {
					$data = array(
						'paket_detail_paket_parent_id' => $idParent,
						'paket_detail_soal_id' => $idSoal
					);
					$this->db->insert("cpns_paket_detail",$data);
					echo json_encode(array("status" => TRUE, "msg" => "Soal Berhasil Ditambah", "jmlSoal" => $jml));			
				}				
			} 
			else{
				echo json_encode(array("status" => FALSE, "msg" => "Sebelum menambahkan 100 soal, masih harus sesi TKP", "jmlSoal" => $jmlSoalPerPaket));
			}
		}
		else{
			echo json_encode(array("status" => FALSE, "msg" => "Soal Gagal Ditambah, Karena Sudah 100 Soal Ditambahkan", "jmlSoal" => $jmlSoalPerPaket));
		}
	}
	
	
	public function loadTableSoalView($idPaket)
	{	
		$sql = "SELECT * FROM cpns_paket_detail WHERE paket_detail_paket_parent_id = '". $idPaket ."'";	
		$data = $this->db->query($sql)->result();
		$idSoalIN = array();
		$idSoalIN[] = 0;
		$coma = "";
        foreach ($data as $r)
        {
			$idSoalIN[] = $r->paket_detail_soal_id;
        }
		$list = $this->soalModel->get_datatables_view($idSoalIN);
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		
		foreach ($list as $soal) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $soal->soal_type;
			$row[] = $soal->kategori_soal_nama;
			$row[] = $soal->soal_pertanyaan;
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->soalModel->count_all_view($idSoalIN),
						"recordsFiltered" => $this->soalModel->count_filtered_view( $idSoalIN),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function tambahkanSoalMulti(){
		$jumlah = count($this->input->post('item'));
		for($i=0; $i < $jumlah; $i++)
		{
			$nim=$this->input->post(["item"][$i]);
		}
		echo json_encode(array("status" => TRUE, "msg" => $jumlah . $nim));
	}
	
}