<?php
class soal extends CI_Controller{
    
    var $folder =   "backend/soal";
    var $tables =   "cpns_soal";
    var $pk     =   "soal_id";
    var $title  =   "Daftar Soal";
    var $titleInputan  =   "Form Soal";
    
    function __construct() {
        parent::__construct();
		$this->load->model('soal_model','soalModel');
    }
    
    function index()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Soal - CPNS";
        $data['menu'] = "soal";
        $data['subMenu'] = "";
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->soalModel->get_datatables();
		$data = array();
		$no = 0;
		$jenisKelamin = "";
		
		foreach ($list as $soal) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $soal->soal_type;
			$row[] = $soal->kategori_soal_nama;
			$row[] = $soal->soal_sesi;
			$row[] = $soal->soal_pertanyaan;
			$row[] = $soal->soal_jawaban_a;
			$row[] = $soal->soal_jawaban_b;
			$row[] = $soal->soal_jawaban_c;
			$row[] = $soal->soal_jawaban_d;
			$row[] = $soal->soal_jawaban_e;
			$row[] = $soal->soal_kunci_jawaban;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$soal->soal_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$soal->soal_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->soalModel->count_all(),
						"recordsFiltered" => $this->soalModel->count_filtered(),
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
			'soal_sesi' => $this->input->post('soal_sesi'),
			'soal_pertanyaan' => $this->input->post('soal_pertanyaan'),
			'soal_jawaban_a' => $this->input->post('soal_jawaban_a'),
			'soal_jawaban_b' => $this->input->post('soal_jawaban_b'),
			'soal_jawaban_c' => $this->input->post('soal_jawaban_c'),
			'soal_jawaban_d' => $this->input->post('soal_jawaban_d'),
			'soal_jawaban_e' => $this->input->post('soal_jawaban_e'),
			'soal_kunci_jawaban' => $this->input->post('soal_kunci_jawaban'),
			'soal_type' => $this->input->post('soal_type'),
			'soal_kategori_id' => $this->input->post('soal_kategori_id'),
			'soal_nilai_a' => $this->input->post('soal_nilai_a'),
			'soal_nilai_b' => $this->input->post('soal_nilai_b'),
			'soal_nilai_c' => $this->input->post('soal_nilai_c'),
			'soal_nilai_d' => $this->input->post('soal_nilai_d'),
			'soal_nilai_e' => $this->input->post('soal_nilai_e'),
			'soal_nilai_benar' => $this->input->post('soal_nilai_benar'),
			'soal_nilai_salah' => $this->input->post('soal_nilai_salah'),
			'soal_nilai_kosong' => $this->input->post('soal_nilai_kosong'),
			'soal_penyelesaian' => $this->input->post('soal_penyelesaian')
			);
        $this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE));
	}
	
	function save()
	{
		$data = array(
			'soal_sesi' => $this->input->post('soal_sesi'),
			'soal_pertanyaan' => $this->input->post('soal_pertanyaan'),
			'soal_jawaban_a' => $this->input->post('soal_jawaban_a'),
			'soal_jawaban_b' => $this->input->post('soal_jawaban_b'),
			'soal_jawaban_c' => $this->input->post('soal_jawaban_c'),
			'soal_jawaban_d' => $this->input->post('soal_jawaban_d'),
			'soal_jawaban_e' => $this->input->post('soal_jawaban_e'),
			'soal_kunci_jawaban' => $this->input->post('soal_kunci_jawaban'),
			'soal_type' => $this->input->post('soal_type'),
			'soal_kategori_id' => $this->input->post('soal_kategori_id'),
			'soal_nilai_a' => $this->input->post('soal_nilai_a'),
			'soal_nilai_b' => $this->input->post('soal_nilai_b'),
			'soal_nilai_c' => $this->input->post('soal_nilai_c'),
			'soal_nilai_d' => $this->input->post('soal_nilai_d'),
			'soal_nilai_e' => $this->input->post('soal_nilai_e'),
			'soal_nilai_benar' => $this->input->post('soal_nilai_benar'),
			'soal_nilai_salah' => $this->input->post('soal_nilai_salah'),
			'soal_nilai_kosong' => $this->input->post('soal_nilai_kosong'),
			'soal_penyelesaian' => $this->input->post('soal_penyelesaian')
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
	
	function tampilKategori()
    {
        $kategori_soal_jenis  =   $_GET['kategori_soal_jenis'];
        $data   = $this->db->get_where('cpns_kategori_soal',array('kategori_soal_jenis'=>$kategori_soal_jenis))->result();
        foreach ($data as $r)
        {
            echo "<option value='$r->kategori_soal_id'>".  strtoupper($r->kategori_soal_nama)."</option>";
        }
    }
	
	
	function index2()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Soal - CPNS";
        $data['menu'] = "soal";
        $data['subMenu'] = "";
		
		$this->template->load('backend/template', $this->folder.'/index2',$data);
    }
	
}