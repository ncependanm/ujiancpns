<?php
class statistik extends CI_Controller{
    
    var $folder =   "backend/statistik";
    var $tables =   "cpns_user";
    var $pk     =   "user_id";
    var $title  =   "Daftar Statistik";
    var $titleInputan  =   "Statistik Hasil Ujian";
    
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
        $data['judulHalaman'] = "Data Statistik - CPNS";
        $data['menu'] = "statistik";
        $data['subMenu'] = "";
		
		$sql = "SELECT cus.user_nama as namaUser, cu.ujian_nama as namaUjian,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK001' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK001,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK002' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK002,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK003' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK003,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK004' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK004,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK005' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK005,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK006' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK006,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK007' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK007,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK008' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK008,

					SUM(CASE WHEN cks.kategori_soal_key = 'TIU001' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU001,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU002' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU002,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU003' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU003,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU004' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU004,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU005' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU005,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU006' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU006,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU007' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU007,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU008' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU008,

					SUM(CASE WHEN cks.kategori_soal_key = 'TKP001' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP001,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP002' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP002,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP003' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP003,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP004' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP004,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP005' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP005,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP006' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP006,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP007' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP007,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP008' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP008,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP009' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP009,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP010' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP010,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP011' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP011,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP012' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP012,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP013' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP013
					FROM cpns_tes_parent ctp 
					JOIN cpns_user cus ON(ctp.tes_parent_user_id = cus.user_id)
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					JOIN cpns_tes_detail ctd ON(ctp.tes_parent_id = ctd.tes_detail_tes_id) 
					JOIN cpns_soal cs ON(ctd.tes_detail_soal_id = cs.soal_id) 
					JOIN cpns_kategori_soal cks ON(cs.soal_kategori_id = cks.kategori_soal_id)
where cus.user_id = '" . $this->session->userdata('user_id') . "' 
					group by ctp.tes_parent_ujian_id					
					ORDER BY ctp.tes_parent_waktu ASC";
		$nilaiTWK1 = '';
		$nilaiTWK2 = '';
		$nilaiTWK3 = '';
		$nilaiTWK4 = '';
		$nilaiTWK5 = '';
		$nilaiTWK6 = '';
		$nilaiTWK7 = '';
		$nilaiTWK8 = '';
		$nilaiTIU1 = '';
		$nilaiTIU2 = '';
		$nilaiTIU3 = '';
		$nilaiTIU4 = '';
		$nilaiTIU5 = '';
		$nilaiTIU6 = '';
		$nilaiTIU7 = '';
		$nilaiTIU8 = '';
		$nilaiTKP1 = '';
		$nilaiTKP2 = '';
		$nilaiTKP3 = '';
		$nilaiTKP4 = '';
		$nilaiTKP5 = '';
		$nilaiTKP6 = '';
		$nilaiTKP7 = '';
		$nilaiTKP8 = '';
		$nilaiTKP9 = '';
		$nilaiTKP10 = '';
		$nilaiTKP11 = '';
		$nilaiTKP12 = '';
		$nilaiTKP13 = '';
		$ujianKe = '';
		$coma = '';
		$i = 0;
		$dataStatistik = $this->db->query($sql)->result();
		foreach ($dataStatistik as $r)
		{
			$i += 1;
			$ujianKe = $ujianKe . $coma . '"Ujian '.$i.'"';
			$nilaiTWK1 = $nilaiTWK1 . $coma . $r->nilaiTWK001;
			$nilaiTWK2 = $nilaiTWK2 . $coma . $r->nilaiTWK002;
			$nilaiTWK3 = $nilaiTWK3 . $coma . $r->nilaiTWK003;
			$nilaiTWK4 = $nilaiTWK4 . $coma . $r->nilaiTWK004;
			$nilaiTWK5 = $nilaiTWK5 . $coma . $r->nilaiTWK005;
			$nilaiTWK6 = $nilaiTWK6 . $coma . $r->nilaiTWK006;
			$nilaiTWK7 = $nilaiTWK7 . $coma . $r->nilaiTWK007;
			$nilaiTWK8 = $nilaiTWK8 . $coma . $r->nilaiTWK008;
			$nilaiTIU1 = $nilaiTIU1 . $coma . $r->nilaiTIU001;
			$nilaiTIU2 = $nilaiTIU2 . $coma . $r->nilaiTIU002;
			$nilaiTIU3 = $nilaiTIU3 . $coma . $r->nilaiTIU003;
			$nilaiTIU4 = $nilaiTIU4 . $coma . $r->nilaiTIU004;
			$nilaiTIU5 = $nilaiTIU5 . $coma . $r->nilaiTIU005;
			$nilaiTIU6 = $nilaiTIU6 . $coma . $r->nilaiTIU006;
			$nilaiTIU7 = $nilaiTIU7 . $coma . $r->nilaiTIU007;
			$nilaiTIU8 = $nilaiTIU8 . $coma . $r->nilaiTIU008;
			$nilaiTKP1 = $nilaiTKP1 . $coma . $r->nilaiTKP001;
			$nilaiTKP2 = $nilaiTKP2 . $coma . $r->nilaiTKP002;
			$nilaiTKP3 = $nilaiTKP3 . $coma . $r->nilaiTKP003;
			$nilaiTKP4 = $nilaiTKP4 . $coma . $r->nilaiTKP004;
			$nilaiTKP5 = $nilaiTKP5 . $coma . $r->nilaiTKP005;
			$nilaiTKP6 = $nilaiTKP6 . $coma . $r->nilaiTKP006;
			$nilaiTKP7 = $nilaiTKP7 . $coma . $r->nilaiTKP007;
			$nilaiTKP8 = $nilaiTKP8 . $coma . $r->nilaiTKP008;
			$nilaiTKP9 = $nilaiTKP9 . $coma . $r->nilaiTKP009;
			$nilaiTKP10 = $nilaiTKP10 . $coma . $r->nilaiTKP010;
			$nilaiTKP11 = $nilaiTKP11 . $coma . $r->nilaiTKP011;
			$nilaiTKP12 = $nilaiTKP12 . $coma . $r->nilaiTKP012;
			$nilaiTKP13 = $nilaiTKP13 . $coma . $r->nilaiTKP013;
			$coma = ',';
		}
		$data['ujianKe'] = $ujianKe;
		$data['nilaiTWK1'] = $nilaiTWK1;
		$data['nilaiTWK2'] = $nilaiTWK2;
		$data['nilaiTWK3'] = $nilaiTWK3;
		$data['nilaiTWK4'] = $nilaiTWK4;
		$data['nilaiTWK5'] = $nilaiTWK5;
		$data['nilaiTWK6'] = $nilaiTWK6;
		$data['nilaiTWK7'] = $nilaiTWK7;
		$data['nilaiTWK8'] = $nilaiTWK8;
		$data['nilaiTIU1'] = $nilaiTIU1;
		$data['nilaiTIU2'] = $nilaiTIU2;
		$data['nilaiTIU3'] = $nilaiTIU3;
		$data['nilaiTIU4'] = $nilaiTIU4;
		$data['nilaiTIU5'] = $nilaiTIU5;
		$data['nilaiTIU6'] = $nilaiTIU6;
		$data['nilaiTIU7'] = $nilaiTIU7;
		$data['nilaiTIU8'] = $nilaiTIU8;
		$data['nilaiTKP1'] = $nilaiTKP1;
		$data['nilaiTKP2'] = $nilaiTKP2;
		$data['nilaiTKP3'] = $nilaiTKP3;
		$data['nilaiTKP4'] = $nilaiTKP4;
		$data['nilaiTKP5'] = $nilaiTKP5;
		$data['nilaiTKP6'] = $nilaiTKP6;
		$data['nilaiTKP7'] = $nilaiTKP7;
		$data['nilaiTKP8'] = $nilaiTKP8;
		$data['nilaiTKP9'] = $nilaiTKP9;
		$data['nilaiTKP10'] = $nilaiTKP10;
		$data['nilaiTKP11'] = $nilaiTKP11;
		$data['nilaiTKP12'] = $nilaiTKP12;
		$data['nilaiTKP13'] = $nilaiTKP13;
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	function twk()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Statistik TWK - CPNS";
        $data['menu'] = "statistik";
        $data['subMenu'] = "twk";
		
		$sql = "SELECT cus.user_nama as namaUser, cu.ujian_nama as namaUjian,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK001' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK001,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK002' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK002,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK003' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK003,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK004' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK004,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK005' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK005,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK006' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK006,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK007' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK007,
					SUM(CASE WHEN cks.kategori_soal_key = 'TWK008' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTWK008
					FROM cpns_tes_parent ctp 
					JOIN cpns_user cus ON(ctp.tes_parent_user_id = cus.user_id)
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					JOIN cpns_tes_detail ctd ON(ctp.tes_parent_id = ctd.tes_detail_tes_id) 
					JOIN cpns_soal cs ON(ctd.tes_detail_soal_id = cs.soal_id) 
					JOIN cpns_kategori_soal cks ON(cs.soal_kategori_id = cks.kategori_soal_id) 
where cus.user_id = '" . $this->session->userdata('user_id') . "' 
					group by ctp.tes_parent_ujian_id					
					ORDER BY ctp.tes_parent_waktu ASC";
		$nilaiTWK1 = '';
		$nilaiTWK2 = '';
		$nilaiTWK3 = '';
		$nilaiTWK4 = '';
		$nilaiTWK5 = '';
		$nilaiTWK6 = '';
		$nilaiTWK7 = '';
		$nilaiTWK8 = '';
		$ujianKe = '';
		$coma = '';
		$i = 0;
		$dataStatistik = $this->db->query($sql)->result();
		foreach ($dataStatistik as $r)
		{
			$i += 1;
			$ujianKe = $ujianKe . $coma . '"Ujian '.$i.'"';
			$nilaiTWK1 = $nilaiTWK1 . $coma . $r->nilaiTWK001;
			$nilaiTWK2 = $nilaiTWK2 . $coma . $r->nilaiTWK002;
			$nilaiTWK3 = $nilaiTWK3 . $coma . $r->nilaiTWK003;
			$nilaiTWK4 = $nilaiTWK4 . $coma . $r->nilaiTWK004;
			$nilaiTWK5 = $nilaiTWK5 . $coma . $r->nilaiTWK005;
			$nilaiTWK6 = $nilaiTWK6 . $coma . $r->nilaiTWK006;
			$nilaiTWK7 = $nilaiTWK7 . $coma . $r->nilaiTWK007;
			$nilaiTWK8 = $nilaiTWK8 . $coma . $r->nilaiTWK008;
			$coma = ',';
		}
		$data['ujianKe'] = $ujianKe;
		$data['nilaiTWK1'] = $nilaiTWK1;
		$data['nilaiTWK2'] = $nilaiTWK2;
		$data['nilaiTWK3'] = $nilaiTWK3;
		$data['nilaiTWK4'] = $nilaiTWK4;
		$data['nilaiTWK5'] = $nilaiTWK5;
		$data['nilaiTWK6'] = $nilaiTWK6;
		$data['nilaiTWK7'] = $nilaiTWK7;
		$data['nilaiTWK8'] = $nilaiTWK8;
		$this->template->load('backend/template', $this->folder.'/twk',$data);
    }
    
    function tiu()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Statistik TIU - CPNS";
        $data['menu'] = "statistik";
        $data['subMenu'] = "tiu";
		
		$sql = "SELECT cus.user_nama as namaUser, cu.ujian_nama as namaUjian,

					SUM(CASE WHEN cks.kategori_soal_key = 'TIU001' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU001,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU002' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU002,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU003' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU003,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU004' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU004,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU005' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU005,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU006' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU006,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU007' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU007,
					SUM(CASE WHEN cks.kategori_soal_key = 'TIU008' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU008
					FROM cpns_tes_parent ctp 
					JOIN cpns_user cus ON(ctp.tes_parent_user_id = cus.user_id)
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					JOIN cpns_tes_detail ctd ON(ctp.tes_parent_id = ctd.tes_detail_tes_id) 
					JOIN cpns_soal cs ON(ctd.tes_detail_soal_id = cs.soal_id) 
					JOIN cpns_kategori_soal cks ON(cs.soal_kategori_id = cks.kategori_soal_id)
where cus.user_id = '" . $this->session->userdata('user_id') . "' 
					group by ctp.tes_parent_ujian_id				
					ORDER BY ctp.tes_parent_waktu ASC";
		$nilaiTWK1 = '';
		$nilaiTWK2 = '';
		$nilaiTWK3 = '';
		$nilaiTWK4 = '';
		$nilaiTWK5 = '';
		$nilaiTWK6 = '';
		$nilaiTWK7 = '';
		$nilaiTWK8 = '';
		$nilaiTIU1 = '';
		$nilaiTIU2 = '';
		$nilaiTIU3 = '';
		$nilaiTIU4 = '';
		$nilaiTIU5 = '';
		$nilaiTIU6 = '';
		$nilaiTIU7 = '';
		$nilaiTIU8 = '';
		$ujianKe = '';
		$coma = '';
		$i = 0;
		$dataStatistik = $this->db->query($sql)->result();
		foreach ($dataStatistik as $r)
		{
			$i += 1;
			$ujianKe = $ujianKe . $coma . '"Ujian '.$i.'"';
			$nilaiTIU1 = $nilaiTIU1 . $coma . $r->nilaiTIU001;
			$nilaiTIU2 = $nilaiTIU2 . $coma . $r->nilaiTIU002;
			$nilaiTIU3 = $nilaiTIU3 . $coma . $r->nilaiTIU003;
			$nilaiTIU4 = $nilaiTIU4 . $coma . $r->nilaiTIU004;
			$nilaiTIU5 = $nilaiTIU5 . $coma . $r->nilaiTIU005;
			$nilaiTIU6 = $nilaiTIU6 . $coma . $r->nilaiTIU006;
			$nilaiTIU7 = $nilaiTIU7 . $coma . $r->nilaiTIU007;
			$nilaiTIU8 = $nilaiTIU8 . $coma . $r->nilaiTIU008;
			$coma = ',';
		}
		$data['ujianKe'] = $ujianKe;
		$data['nilaiTIU1'] = $nilaiTIU1;
		$data['nilaiTIU2'] = $nilaiTIU2;
		$data['nilaiTIU3'] = $nilaiTIU3;
		$data['nilaiTIU4'] = $nilaiTIU4;
		$data['nilaiTIU5'] = $nilaiTIU5;
		$data['nilaiTIU6'] = $nilaiTIU6;
		$data['nilaiTIU7'] = $nilaiTIU7;
		$data['nilaiTIU8'] = $nilaiTIU8;
		$this->template->load('backend/template', $this->folder.'/tiu',$data);
    }
	
	function tkp()
    {
        $data['title'] = $this->title;
        $data['titleInputan'] = $this->titleInputan;
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Data Statistik - CPNS";
        $data['menu'] = "statistik";
        $data['subMenu'] = "tkp";
		
		$sql = "SELECT cus.user_nama as namaUser, cu.ujian_nama as namaUjian,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP001' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP001,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP002' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP002,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP003' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP003,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP004' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP004,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP005' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP005,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP006' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP006,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP007' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP007,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP008' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP008,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP009' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP009,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP010' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP010,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP011' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP011,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP012' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP012,
					SUM(CASE WHEN cks.kategori_soal_key = 'TKP013' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP013
					FROM cpns_tes_parent ctp 
					JOIN cpns_user cus ON(ctp.tes_parent_user_id = cus.user_id)
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					JOIN cpns_tes_detail ctd ON(ctp.tes_parent_id = ctd.tes_detail_tes_id) 
					JOIN cpns_soal cs ON(ctd.tes_detail_soal_id = cs.soal_id) 
					JOIN cpns_kategori_soal cks ON(cs.soal_kategori_id = cks.kategori_soal_id)
where cus.user_id = '" . $this->session->userdata('user_id') . "' 
					group by ctp.tes_parent_ujian_id				
					ORDER BY ctp.tes_parent_waktu ASC";
		$nilaiTKP1 = '';
		$nilaiTKP2 = '';
		$nilaiTKP3 = '';
		$nilaiTKP4 = '';
		$nilaiTKP5 = '';
		$nilaiTKP6 = '';
		$nilaiTKP7 = '';
		$nilaiTKP8 = '';
		$nilaiTKP9 = '';
		$nilaiTKP10 = '';
		$nilaiTKP11 = '';
		$nilaiTKP12 = '';
		$nilaiTKP13 = '';
		$ujianKe = '';
		$coma = '';
		$i = 0;
		$dataStatistik = $this->db->query($sql)->result();
		foreach ($dataStatistik as $r)
		{
			$i += 1;
			$ujianKe = $ujianKe . $coma . '"Ujian '.$i.'"';
			$nilaiTKP1 = $nilaiTKP1 . $coma . $r->nilaiTKP001;
			$nilaiTKP2 = $nilaiTKP2 . $coma . $r->nilaiTKP002;
			$nilaiTKP3 = $nilaiTKP3 . $coma . $r->nilaiTKP003;
			$nilaiTKP4 = $nilaiTKP4 . $coma . $r->nilaiTKP004;
			$nilaiTKP5 = $nilaiTKP5 . $coma . $r->nilaiTKP005;
			$nilaiTKP6 = $nilaiTKP6 . $coma . $r->nilaiTKP006;
			$nilaiTKP7 = $nilaiTKP7 . $coma . $r->nilaiTKP007;
			$nilaiTKP8 = $nilaiTKP8 . $coma . $r->nilaiTKP008;
			$nilaiTKP9 = $nilaiTKP9 . $coma . $r->nilaiTKP009;
			$nilaiTKP10 = $nilaiTKP10 . $coma . $r->nilaiTKP010;
			$nilaiTKP11 = $nilaiTKP11 . $coma . $r->nilaiTKP011;
			$nilaiTKP12 = $nilaiTKP12 . $coma . $r->nilaiTKP012;
			$nilaiTKP13 = $nilaiTKP13 . $coma . $r->nilaiTKP013;
			$coma = ',';
		}
		$data['ujianKe'] = $ujianKe;
		$data['nilaiTKP1'] = $nilaiTKP1;
		$data['nilaiTKP2'] = $nilaiTKP2;
		$data['nilaiTKP3'] = $nilaiTKP3;
		$data['nilaiTKP4'] = $nilaiTKP4;
		$data['nilaiTKP5'] = $nilaiTKP5;
		$data['nilaiTKP6'] = $nilaiTKP6;
		$data['nilaiTKP7'] = $nilaiTKP7;
		$data['nilaiTKP8'] = $nilaiTKP8;
		$data['nilaiTKP9'] = $nilaiTKP9;
		$data['nilaiTKP10'] = $nilaiTKP10;
		$data['nilaiTKP11'] = $nilaiTKP11;
		$data['nilaiTKP12'] = $nilaiTKP12;
		$data['nilaiTKP13'] = $nilaiTKP13;
		$this->template->load('backend/template', $this->folder.'/tkp',$data);
    }
}