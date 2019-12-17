<?php 
 
 class Welcome extends CI_controller
 {
 	
 	function __construct()
 	{ 
 		parent::__construct();
 		login_access();
 		$this->load->model('Bahan_model');
     	$this->load->model('Dasboard_model');
  	}
 	function index(){
 
 		$x['judul'] = 'Halaman Administrasi Situs.';
 		$x['agenda_by_status'] = $this->Dasboard_model->grafik_by_agenda();
 		$this->template->load('template','dasboard',$x);
 	} 
 	function logout(){

 		$this->session->sess_destroy();
 		redirect(base_url('?stat=1')); 
 	}
 	 

 	function _404(){
 		$x['judul'] = '404 Halaman Tidak Di Temukan.';
 		$this->template->load('template','404',$x);   
 	}
 }