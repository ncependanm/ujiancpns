<?php
class beranda extends CI_Controller{
    
    var $folder =   "backend/beranda";
    
    function __construct() {
        parent::__construct();
		$this->load->model('ujian_model','ujianModel');
    }
    
    function index()
    {
        $data['judulHalaman'] = "Beranda - SIAKAD ONLINE";
        $data['menu'] = "beranda";
        $data['subMenu'] = "";
		
		$this->db->from('cpns_user');
		$this->db->where('user_akses', 'G');
		$data['jmlGuru'] = $this->db->count_all_results();
		
		$this->db->from('cpns_user');
		$this->db->where('user_akses', 'S');
		$data['jmlSiswa'] = $this->db->count_all_results();

		$this->db->from('cpns_paket_parent');
		$data['jmlPaket'] = $this->db->count_all_results();

		$this->db->from('cpns_soal');
		$data['jmlSoal'] = $this->db->count_all_results();
		
		$sql    =   "SELECT * FROM cpns_ujian 
						WHERE ujian_tgl_mulai <= '".  gmdate("Y-m-d", time()+60*60*7) ."' 
						AND ujian_tgl_akhir >= '".  gmdate("Y-m-d", time()+60*60*7) ."'";
		$data['jmlUjianBerlangsung'] = $this->db->query($sql)->num_rows();

		$sql    =   "SELECT * FROM cpns_ujian 
						WHERE ujian_tgl_mulai > '".  gmdate("Y-m-d", time()+60*60*7) ."'";
		$data['jmlUjianAkanDatang'] = $this->db->query($sql)->num_rows();
		
		if($this->session->userdata('user_akses')=='S') {
			$sql    =   "SELECT ctp.tes_parent_id FROM cpns_tes_parent ctp 
							JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id)
							WHERE cu.ujian_ind = 'UF' and ctp.tes_parent_user_id = '". $this->session->userdata('user_id') ."'";
			$data['jmlFreePaketSelesai'] = $this->db->query($sql)->num_rows();
			$sql    =   "SELECT ctp.tes_parent_id FROM cpns_tes_parent ctp 
							JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id)
							WHERE cu.ujian_ind = 'UP' and ctp.tes_parent_user_id = '". $this->session->userdata('user_id') ."'";
			$data['jmlPremiumPaketSelesai'] = $this->db->query($sql)->num_rows();
			$sql    =   "SELECT ujian_id FROM cpns_ujian 
							WHERE ujian_ind = 'UF'";
			$data['jmlFreePaket'] = $this->db->query($sql)->num_rows();
			$sql    =   "SELECT ujian_id FROM cpns_ujian 
							WHERE ujian_ind = 'UP'";
			$data['jmlPremiumPaket'] = $this->db->query($sql)->num_rows();
		
			$sql = "SELECT cus.user_nama as namaUser, cu.ujian_nama as namaUjian, SUM(CASE WHEN cs.soal_type = 'TWK' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKW, 
					SUM(CASE WHEN cs.soal_type = 'TIU' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU,
					SUM(CASE WHEN cs.soal_type = 'TKP' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP , cu.ujian_tgl_mulai
					FROM cpns_tes_parent ctp 
					JOIN cpns_user cus ON(ctp.tes_parent_user_id = cus.user_id)
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					JOIN cpns_tes_detail ctd ON(ctp.tes_parent_id = ctd.tes_detail_tes_id) 
					JOIN cpns_soal cs ON(ctd.tes_detail_soal_id = cs.soal_id) 
					WHERE cu.ujian_tgl_mulai <= '".  gmdate("Y-m-d", time()+60*60*7) ."' 
					AND cu.ujian_tgl_akhir >= '".  gmdate("Y-m-d", time()+60*60*7) ."'
					AND cu.ujian_ind = 'UP'
					GROUP BY ctp.tes_parent_user_id	
					HAVING SUM(CASE WHEN cs.soal_type = 'TWK' THEN ctd.tes_detail_nilai ELSE 0 END) >= 70 and 
					SUM(CASE WHEN cs.soal_type = 'TIU' THEN ctd.tes_detail_nilai ELSE 0 END) >= 75 and 
					SUM(CASE WHEN cs.soal_type = 'TKP' THEN ctd.tes_detail_nilai ELSE 0 END) >= 126				
					ORDER BY ctp.tes_parent_waktu ASC";
			$data['dataLulus'] = $this->db->query($sql)->result();
		
			$sql = "SELECT cus.user_nama as namaUser, cu.ujian_nama as namaUjian, SUM(CASE WHEN cs.soal_type = 'TWK' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKW, 
					SUM(CASE WHEN cs.soal_type = 'TIU' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU,
					SUM(CASE WHEN cs.soal_type = 'TKP' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP , cu.ujian_tgl_mulai
					FROM cpns_tes_parent ctp 
					JOIN cpns_user cus ON(ctp.tes_parent_user_id = cus.user_id)
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					JOIN cpns_tes_detail ctd ON(ctp.tes_parent_id = ctd.tes_detail_tes_id) 
					JOIN cpns_soal cs ON(ctd.tes_detail_soal_id = cs.soal_id) 
					WHERE cu.ujian_tgl_mulai <= '".  gmdate("Y-m-d", time()+60*60*7) ."' 
					AND cu.ujian_tgl_akhir >= '".  gmdate("Y-m-d", time()+60*60*7) ."'
					AND cu.ujian_ind = 'UP'
					GROUP BY ctp.tes_parent_user_id	
					HAVING SUM(CASE WHEN cs.soal_type = 'TWK' THEN ctd.tes_detail_nilai ELSE 0 END) < 70 or
					SUM(CASE WHEN cs.soal_type = 'TIU' THEN ctd.tes_detail_nilai ELSE 0 END) < 75 or 
					SUM(CASE WHEN cs.soal_type = 'TKP' THEN ctd.tes_detail_nilai ELSE 0 END) < 126				
					ORDER BY ctp.tes_parent_waktu ASC";
			$data['dataGagal'] = $this->db->query($sql)->result();
		}
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTableJadwalUjian()
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
			$row[] = $ujian->ujian_tgl_mulai;
			$row[] = $ujian->ujian_tgl_akhir;
			$today=gmdate("Y-m-d", time()+60*60*7);
			$ind = '';
			$tgl_mulai = strtotime($ujian->ujian_tgl_mulai); 
			$tgl_akhir = strtotime($ujian->ujian_tgl_akhir); 
			$tgl_today = strtotime($today); 
			if ($tgl_today < $tgl_mulai){
				$ind = '<span class="label label-sm label-info circle">Akan Datang</span>';
			} else if ($tgl_today >= $tgl_mulai){
				if ($tgl_today <= $tgl_akhir){
					$ind = '<span class="label label-sm label-warning circle">Sedang Berlangsung</span>';
				} else if ($tgl_today > $tgl_akhir){
					$ind = '<span class="label label-sm label-danger circle">Sudah Selesai</span>';
				}
			}


			//add html for action
			$row[] = $ind;
			$row[] = '<a href="beranda/lihatHasil/'. $ujian->ujian_id .'" class="btn btn-info">Lihat Hasil</a>';
		
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
	
	public function lihatHasil($idUjian){
        $data['judulHalaman'] = "Beranda - SIAKAD ONLINE";
        $data['menu'] = "beranda";
        $data['subMenu'] = "";
		$sql = "SELECT cus.user_nama as namaUser, cus.user_email as emailUser, cus.user_asal_sekolah as asalSekolah,
					cu.ujian_nama as namaUjian, SUM(CASE WHEN cs.soal_type = 'TWK' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKW, 
					SUM(CASE WHEN cs.soal_type = 'TIU' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU,
					SUM(CASE WHEN cs.soal_type = 'TKP' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP , cu.ujian_tgl_mulai,
					SUM(ctd.tes_detail_nilai) AS nilaiTotal
					FROM cpns_tes_parent ctp 
					JOIN cpns_user cus ON(ctp.tes_parent_user_id = cus.user_id)
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					JOIN cpns_tes_detail ctd ON(ctp.tes_parent_id = ctd.tes_detail_tes_id) 
					JOIN cpns_soal cs ON(ctd.tes_detail_soal_id = cs.soal_id) 
					WHERE cu.ujian_id = '" . $idUjian . "'
					GROUP BY ctp.tes_parent_user_id	
					HAVING SUM(CASE WHEN cs.soal_type = 'TWK' THEN ctd.tes_detail_nilai ELSE 0 END) >= 70 and 
					SUM(CASE WHEN cs.soal_type = 'TIU' THEN ctd.tes_detail_nilai ELSE 0 END) >= 75 and 
					SUM(CASE WHEN cs.soal_type = 'TKP' THEN ctd.tes_detail_nilai ELSE 0 END) >= 126				
					ORDER BY sum(ctd.tes_detail_nilai) DESC";
		$data['dataLulus'] = $this->db->query($sql)->result();
		
		$sql = "SELECT cus.user_nama as namaUser, cus.user_email as emailUser, cus.user_asal_sekolah as asalSekolah,
					cu.ujian_nama as namaUjian, SUM(CASE WHEN cs.soal_type = 'TWK' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKW, 
					SUM(CASE WHEN cs.soal_type = 'TIU' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTIU,
					SUM(CASE WHEN cs.soal_type = 'TKP' THEN ctd.tes_detail_nilai ELSE 0 END) AS nilaiTKP , cu.ujian_tgl_mulai,
					SUM(ctd.tes_detail_nilai) AS nilaiTotal
					FROM cpns_tes_parent ctp 
					JOIN cpns_user cus ON(ctp.tes_parent_user_id = cus.user_id)
					JOIN cpns_ujian cu ON(ctp.tes_parent_ujian_id = cu.ujian_id) 
					JOIN cpns_tes_detail ctd ON(ctp.tes_parent_id = ctd.tes_detail_tes_id) 
					JOIN cpns_soal cs ON(ctd.tes_detail_soal_id = cs.soal_id) 
					WHERE cu.ujian_id = '". $idUjian ."'
					GROUP BY ctp.tes_parent_user_id	
					HAVING SUM(CASE WHEN cs.soal_type = 'TWK' THEN ctd.tes_detail_nilai ELSE 0 END) < 70 or
					SUM(CASE WHEN cs.soal_type = 'TIU' THEN ctd.tes_detail_nilai ELSE 0 END) < 75 or 
					SUM(CASE WHEN cs.soal_type = 'TKP' THEN ctd.tes_detail_nilai ELSE 0 END) < 126				
					ORDER BY sum(ctd.tes_detail_nilai) DESC";
		$data['dataGagal'] = $this->db->query($sql)->result();

		$this->template->load('backend/template', $this->folder.'/hasil',$data);
	}
	
}