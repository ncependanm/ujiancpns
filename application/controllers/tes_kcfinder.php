<?php
class Tes_Kcfinder extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
        session_start();
    }
 
    function index()
    {
        $this->load->view('ckeditor');
    }
}
