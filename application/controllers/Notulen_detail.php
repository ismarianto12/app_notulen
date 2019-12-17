<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Notulen_detail extends CI_Controller
  {
    function __construct()
    {
      parent::__construct();
      login_access();
      hak_akses();
      $this->load->model('Notulen_detail_model');
      $this->load->model('Notulen_model'); 
      $this->load->library('form_validation');   
      $this->load->library('datatables');
    }

    public function index()
    {
     $x['judul'] = 'Notulen detail';
     $x['data_notulen'] =$this->Notulen_detail_model->list_data();
     $this->template->load('template','notulen_detail/notulen_detail_list',$x);
   } 

   public function json() {
    header('Content-Type: application/json');
    echo $this->Notulen_detail_model->json();
  }

  public function detail($id) 
  {
    $row = $this->Notulen_detail_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id_not_detail' => $row->id_not_detail,
        'id_notulen' => $row->id_notulen,
        'issue' => $row->issue,
        'PIC' => $row->PIC,
        'due_dete' => $row->due_dete,
        'status' => $row->status,
        'remarks' => $row->remarks,      
        'division' => $row->division,      
        'judul'=>'DATA NOTULEN DETAIL',
      );
      $this->template->load('template','notulen_detail/notulen_detail_read', $data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Data Tidak Di Temukan.</div>');
      redirect(site_url('notulen_detail'));
    }
  }

  public function tambah() 
  {
    $data = array(
      'judul'=>'Tambah Notulen detail',
      'button' => 'Create',
      'action' => site_url('notulen_detail/tambah_data'),
      'id_not_detail' => set_value('id_not_detail'),
      'id_notulen' => set_value('id_notulen'),
      'issue' => set_value('issue'),
      'PIC' => set_value('PIC'),
      'due_dete' => set_value('due_dete'),
      'status' => set_value('status'),
      'remarks' => set_value('remarks'),
      'division' => set_value('division'),
      
    );
    $this->template->load('template','notulen_detail/notulen_detail_form', $data);
  }

  public function tambah_data() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->tambah();
    } else {
      $data = array(
        'id_notulen' => $this->input->post('id_notulen',TRUE),
        'issue' => $this->input->post('issue',TRUE),
        'PIC' => $this->input->post('PIC',TRUE),
        'due_dete' => $this->input->post('due_dete',TRUE),
        'status' => 'N',
        'remarks' => $this->input->post('remarks',TRUE),
        'division' => $this->input->post('division',TRUE),
        'date_created'=>date('Y-m-d'), 
      );

      $this->Notulen_detail_model->insert($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Data Berhasil Di Tambahkan.</div>');
      redirect(site_url('notulen_detail'));
    }
  }

  public function edit($id) 
  {
    $row = $this->Notulen_detail_model->get_by_id($id);

    if ($row) {
      $data = array(
        'judul'=>'Data NOTULEN_DETAIL',
        'button' => 'Update',
        'action' => site_url('notulen_detail/edit_data'),
        'id_not_detail' => set_value('id_not_detail', $row->id_not_detail),
        'id_notulen' => set_value('id_notulen', $row->id_notulen),
        'issue' => set_value('issue', $row->issue),
        'PIC' => set_value('PIC', $row->PIC),
        'due_dete' => set_value('due_dete', $row->due_dete),
        'status' => set_value('status', $row->status),
        'remarks' => set_value('remarks', $row->remarks),
      );
      $this->template->load('template','notulen_detail/notulen_detail_form', $data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-info fade-in">Data Tidak Di Temukan.</div>');
      redirect(site_url('notulen_detail'));
    }
  }

  public function edit_data() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->edit($this->input->post('id_not_detail', TRUE));
    } else {
      $data = array(
        'id_notulen' => $this->input->post('id_notulen',TRUE),
        'issue' => $this->input->post('issue',TRUE),
        'PIC' => $this->input->post('PIC',TRUE),
        'due_dete' => $this->input->post('due_dete',TRUE),
        'status' => 'N',
        'remarks' => $this->input->post('remarks',TRUE),
        'division' => $this->input->post('division',TRUE),
        'date_created'=>date('Y-m-d'),
      );

      $this->Notulen_detail_model->update($this->input->post('id_not_detail', TRUE), $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
      redirect(site_url('notulen_detail'));
    }
  }

  public function hapus() 
  {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {  
      $id = $this->input->post('id_not_detail');
      $row = $this->Notulen_detail_model->get_by_id($id);

      if ($row) {
        $this->Notulen_detail_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger fade-in"><i class="fa fa-check"></i>Data Berhasil Di Hapus</div>');
        redirect(site_url('notulen_detail'));
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Ops Something Went Wrong Please Contact Administrator.</div>');
        redirect(site_url('notulen_detail'));
      }
    }
  }

  public function _rules() 
  {
   $this->form_validation->set_rules('id_notulen', 'id notulen', 'trim|required');
   $this->form_validation->set_rules('issue', 'issue', 'trim|required');
   $this->form_validation->set_rules('PIC', 'pic', 'trim|required');
   $this->form_validation->set_rules('due_dete', 'due dete', 'trim|required');
   $this->form_validation->set_rules('remarks', 'remarks', 'trim|required');

   $this->form_validation->set_rules('id_not_detail', 'id_not_detail', 'trim');
   $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile = "notulen_detail.xls";
  $judul = "notulen_detail";
  $tablehead = 0;
  $tablebody = 1;
  $nourut = 1;
        //penulisan header
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment;filename=" . $namaFile . "");
  header("Content-Transfer-Encoding: binary ");

  xlsBOF();

  $kolomhead = 0;
  xlsWriteLabel($tablehead, $kolomhead++, "No");
  xlsWriteLabel($tablehead, $kolomhead++, "Id Notulen");
  xlsWriteLabel($tablehead, $kolomhead++, "Issue");
  xlsWriteLabel($tablehead, $kolomhead++, "PIC");
  xlsWriteLabel($tablehead, $kolomhead++, "Due Dete");
  xlsWriteLabel($tablehead, $kolomhead++, "Status");
  xlsWriteLabel($tablehead, $kolomhead++, "Remarks");

  foreach ($this->Notulen_detail_model->get_all() as $data) {
    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
    xlsWriteNumber($tablebody, $kolombody++, $nourut);
    xlsWriteNumber($tablebody, $kolombody++, $data->id_notulen);
    xlsWriteLabel($tablebody, $kolombody++, $data->issue);
    xlsWriteLabel($tablebody, $kolombody++, $data->PIC);
    xlsWriteLabel($tablebody, $kolombody++, $data->due_dete);
    xlsWriteLabel($tablebody, $kolombody++, $data->status);
    xlsWriteLabel($tablebody, $kolombody++, $data->remarks);

    $tablebody++;
    $nourut++;
  }

  xlsEOF();
  exit();
}

public function word()
{
  header("Content-type: application/vnd.ms-word");
  header("Content-Disposition: attachment;Filename=notulen_detail.doc");

  $data = array(
    'notulen_detail_data' => $this->Notulen_detail_model->get_all(),
    'start' => 0
  );

  $this->load->view('template','notulen_detail/notulen_detail_doc',$data);
}

function json_notulen(){
 echo $this->Notulen_detail_model->json_notulen();  
}


/*get detail json notulen*/
function get_detail_json(){
 if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
   $data = $this->db->get_where('notulen',array('id_notulen'=>$this->input->post('id_notulen')))->row_array();
   $detail_json =array('id_notulen'=>$data['id_notulen'],
    'nama_agenda'=>$data['agenda']
  );  
   echo json_encode($detail_json);

 }

} 

function get_list_not(){
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $x['data'] =  $this->Notulen_model->get_notify();  
    $this->load->view('notifikasi_notulen',$x);
  } 
}

/*end json detail data*/

function set_close(){
 if($_SERVER['REQUEST_METHOD'] == "POST"){
  $id_not_detail = $this->input->post('id_not_detail');
  $data= array('status'=>'Y');
  $this->db->update('notulen_detail',$data,array('id_not_detail'=>$id_not_detail));
} 

}


}

