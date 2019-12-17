<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Divisi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        login_access();
        hak_akses();
        $this->load->model('Divisi_model');
        $this->load->library('form_validation');   
        $this->load->library('datatables');
    }

    public function index()
    {
     $x['judul'] = 'Data : Divisi';
     $this->template->load('template','divisi/divisi_list',$x);
 } 

 public function json() {
    header('Content-Type: application/json');
    echo $this->Divisi_model->json();
}

public function detail($id) 
{
    $row = $this->Divisi_model->get_by_id($id);
    if ($row) {
        $data = array(
          'id_divisi' => $row->id_divisi,
          'id_instansi' => $row->id_instansi,
          'nama_divsi' => $row->nama_divsi,

          'judul'=>'Detail :  DIVISI',
      );
        $this->template->load('template','divisi/divisi_read', $data);
    } else {
        $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Data Tidak Di Temukan.</div>');
        redirect(site_url('divisi'));
    }
}

public function tambah() 
{
    $data = array(
        'judul'=>'Tambah Divisi',
        'button' => 'Create',
        'action' => site_url('divisi/tambah_data'),
        'id_divisi' => set_value('id_divisi'),
        'id_instansi' => set_value('id_instansi'),
        'nama_divsi' => set_value('nama_divsi'),
    );
    $this->template->load('template','divisi/divisi_form', $data);
}

public function tambah_data() 
{
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
        $this->tambah();
    } else {
        $data = array(
            'id_instansi' => identitas('id_instansi'),
            'nama_divsi' => $this->input->post('nama_divsi',TRUE),
        );

        $this->Divisi_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Data Berhasil Di Tambahkan.</div>');
        redirect(site_url('divisi'));
    }
}

public function edit($id) 
{
    $row = $this->Divisi_model->get_by_id($id);

    if ($row) {
        $data = array(
            'judul'=>'Data DIVISI',
            'button' => 'Update',
            'action' => site_url('divisi/edit_data'),
            'id_divisi' => set_value('id_divisi', $row->id_divisi),
            'id_instansi' => set_value('id_instansi', $row->id_instansi),
            'nama_divsi' => set_value('nama_divsi', $row->nama_divsi),
        );
        $this->template->load('template','divisi/divisi_form', $data);
    } else {
        $this->session->set_flashdata('message', '<div class="alert alert-info fade-in">Data Tidak Di Temukan.</div>');
        redirect(site_url('divisi'));
    }
}

public function edit_data() 
{
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
        $this->edit($this->input->post('id_divisi', TRUE));
    } else {
        $data = array(
          'id_instansi' => identitas('id_instansi'),
          'nama_divsi' => $this->input->post('nama_divsi',TRUE),
      );

        $this->Divisi_model->update($this->input->post('id_divisi', TRUE), $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
        redirect(site_url('divisi'));
    }
}

public function hapus($id) 
{
    $row = $this->Divisi_model->get_by_id($id);

    if ($row) {
        $this->Divisi_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger fade-in"><i class="fa fa-check"></i>Data Berhasil Di Hapus</div>');
        redirect(site_url('divisi'));
    } else {
        $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Ops Something Went Wrong Please Contact Administrator.</div>');
        redirect(site_url('divisi'));
    }
}

public function _rules() 
{
	$this->form_validation->set_rules('id_instansi', 'id instansi', 'trim|required');
	$this->form_validation->set_rules('nama_divsi', 'nama divsi', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
}

}

