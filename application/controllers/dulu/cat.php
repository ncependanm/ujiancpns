<?php
class cat extends CI_Controller
{	
    function __construct() 
	{
        parent::__construct();
    }
	
	function index()
    {
        $data['title'] = 'CAT';
        $data['menu'] = 'cat';
        $data['judulForm'] = 'SIMULASI CAT';
		$data['heading'] = 'Halaman tidak ditemukan';
		$data['keterangan'] = 'Kami tidak menemukan halaman yang anda minta';
		$data['masukInd'] = 'simulasi';
		
		$sql    =   "SELECT * FROM cpns_tes_parent cp 
							JOIN cpns_tes_detail cd ON(cp.tes_parent_id = cd.tes_detail_tes_id) 
							JOIN cpns_soal cs ON(cd.tes_detail_soal_id = cs.soal_id) 
							JOIN cpns_kategori_soal ck ON(cs.soal_kategori_id = ck.kategori_soal_id)
							WHERE cp.tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND cp.tes_parent_ind = 'N' 
							ORDER BY cd.tes_detail_id ASC";
		$data['soal'] = $this->db->query($sql)->result();
		$data['jmlSoal'] = $this->db->query($sql)->num_rows();
		$sql    =   "SELECT * FROM cpns_tes_parent cp 
							JOIN cpns_tes_detail cd ON(cp.tes_parent_id = cd.tes_detail_tes_id) 
							JOIN cpns_soal cs ON(cd.tes_detail_soal_id = cs.soal_id) 
							JOIN cpns_kategori_soal ck ON(cs.soal_kategori_id = ck.kategori_soal_id) 
							WHERE cp.tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND cp.tes_parent_ind = 'N' 
							AND tes_detail_jawaban <> ''";
		$data['jmlTerjawab'] = $this->db->query($sql)->num_rows();
		$idTerjawab = $this->db->query($sql)->result();
		$idTerjawabTmp = ""; $coma = "";
		foreach ($idTerjawab as $r)
		{
			$idTerjawabTmp = $idTerjawabTmp . $coma . $r->tes_detail_id;
			$coma = ",";
		}
		$sql    =   "SELECT * FROM cpns_tes_parent 
							WHERE tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND tes_parent_ind = 'N'";
		$batasWaktu = $this->db->query($sql)->result();
		$batasWaktuTmp = "";
		foreach ($batasWaktu as $r)
		{
			$batasWaktuTmp = $r->tes_parent_waktu_selesai;
		}
		$date = date_create(date('Y-m-d H:i:s'));
		date_add($date, date_interval_create_from_date_string('6 hours'));
		$data['waktuSekarang'] = date_format($date, 'Y-m-d H:i:s');
		$data['batasWaktu'] = $batasWaktuTmp;
		$data['idTerjawabTmp'] = $idTerjawabTmp;
		$data['idNextTmp'] = "#soal1";
		$data['idBackTmp'] = "#soal1";

		$this->template->load('tema', 'cat', $data);
    }
	
	function sim($idN, $idB)
    {
		$data['idNextTmp'] = "#".$idN;
		$data['idBackTmp'] = "#".$idB;
        $data['title'] = 'CAT';
        $data['menu'] = 'cat';
        $data['judulForm'] = 'SIMULASI CAT';
		$data['heading'] = 'Halaman tidak ditemukan';
		$data['keterangan'] = 'Kami tidak menemukan halaman yang anda minta';
		$data['masukInd'] = 'simulasi';
		
		$sql    =   "SELECT * FROM cpns_tes_parent cp 
							JOIN cpns_tes_detail cd ON(cp.tes_parent_id = cd.tes_detail_tes_id) 
							JOIN cpns_soal cs ON(cd.tes_detail_soal_id = cs.soal_id) 
							JOIN cpns_kategori_soal ck ON(cs.soal_kategori_id = ck.kategori_soal_id)
							WHERE cp.tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND cp.tes_parent_ind = 'N' 
							ORDER BY cd.tes_detail_id ASC";
		$data['soal'] = $this->db->query($sql)->result();
		$data['jmlSoal'] = $this->db->query($sql)->num_rows();
		$sql    =   "SELECT * FROM cpns_tes_parent cp 
							JOIN cpns_tes_detail cd ON(cp.tes_parent_id = cd.tes_detail_tes_id) 
							JOIN cpns_soal cs ON(cd.tes_detail_soal_id = cs.soal_id) 
							JOIN cpns_kategori_soal ck ON(cs.soal_kategori_id = ck.kategori_soal_id)
							WHERE cp.tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND cp.tes_parent_ind = 'N' 
							AND tes_detail_jawaban <> ''";
		$data['jmlTerjawab'] = $this->db->query($sql)->num_rows();
		$idTerjawab = $this->db->query($sql)->result();
		$idTerjawabTmp = ""; $coma = "";
		foreach ($idTerjawab as $r)
		{
			$idTerjawabTmp = $idTerjawabTmp . $coma . $r->tes_detail_id;
			$coma = ",";
		}
		$sql    =   "SELECT * FROM cpns_tes_parent 
							WHERE tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND tes_parent_ind = 'N'";
		$batasWaktu = $this->db->query($sql)->result();
		$batasWaktuTmp = "";
		foreach ($batasWaktu as $r)
		{
			$batasWaktuTmp = $r->tes_parent_waktu_selesai;
		}
		$date = date_create(date('Y-m-d H:i:s'));
		date_add($date, date_interval_create_from_date_string('6 hours'));
		$data['waktuSekarang'] = date_format($date, 'Y-m-d H:i:s');
		$data['batasWaktu'] = $batasWaktuTmp;
		$data['idTerjawabTmp'] = $idTerjawabTmp;

		$this->template->load('tema', 'cat', $data);
    }
	
	function saveSoal($id, $jawaban)
	{	
		$sql    =   "SELECT * FROM cpns_tes_detail cd 
						JOIN cpns_soal cs ON(cd.tes_detail_soal_id =  cs.soal_id) 
						WHERE cd.tes_detail_id = '". $id ."'";
		$dataDetail = $this->db->query($sql)->result();
		$nilai = "";
		foreach ($dataDetail as $d)
		{
			if($d->soal_type == "TKP"){
					if($jawaban == "A"){
						$nilai = $d->soal_nilai_a;
					} else if($jawaban == "B"){
						$nilai = $d->soal_nilai_b;
					} else if($jawaban == "C"){
						$nilai = $d->soal_nilai_c;
					} else if($jawaban == "D"){
						$nilai = $d->soal_nilai_d;
					} else if($jawaban == "E"){
						$nilai = $d->soal_nilai_e;
					}
			} else if($d->soal_type == "TWK"){
				if($jawaban == $d->soal_kunci_jawaban){
					$nilai = $d->soal_nilai_benar;
				} else {
					$nilai = $d->soal_nilai_salah;
				}
			} if($d->soal_type == "TIU"){
				if($jawaban == $d->soal_kunci_jawaban){
					$nilai = $d->soal_nilai_benar;
				} else {
					$nilai = $d->soal_nilai_benar;
				}				
			}
		}
		
		$data = array(
			'tes_detail_jawaban' => $jawaban,
			'tes_detail_nilai' => $nilai
			);
        $this->mcrud->update('cpns_tes_detail',$data, 'tes_detail_id',$id);
		$sql    =   "SELECT * FROM cpns_tes_parent cp 
							JOIN cpns_tes_detail cd ON(cp.tes_parent_id = cd.tes_detail_tes_id) 
							JOIN cpns_soal cs ON(cd.tes_detail_soal_id = cs.soal_id) 
							JOIN cpns_kategori_soal ck ON(cs.soal_kategori_id = ck.kategori_soal_id)
							WHERE cp.tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND cp.tes_parent_ind = 'N' 
							AND tes_detail_jawaban <> ''";
		
		echo json_encode(array("status" => TRUE, "jmlTerjawab" => $this->db->query($sql)->num_rows()));
	}
	
	function selesaiKerja()
	{	
		$sql    =   "SELECT * FROM cpns_tes_parent 
							WHERE tes_parent_user_id = '". $this->session->userdata('user_id') ."' 
							AND tes_parent_ind = 'N' ";
		$idParent = $this->db->query($sql)->result();
		$idParentTmp = "";
		foreach ($idParent as $r)
		{
			$idParentTmp = $r->tes_parent_id;
		}
		
		$data = array(
			'tes_parent_ind' => 'Y'
			);
        $this->mcrud->update('cpns_tes_parent',$data, 'tes_parent_id',$idParentTmp);
		
		echo json_encode(array("status" => TRUE, 'idParentTmp' => $idParentTmp));
	}
}