<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Instansi extends CI_Controller
  {
    function __construct()
    {
      parent::__construct();
      login_access();
    //  hak_akses();
      $this->load->model('Instansi_model');
      $this->load->library('form_validation');   
      $this->load->library('datatables');
    }

    public function index()
    {

      $row = $this->db->get('instansi')->row();
      $data = array(
        'judul'=>'Data Instansi / Perusahaan.',
        'button' => 'Update',
        'action' => site_url('instansi/edit_data'),
       // 'id_instansi' => set_value('id_instansi', $row->id_instansi),
        'keterangan_situs'=>set_value('keterangan_situs',$row->keterangan_situs),
        'nama_instansi' => set_value('nama_instansi', $row->nama_instansi),
        'alamat_lengkap' => set_value('alamat_lengkap', $row->alamat_lengkap),
        'telp' => set_value('telp', $row->telp),
        'fax' => set_value('fax', $row->fax),
        'npwp' => set_value('npwp', $row->npwp),
        'logo' => set_value('logo', $row->logo),
        'favicon' => set_value('favicon', $row->favicon),
      );
      $this->template->load('template','instansi/instansi_form', $data);
    } 

    public function json() {
      header('Content-Type: application/json');
      echo $this->Instansi_model->json();
    }
    
    public function edit_data() 
    { 

      if ($_FILES['logo']['name'] == '' AND $_FILES['favicon']['name'] == '') {

       $data = array(           
        'nama_instansi' => $this->input->post('nama_instansi',TRUE),
        'keterangan_situs'=>$this->input->post('keterangan_situs',TRUE),
        'alamat_lengkap' => $this->input->post('alamat_lengkap',TRUE),
        'telp' => $this->input->post('telp',TRUE),
        'fax' => $this->input->post('fax',TRUE),
        'npwp' => $this->input->post('npwp',TRUE),
      ); 
       $this->db->update('instansi', $data);
       $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
       redirect(site_url('instansi'));


     }else{  


       $conf['allowed_types'] = 'jpg|png|ico|bmp';
       $conf['upload_path'] = 'assets/img/';
       $conf['file_name']   = time().'logo';

       $this->upload->initialize($conf);

       $error = array();
       $gambar = array();
       foreach($_FILES as $field_name => $file){
        if ( ! $this->upload->do_upload($field_name)){
          $error[] = $this->upload->display_errors();
        }else{
          $gambar0 = $this->upload->data();
          $gambar[] = $gambar0['file_name'];
        }

      }

      $nilai1=$gambar[0] ? $gambar[0] : '';
      $nilai2=$gambar[1] ? $gambar[1] : '';
      $row = $this->db->get('instansi')->row(); 

      if ($nilai1 !='') {

        unlink('assets/img/'.$row->logo);

      }elseif ($nilai2 !='') {
                 # code...
        unlink('assets/img/'.$row->favicon);

      }elseif($nilai1 !='' AND $nilai2 !=''){
        unlink('assets/img/'.$row->logo);
        unlink('assets/img/'.$row->favicon);  
      }else{

      }

      if ($nilai1 !='' ) {
        $hasil_gambar1= array('logo'=>$nilai1);   
      }else{
        $hasil_gambar1= array();
      } 
      if($nilai1 !='' ) {
        $hasil_gambar2= array('favicon'=>$nilai2);   
      }else{
        $hasil_gambar2= array();
      } 

      $data = array(           
        'nama_instansi' => $this->input->post('nama_instansi',TRUE),
        'alamat_lengkap' => strip_tags($this->input->post('alamat_lengkap',TRUE)),
        'telp' => strip_tags($this->input->post('telp',TRUE)),
        'keterangan_situs'=>strip_tags($this->input->post('keterangan_situs',TRUE)),
        'fax' => $this->input->post('fax',TRUE),
        'npwp' => $this->input->post('npwp',TRUE),  
      );

      $update_data  = array_merge($data,$hasil_gambar1,$hasil_gambar2); 
      $this->db->update('instansi', $update_data);
      $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
      redirect(site_url('instansi')); 
      /*favicon*/  
    }

  }

  public function hapus($id) 
  {
    $row = $this->Instansi_model->get_by_id($id);

    if ($row) {
      $this->Instansi_model->delete($id);
      $this->session->set_flashdata('message', '<div class="alert alert-danger fade-in"><i class="fa fa-check"></i>Data Berhasil Di Hapus</div>');
      redirect(site_url('instansi'));
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Ops Something Went Wrong Please Contact Administrator.</div>');
      redirect(site_url('instansi'));
    }
  }

  public function _rules() 
  {

   $this->form_validation->set_rules('nama_instansi', 'nama instansi', 'trim|required');
   $this->form_validation->set_rules('alamat_lengkap', 'alamat lengkap', 'trim|required');
   $this->form_validation->set_rules('telp', 'telp', 'trim|required');
   $this->form_validation->set_rules('fax', 'fax', 'trim|required');
   $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
   $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }


}

