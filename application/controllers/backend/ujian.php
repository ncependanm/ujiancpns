<?php
class ujian extends CI_Controller{
    
    var $folder =   "backend/ujian";
    var $tables =   "cpns_ujian";
    var $pk     =   "ujian_id";
    var $title  =   "Daftar Ujian";
    var $titleInputan  =   "Form Ujian";
    
    function __construct() {
        parent::__construct();
		$this->load->model('ujian_model','ujianModel');
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
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->ujianModel->get_datatables();
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		
		foreach ($list as $ujian) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $ujian->ujian_nama;
			$ind = "";
			$tglMulai = "";
			$tglAkhir = "";
			if($ujian->ujian_ind == 'UF')
			{
				$ind = 'Ujian Free';
				$tglMulai = "-";
				$tglAkhir = "-";
			}
			else if($ujian->ujian_ind == 'UP')
			{
				$ind = 'Ujian Premium';
				$tglMulai =  $ujian->ujian_tgl_mulai;
				$tglAkhir =  $ujian->ujian_tgl_akhir;
			}
			$row[] = $tglMulai;
			$row[] = $tglAkhir;
			$row[] = $ujian->ujian_durasi . ' Menit';
			
			$row[] = $ind;
			$row[] = $ujian->ujian_keterangan;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$ujian->ujian_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$ujian->ujian_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ujianModel->count_all(),
						"recordsFiltered" => $this->ujianModel->count_filtered(),
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
			'ujian_nama' => $this->input->post('ujian_nama'),
			'ujian_tgl_mulai' => $this->input->post('ujian_tgl_mulai'),
			'ujian_tgl_akhir' => $this->input->post('ujian_tgl_akhir'),
			'ujian_paket_parent_id' => $this->input->post('ujian_paket_parent_id'),
			'ujian_durasi' => $this->input->post('ujian_durasi'),
			'ujian_ind' => $this->input->post('ujian_ind'),
			'ujian_keterangan' => $this->input->post('ujian_keterangan')
			);
        $this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE));
	}
	
	function save()
	{
		$data = array(
			'ujian_nama' => $this->input->post('ujian_nama'),
			'ujian_tgl_mulai' => $this->input->post('ujian_tgl_mulai'),
			'ujian_tgl_akhir' => $this->input->post('ujian_tgl_akhir'),
			'ujian_paket_parent_id' => $this->input->post('ujian_paket_parent_id'),
			'ujian_durasi' => $this->input->post('ujian_durasi'),
			'ujian_ind' => $this->input->post('ujian_ind'),
			'ujian_keterangan' => $this->input->post('ujian_keterangan')
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
	
	function tampilPaket()
    {
        $ujian_paket_parent_id  =   $_GET['ujian_paket_parent_id'];
        $data   = $this->db->get_where('cpns_paket_parent')->result();
        foreach ($data as $r)
        {
            echo "<option value='$r->paket_parent_id'>".  strtoupper($r->paket_parent_nama)."</option>";
        }
    }
	
}