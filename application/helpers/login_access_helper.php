<?php 


function cari_data($param){
 $CI =& get_instance();
 $data =$CI->db->get_where('instansi')->result();
 return $data->$param;  
}

function keterangan($param){
  include APPPATH.'third_party/ket.php';
  return $setting[3];
} 

function logo(){

  $CI = & get_instance();
  $data = $CI->db->get('instansi')->row();
  return $data->logo;

}

function aman($str){
  return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
}


function login_access(){
  $CI =& get_instance();
  if ($CI->session->userdata('id_user') == '' OR $CI->session->userdata('login') != TRUE) {
   redirect(base_url('')); 
   exit();
 };   

}


function hak_akses(){
  $CI =& get_instance();
  $uri = $CI->uri->segment(1);
  $level = $CI->session->userdata('level');
  $cek=$CI->db->order_by('urutan')
  ->where('aktif','Ya')
  ->where('link',$uri) 
  ->where('position','Bottom') 
  ->where('locate("'.$level.'",level) > 0') 
  ->get('menu');

  $str = str_replace('.','', $level); 	
  if ($cek->num_rows() > 0) { 


  }else{
   $x['judul'] ='';
   $CI->template->load('template','404',$x);
   exit(); 
 }	 

}


function tgl_indonesia($tgl){
  $nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

  $tanggal = substr($tgl,8,2);
  $bulan = $nama_bulan[(int)substr($tgl,5,2)];
  $tahun = substr($tgl,0,4);
  
  return $tanggal.' '.$bulan.' '.$tahun;     
} 
