<?php
class hasil extends CI_Controller
{	
    function __construct() 
	{
        parent::__construct();
    }
	
	function index()
    {
        $data['title'] = 'Hasil Simulasi';
        $data['menu'] = 'hasil';
        $data['judulForm'] = 'Hasil Simulasi';
		$data['heading'] = 'Halaman tidak ditemukan';
		$data['keterangan'] = 'Kami tidak menemukan halaman yang anda minta';

		$this->template->load('tema', 'hasil', $data);
    }

	function paket($id)
    {
        $data['title'] = 'Hasil Simulasi';
        $data['menu'] = 'hasil';
        $data['judulForm'] = 'INFORMASI HASIL TES';
		$data['heading'] = 'Halaman tidak ditemukan';
		$data['keterangan'] = 'Kami tidak menemukan halaman yang anda minta';
		
		$sql    =   "SELECT * FROM cpns_tes_parent cp 
							JOIN cpns_tes_detail cd ON(cp.tes_parent_id = cd.tes_detail_tes_id) 
							JOIN cpns_soal cs ON(cd.tes_detail_soal_id = cs.soal_id) 
							JOIN cpns_kategori_soal ck ON(cs.soal_kategori_id = ck.kategori_soal_id) 
							WHERE cp.tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND cp.tes_parent_id = '" . $id . "'
							AND cp.tes_parent_ind = 'Y' ";
		$dataPaket = $this->db->query($sql)->result();
		$nilaiTotal = 0; 
		$nilaiTWK = 0; 
		$nilaiTIU = 0; 
		$nilaiTKP = 0; 
		foreach ($dataPaket as $r)
		{
			if($r->soal_type == "TWK"){
				$nilaiTWK += $r->tes_detail_nilai;
			} else if($r->soal_type == "TIU"){
				$nilaiTIU += $r->tes_detail_nilai;
			} else if($r->soal_type == "TKP"){
				$nilaiTKP += $r->tes_detail_nilai;
			}
			$nilaiTotal += $r->tes_detail_nilai;
		}
		$data['nilaiTWK'] = $nilaiTWK;
		$data['nilaiTIU'] = $nilaiTIU;
		$data['nilaiTKP'] = $nilaiTKP;
		$data['nilaiTotal'] = $nilaiTotal;

		$this->template->load('tema', 'hasil', $data);
    }
}