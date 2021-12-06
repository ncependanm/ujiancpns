<?php
class paketSelesai extends CI_Controller{
    
    var $folder =   "backend/paketSelesai";
    var $tables =   "cpns_tes_parent";
    var $pk     =   "paket_tes_id";
    var $title  =   "Daftar Paket Selesai Dikerjakan";
    var $titleInputan  =   "";
    
    function __construct() {
        parent::__construct();
		$this->load->model('tes_model','tesModel');
		$this->load->model('soal_model','soalModel');
    }
    
    function index()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Paket Soal Selesai Dikerjakan - CPNS";
        $data['menu'] = "paket";
        $data['subMenu'] = "paketSelesai";
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->tesModel->get_datatables($this->session->userdata('user_id'));
		$data = array();
		$no = 0;
		
		foreach ($list as $paket) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $paket->paket_parent_nama;
			$jenisPaket = "";
			if($paket->paket_parent_ind == 'F'){
				$jenisPaket = 'Free';
			} else if($paket->paket_parent_ind == 'P'){
				$jenisPaket = 'Premium';
			}
			$row[] = $jenisPaket;
			$row[] = $paket->paket_parent_ket;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Lihat Solusi Soal" onclick="show('."'".$paket->paket_parent_id."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->tesModel->count_all($this->session->userdata('user_id')),
						"recordsFiltered" => $this->tesModel->count_filtered($this->session->userdata('user_id')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function prepareTampilkanData($id)
    {
		$sql = "SELECT * FROM cpns_paket_parent cp 
				JOIN cpns_paket_detail cd ON (cp.paket_parent_id = cd.paket_detail_paket_parent_id) 
				WHERE cp.paket_parent_id = '". $id ."'";	
		$data = $this->db->query($sql)->row_array();
        echo json_encode($data);
    }
	
	public function loadTableSoalView($idPaket)
	{	
		$list = $this->tesModel->get_datatables_view($idPaket);
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
			$row[] = $soal->tes_detail_jawaban;
			$row[] = $soal->soal_kunci_jawaban;
			$row[] = $soal->soal_penyelesaian;
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->tesModel->count_all_view($idPaket),
						"recordsFiltered" => $this->tesModel->count_filtered_view($idPaket),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
}