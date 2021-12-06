<?php
class profile extends CI_Controller
{	
    function __construct() 
	{
        parent::__construct();
    }
    
    function index()
    {
        $data['title'] = 'Profile';
        $data['menu'] = 'profile';
        $data['judulForm'] = 'Form Pendaftaran';
		$data['heading'] = 'Halaman tidak ditemukan';
		$data['keterangan'] = 'Kami tidak menemukan halaman yang anda minta';
		
		$query="SELECT * FROM cpns_paket_parent WHERE paket_parent_ind IN ('F','P')";
        $data['paketParent']=  $this->db->query($query)->result();

		$query="SELECT * FROM cpns_tes_parent WHERE tes_parent_user_id  = '". $this->session->userdata('user_id') ."' AND tes_parent_ket = 'B'";
        $data['tesParent']=  $this->db->query($query)->result();
		
		$query="SELECT * FROM cpns_ujian cu 
				JOIN cpns_paket_parent cpp ON(cu.ujian_paket_parent_id = cpp.paket_parent_id) 
				WHERE cpp.paket_parent_ind IN ('U')";
        $data['paketParentUjian']=  $this->db->query($query)->result();

		$query="SELECT * FROM cpns_tes_parent WHERE tes_parent_user_id  = '". $this->session->userdata('user_id') ."' AND tes_parent_ket = 'U'";
        $data['tesParentUjian']=  $this->db->query($query)->result();
		
		$this->template->load('tema', 'profile', $data);
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
			$query="SELECT * FROM cpns_paket_parent WHERE paket_parent_id = '". $idPaket ."'";
			$dataTesParent =  $this->db->query($query)->result();
			$waktu = "";
			foreach ($dataTesParent as $d)
			{
				$waktu = $d->paket_parent_durasi." minutes";
			}
			
			$dateSelesai = date_create(date('Y-m-d H:i:s'));
			date_add($dateSelesai, date_interval_create_from_date_string('6 hours'));
			date_add($dateSelesai, date_interval_create_from_date_string($waktu));

			$date = date_create(date('Y-m-d H:i:s'));
			date_add($date, date_interval_create_from_date_string('6 hours'));
			$data = array(
				'tes_parent_user_id' => $this->session->userdata('user_id'),
				'tes_parent_paket_parent_id' => $idPaket,
				'tes_parent_waktu' => date_format($date, 'Y-m-d H:i:s'),
				'tes_parent_waktu_selesai' => date_format($dateSelesai, 'Y-m-d H:i:s'),
			);
			$this->db->insert('cpns_tes_parent',$data);
			
			$idTesParent = "";
			$query="SELECT * FROM cpns_tes_parent WHERE tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
					AND tes_parent_paket_parent_id = '". $idPaket ."'";
			$dataTesParent =  $this->db->query($query)->result();
			foreach ($dataTesParent as $d)
			{
				$idTesParent = $d->tes_parent_id;
			}
			
			$query="SELECT * FROM cpns_paket_detail WHERE paket_detail_paket_parent_id = '". $idPaket ."'";
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
}