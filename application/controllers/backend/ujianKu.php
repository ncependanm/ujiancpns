<?php
class ujianKu extends CI_Controller{
    
    var $folder =   "backend/ujianKu";
    var $tables =   "cpns_ujian";
    var $pk     =   "ujian_id";
    var $title  =   "Daftar Ujian";
    var $titleInputan  =   "Form Ujian";
    
    function __construct() {
        parent::__construct();
		$this->load->model('ujianku_model','ujianModel');
		$this->load->model('tes_model','tesModel');
    }
    
    function index()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Ujian - CPNS";
        $data['menu'] = "ujian";
        $data['subMenu'] = "";
		$sql = "select * from cpns_tes_parent where tes_parent_user_id = '". $this->session->userdata('user_id') ."'";
		$data['jmlUjianDiikuti'] = $this->db->query($sql)->num_rows();
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable($ind)
	{	
		$sql = "SELECT * FROM cpns_tes_parent WHERE tes_parent_user_id = '". $this->session->userdata('user_id') ."'";	
		$data = $this->db->query($sql)->result();
		$idSoalIN = array();
		$coma = "";
		$idUjian = '0';
        foreach ($data as $r)
        {
			$idUjian = $idUjian . ',' .$r->tes_parent_ujian_id;
        }
		
		$list = $this->ujianModel->get_datatables($ind);
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		$ujianInd = "";
		$ujianIndTmp = "";
		foreach ($list as $ujian) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $ujian->ujian_nama;
			$ujianInd = $ujian->ujian_ind;
			if($ujianInd == 'UF'){
				$ujianIndTmp = 'Ujian Free';
			} else {
				$ujianIndTmp = 'Ujian Premium';
			}
			$row[] = $ujianIndTmp;
			$row[] = $ujian->ujian_tgl_mulai;
			$row[] = $ujian->ujian_tgl_akhir;
			$row[] = $ujian->ujian_durasi . ' Menit';
			$row[] = $ujian->ujian_keterangan;

			//add html for action
			$aksi = "";
			if($ind == 'S'){
				if (strpos($idUjian, $ujian->ujian_id) !== false) {
					$query="SELECT * FROM cpns_tes_parent WHERE tes_parent_ujian_id = '". $ujian->ujian_id ."' and tes_parent_user_id = '". $this->session->userdata('user_id') ."' ";
					$dataTesParent =  $this->db->query($query)->result();
					$indSelesai = "";
					foreach ($dataTesParent as $d)
					{
						$indSelesai = $d->tes_parent_ind;
					}
					if($indSelesai == "N"){
						$aksi = '<a class="btn btn-sm btn-primary" href="'.base_url().'backend/cat" title="Lanjutkan Ujian Belum Selesai">Lanjutkan</a>';
					} else if($indSelesai == "Y"){
if(gmdate("Y-m-d", time()+60*60*7) > $ujian->ujian_tgl_akhir){
							$aksi = '<label class="btn btn-sm btn-warning">Sudah Diikuti</label> <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Lihat" onclick="viewHasil('."'".$ujian->ujian_id."'".')">Lihat Penyelesaian</a>';
						} else {
							$aksi = '<label class="btn btn-sm btn-warning">Sudah Diikuti</label>';
						}
					}				
				} else {
					$aksi = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="view('."'".$ujian->ujian_id."'".', '."'K'".', '."'". $ujianInd ."'".')">Ikuti</a>';
				}
			} else if($ind == 'M'){
				$aksi = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="view('."'".$ujian->ujian_id."'".', '."'L'".', '."'". $ujianInd ."'".')">Lihat</a>';
			} else if($ind == 'L'){


if (strpos($idUjian, $ujian->ujian_id) !== false) {
					$query="SELECT * FROM cpns_tes_parent WHERE tes_parent_ujian_id = '". $ujian->ujian_id ."' and tes_parent_user_id = '". $this->session->userdata('user_id') ."' ";
					$dataTesParent =  $this->db->query($query)->result();
					$indSelesai = "";
					foreach ($dataTesParent as $d)
					{
						$indSelesai = $d->tes_parent_ind;
					}
					if($indSelesai == "N"){
						$aksi = '<a class="btn btn-sm btn-primary" href="'.base_url().'backend/cat" title="Lanjutkan Ujian Belum Selesai">Lanjutkan</a>';
					} else if($indSelesai == "Y"){
if(gmdate("Y-m-d", time()+60*60*7) > $ujian->ujian_tgl_akhir){
							$aksi = '<label class="btn btn-sm btn-warning">Sudah Diikuti</label> <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Lihat" onclick="viewHasil('."'".$ujian->ujian_id."'".')">Lihat Penyelesaian</a>';
						} else {
							$aksi = '<label class="btn btn-sm btn-warning">Sudah Diikuti</label>';
						}
					}				
				} else {
					$aksi = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="view('."'".$ujian->ujian_id."'".', '."'L'".', '."'". $ujianInd ."'".')">Lihat</a>';
				}				
			} 
			$row[] = $aksi;
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ujianModel->count_all($ind),
						"recordsFiltered" => $this->ujianModel->count_filtered($ind),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function prepareEdit($id, $ujianInd)
    {
		$ind = '';
		$msgM = '';
		if($ujianInd == 'UF'){
			$ind = true;
		} else {
			$sql = "SELECT * FROM cpns_tes_parent ctp 
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					where tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
					and cu.ujian_ind = 'UP'";
			$jmlUjianDiikuti = $this->db->query($sql)->num_rows();
			
			if($this->session->userdata('user_ind') == 'F' ){
				if($jmlUjianDiikuti < 2){
					$ind = true;
				} else {
					$ind = false;
				$msgM = 'Anda adalah user Free, hanya bisa mengikuti 2x ujian';
				}
			} else if($this->session->userdata('user_ind') == 'D' ){
				if($jmlUjianDiikuti < 5){
					$ind = true;
				} else{
					$ind = false;
				$msgM = 'Anda adalah user Deluxe, hanya bisa mengikuti 5x ujian';
				}
			} else if($this->session->userdata('user_ind') == 'S' ){
				if($jmlUjianDiikuti < 15){
					$ind = true;
				} else{
					$ind = false;
				$msgM = 'Anda adalah user Super, hanya bisa mengikuti 15x ujian';
				}
			} else if($this->session->userdata('user_ind') == 'P' ){
				if($jmlUjianDiikuti < 30){
					$ind = true;
				} else{
					$ind = false;
					$msgM = 'Anda adalah user Premium, hanya bisa mengikuti 30x ujian';
				}
			} 
		}
		$data = '';
		if($ind == true){
			$sql = "SELECT cu.ujian_id as idPaket, cu.ujian_nama as nama, cu.ujian_durasi as durasi, cu.ujian_tgl_mulai as mulai, cu.ujian_tgl_akhir as akhir, COUNT(cpd.paket_detail_id) as jmlSoal FROM cpns_ujian cu 
					JOIN cpns_paket_parent cpp ON(cu.ujian_paket_parent_id = cpp.paket_parent_id) 
					JOIN cpns_paket_detail cpd ON(cpp.paket_parent_id = cpd.paket_detail_paket_parent_id) 
					WHERE cu.ujian_id = '" . $id . "'";
			
			$data =  $this->db->query($sql)->row_array();			
			echo json_encode(array("status" => TRUE, "msg" => "Paket Berhasil Diambil, Selamat Mengerjakan", "data" => $data));
		} else {
			echo json_encode(array("status" => FALSE, "msg" => $msgM, "data" => $data));
		}
    }
	
	function kerjakan($idPaket)
	{
		$this->db->from('cpns_tes_parent');
		$this->db->where('tes_parent_user_id', $this->session->userdata('user_id'));
		$this->db->where('tes_parent_ind', 'N');
		
		if($this->db->count_all_results() > 0)
		{
			echo json_encode(array("status" => FALSE, "msg" => "Masih Ada Paket Yang Belum Selesai"));		
		}
		else
		{
			$query="SELECT * FROM cpns_ujian WHERE ujian_id = '". $idPaket ."'";
			$dataTesParent =  $this->db->query($query)->result();
			$waktu = "";
			foreach ($dataTesParent as $d)
			{
				$waktu = $d->ujian_durasi." minutes";
			}
			
			$dateSelesai = date_create(gmdate("Y-m-d H:i:s", time()+60*60*7));
			date_add($dateSelesai, date_interval_create_from_date_string($waktu));

			$date = date_create(gmdate("Y-m-d H:i:s", time()+60*60*7));
			$data = array(
				'tes_parent_user_id' => $this->session->userdata('user_id'),
				'tes_parent_ujian_id' => $idPaket,
				'tes_parent_waktu' => date_format($date, 'Y-m-d H:i:s'),
				'tes_parent_waktu_selesai' => date_format($dateSelesai, 'Y-m-d H:i:s'),
			);
			$this->db->insert('cpns_tes_parent',$data);
			
			$idTesParent = "";
			$query="SELECT * FROM cpns_tes_parent ctp 
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id)  
					WHERE tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
					AND tes_parent_ujian_id = '". $idPaket ."'";
			$dataTesParent =  $this->db->query($query)->result();
			foreach ($dataTesParent as $d)
			{
				$idTesParent = $d->tes_parent_id;
				$idPaketTmp = $d->ujian_paket_parent_id;
			}
			
			$query="SELECT * FROM cpns_paket_detail WHERE paket_detail_paket_parent_id = '". $idPaketTmp ."'";
			$dataPaketDetail =  $this->db->query($query)->result();
			foreach ($dataPaketDetail as $d)
			{
				$data = array(
					'tes_detail_tes_id' => $idTesParent,
					'tes_detail_soal_id' => $d->paket_detail_soal_id,
					'tes_detail_jawaban' => '',
					'tes_detail_nilai' => 0
				);
				$this->db->insert('cpns_tes_detail',$data);
			}
			echo json_encode(array("status" => TRUE, "msg" => "Paket Berhasil Diambil, Selamat Mengerjakan"));			
		}
	}
	
	function prepareTampilkanData($id)
    {
		$sql = "SELECT * FROM cpns_ujian cu 
				JOIN cpns_paket_parent cp ON(cu.ujian_paket_parent_id = cp.paket_parent_id)
				JOIN cpns_paket_detail cd ON (cp.paket_parent_id = cd.paket_detail_paket_parent_id) 
				WHERE cu.ujian_id = '". $id ."'";	
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
	
	
	
	public function loadTableUjianFree()
	{	
		$sql = "SELECT * FROM cpns_tes_parent WHERE tes_parent_user_id = '". $this->session->userdata('user_id') ."'";	
		$data = $this->db->query($sql)->result();
		$idSoalIN = array();
		$coma = "";
		$idUjian = '0';
        foreach ($data as $r)
        {
			$idUjian = $idUjian . ',' .$r->tes_parent_ujian_id;
        }
		
		$list = $this->ujianModel->get_datatables_free();
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		$ujianInd = "";
		$ujianIndTmp = "";
		foreach ($list as $ujian) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $ujian->ujian_nama;
			$ujianInd = $ujian->ujian_ind;
			if($ujianInd == 'UF'){
				$ujianIndTmp = 'Ujian Free';
			} else {
				$ujianIndTmp = 'Ujian Premium';
			}
			$row[] = $ujianIndTmp;
			$row[] = $ujian->ujian_durasi . ' Menit';
			$row[] = $ujian->ujian_keterangan;

			//add html for action
			$aksi = "";
			if (strpos($idUjian, $ujian->ujian_id) !== false) {
					$query="SELECT * FROM cpns_tes_parent WHERE tes_parent_ujian_id = '". $ujian->ujian_id ."' and tes_parent_user_id = '". $this->session->userdata('user_id') ."' ";
					$dataTesParent =  $this->db->query($query)->result();
					$indSelesai = "";
					foreach ($dataTesParent as $d)
					{
						$indSelesai = $d->tes_parent_ind;
					}
					if($indSelesai == "N"){
						$aksi = '<a class="btn btn-sm btn-primary" href="'.base_url().'backend/cat" title="Lanjutkan Ujian Belum Selesai">Lanjutkan</a>';
					} else if($indSelesai == "Y"){
						if(gmdate("Y-m-d", time()+60*60*7) > $ujian->ujian_tgl_akhir){
							$aksi = '<label class="btn btn-sm btn-warning">Sudah Diikuti</label> <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Lihat" onclick="viewHasil('."'".$ujian->ujian_id."'".')">Lihat Penyelesaian</a>';
						} else {
							$aksi = '<label class="btn btn-sm btn-warning">Sudah Diikuti</label>';
						}
					}				
				} else {
					$aksi = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="view('."'".$ujian->ujian_id."'".', '."'K'".', '."'". $ujianInd ."'".')">Ikuti</a>';
				}				
			
			$row[] = $aksi;
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ujianModel->count_all_free(),
						"recordsFiltered" => $this->ujianModel->count_filtered_free(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}