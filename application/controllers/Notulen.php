<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Notulen extends CI_Controller
  {
    function __construct()
    {
      parent::__construct();
      login_access();
      hak_akses();
      $this->load->model('Notulen_model');
      $this->load->library('form_validation');   
      $this->load->library('datatables');

    }

    public function index()
    {
     $x['judul'] = 'Data : Notulen';
     $this->template->load('template','notulen/notulen_list',$x);
   } 

   public function json() {
    header('Content-Type: application/json');
    echo $this->Notulen_model->json();
  }

  public function detail($id) 
  {
     $x = array(
      'catatan'=>FALSE,
      'data' => $this->Notulen_model->get_detail($id)->row_array(), 
      'logo'=>$this->db->get('instansi')->row_array(),
      'judul'=>'Detail :  NOTULEN',
    );
    $this->template->load('template','notulen/notulen_read', $x);  
  }

  /**/

  function excel_not_detail($id,$param=''){
   if($param == 'print'){  
    // header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    // header("Content-Disposition: attachment; filename=detail_notulen.xls");  //File name extension was wrong
    // header("Expires: 0");
    // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    // header("Cache-Control: private",false);
    $param = '';
    echo "<script>window.print()</script>";
    }elseif($param == 'word'){
    header("Content-Type:   application/vnd.ms-word; charset=utf-8");
    header("Content-Disposition: attachment; filename=detail_notulen.doc");  //File name extension was wrong
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    $param = 'no_image';
  }else{
    echo "Not action selected";
  }
    $x = array( 
      'param'=>$param,
      'catatan'=>TRUE,
      'data' => $this->Notulen_model->get_detail($id)->row_array(), 
      'logo'=>$this->db->get('instansi')->row_array(),
      'judul'=>'Detail :  NOTULEN',
    );
    $this->load->view('notulen/notulen_excel', $x); 
  }

  public function tambah() 
  {
    $data = array(
      'judul'=>'Tambah Notulen',
      'button' => 'Create',
      'action' => site_url('notulen/tambah_data'),
      'id_notulen' => set_value('id_notulen'),
      'agenda' => set_value('agenda'),
      'id_create' => set_value('id_create'),
      'start_time' => set_value('start_time'),
      'end_time' => set_value('end_time'),
      'place' => set_value('place'),
      'participan' => set_value('participan'),
      'date_create' => set_value('date_create'),
      'absensi' => set_value('absensi'),
      'no_dokumen' => set_value('no_dokumen'),
      'no_revisi' => set_value('no_revisi'),
      'notulis' => set_value('notulis'),
      'tdd_pimpinan'=>set_value('tdd_pimpinan'),
      'pimpinan_rapat' => set_value('pimpinan_rapat'),
      'jenis_rapat' => set_value('jenis_rapat'),
      'no_agenda' => set_value('no_agenda'),
    );
    $this->template->load('template','notulen/notulen_form', $data);
  }

  public function tambah_data() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
    $this->tambah();
    //  echo validation_errors('');
    } else {
      $_conf['file_name'] = 'absensi_'.time();
      $_conf['upload_path'] = 'assets/absensi/';
      $_conf['allowed_types']= 'pdf|docx|png|svg';
      $this->upload->initialize($_conf);
      $hasil_file =array();
      $error =array();
      foreach($_FILES as $ds => $val){
       if($this->upload->do_upload($ds)){ 
        $parjo = $this->upload->data();
        $hasil_file[] = $parjo['file_name'];
      }else{
          $error[] = $this->upload->display_errors();

       }   
      }  
      
      if($error[0]){
        $this->session->set_flashdata('message', $this->upload->display_errors('<div class="alert alert-success fade-in"><i class="fa fa-check"></i>','</div>'));
        redirect(site_url('notulen/tambah/'));
      }elseif($error[1]){
        $this->session->set_flashdata('message', $this->upload->display_errors('<div class="alert alert-success fade-in"><i class="fa fa-check"></i>','</div>'));
        redirect(site_url('notulen/tambah/'));
      }else{ 

      $data = array(
        'agenda' => $this->input->post('agenda',TRUE),
        'id_create' => $this->session->id_user,
        'start_time' => $this->input->post('start_time',TRUE),
        'end_time' => $this->input->post('end_time',TRUE),
        'place' => $this->input->post('place',TRUE),
        'participan' => $this->input->post('participan',TRUE),
        'date_create' => date('Y-m-d'),
        'absensi' => $hasil_file[0],
        'tdd_pimpinan' => $hasil_file[1],
        'no_dokumen' => $this->input->post('no_dokumen',TRUE),
        'no_revisi' => $this->input->post('no_revisi',TRUE),
        'notulis' => $this->input->post('notulis',TRUE),
        'pimpinan_rapat' => $this->input->post('pimpinan_rapat',TRUE),
        'jenis_rapat' => $this->input->post('jenis_rapat',TRUE),
        'no_agenda' => $this->input->post('no_agenda',TRUE),
      ); 

      
      $this->Notulen_model->insert($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Data Berhasil Di Tambahkan.</div>');
      redirect(site_url('notulen'));
      } 
  }

}

  public function edit($id) 
  {
    $row = $this->Notulen_model->get_by_id($id);

    if ($row) {
      $data = array(
        'judul'=>'Data NOTULEN',
        'button' => 'Update',
        'action' => site_url('notulen/edit_data'),
        'id_notulen' => set_value('id_notulen', $row->id_notulen),
        'agenda' => set_value('agenda', $row->agenda),
        'id_create' => set_value('id_create', $row->id_create),
        'start_time' => set_value('start_time', $row->start_time),
        'end_time' => set_value('end_time', $row->end_time),
        'place' => set_value('place', $row->place),
        'participan' => set_value('participan', $row->participan),
        'date_create' => set_value('date_create', $row->date_create),
        'absensi' => set_value('absensi', $row->absensi),
        'tdd_pimpinan' => set_value('tdd_pimpinan', $row->tdd_pimpinan),
        'no_dokumen' => set_value('no_dokumen', $row->no_dokumen),
        'no_revisi' => set_value('no_revisi', $row->no_revisi),
        'notulis' => set_value('notulis', $row->notulis),
        'pimpinan_rapat' => set_value('pimpinan_rapat', $row->pimpinan_rapat),
        'jenis_rapat' => set_value('jenis_rapat', $row->jenis_rapat),
        'no_agenda' => set_value('no_agenda', $row->no_agenda),
      );
      $this->template->load('template','notulen/notulen_form', $data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-info fade-in">Data Tidak Di Temukan.</div>');
      redirect(site_url('notulen'));
    }
  }

  public function edit_data() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->edit($this->input->post('id_notulen', TRUE));
    } else {
      $_conf['file_name'] = 'absensi_'.time();
      $_conf['upload_path'] = 'assets/absensi';
      $_conf['allowed_types']= 'pdf|docx|png|svg';

      $this->upload->initialize($_conf);
      if($this->upload->do_upload('absesnsi')){  
        $data = $this->db->get_where('notulen',array('id_notulen'=>$id))->row_array();
        if($data['absesnsi'] != ''){
        @unlink('assets/absensi/'.$data['absensi']);
        } 
       $data = array(
        'agenda' => $this->input->post('agenda',TRUE),
        'id_create' => $this->input->post('id_create',TRUE),
        'start_time' => $this->input->post('start_time',TRUE),
        'end_time' => $this->input->post('end_time',TRUE),
        'place' => $this->input->post('place',TRUE),
        'participan' => $this->input->post('participan',TRUE),
        'absensi' => $this->input->post('absensi',TRUE),
        'no_dokumen' => $this->input->post('no_dokumen',TRUE),
        'no_revisi' => $this->input->post('no_revisi',TRUE),
        'notulis' => $this->input->post('notulis',TRUE),
        'pimpinan_rapat' => $this->input->post('pimpinan_rapat',TRUE),
        'jenis_rapat' => $this->input->post('jenis_rapat',TRUE),
        'no_agenda' => $this->input->post('no_agenda',TRUE),
      );

      $this->Notulen_model->update($this->input->post('id_notulen', TRUE), $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
      redirect(site_url('notulen'));
  }else{
    $this->session->set_flashdata('message', $this->upload->display_errors('<div class="alert alert-success fade-in"><i class="fa fa-check"></i>','</div>'));
    redirect(site_url('notulen/edit_data/'.$this->input->post()));
    
  }
  }
}

  public function hapus($id) 
  {
    $row = $this->Notulen_model->get_by_id($id);
    if ($row) {
    if($row->absensi !=''){ 
      @unlink('assets/absesnsi/'.$row->absesnsi); 
      $this->Notulen_model->delete($id);
      $this->session->set_flashdata('message', '<div class="alert alert-danger fade-in"><i class="fa fa-check"></i>Data Berhasil Di Hapus</div>');
      redirect(site_url('notulen'));
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Ops Something Went Wrong Please Contact Administrator.</div>');
      redirect(site_url('notulen'));
    }
  }
  }

  public function _rules() 
  {
   $this->form_validation->set_rules('agenda', 'agenda', 'trim|required');
   $this->form_validation->set_rules('start_time', 'start time', 'trim|required');
   $this->form_validation->set_rules('end_time', 'end time', 'trim|required');
   $this->form_validation->set_rules('place', 'place', 'trim|required');
   $this->form_validation->set_rules('participan', 'participan', 'trim|required');
   
   $this->form_validation->set_rules('no_dokumen', 'no dokumen', 'trim|required');
   $this->form_validation->set_rules('no_revisi', 'no revisi', 'trim|required');
   $this->form_validation->set_rules('notulis', 'notulis', 'trim|required');
   $this->form_validation->set_rules('pimpinan_rapat', 'pimpinan rapat', 'trim|required');
   $this->form_validation->set_rules('jenis_rapat', 'jenis rapat', 'trim|required');
   $this->form_validation->set_rules('no_agenda', 'no agenda', 'trim|required');

   $this->form_validation->set_rules('id_notulen', 'id_notulen', 'trim');
   $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

 function get_notify(){
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jumlah =  $this->Notulen_model->get_notify();
    echo $jumlah->num_rows();  
  } 
}

}

