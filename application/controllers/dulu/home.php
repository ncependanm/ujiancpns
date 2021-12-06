<?php
class home extends CI_Controller
{	
    function __construct() 
	{
        parent::__construct();
    }
    
    function index()
    {
        $data['title'] = 'Home';
        $data['menu'] = 'home';
        $data['judulForm'] = 'Form Pendaftaran';
		$data['heading'] = 'Halaman tidak ditemukan';
		$data['keterangan'] = 'Kami tidak menemukan halaman yang anda minta';
		
		$this->template->load('tema', 'home', $data);
    }
}