<?php
class error extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    function pageNotFound()
    {	
		$data['judul'] = '404';
		$data['heading'] = 'Halaman tidak ditemukan';
		$data['keterangan'] = 'Kami tidak menemukan halaman yang anda minta';
        $this->load->view('404',$data);
    }
}