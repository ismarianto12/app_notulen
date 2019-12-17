<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Notulen_model extends CI_Model
{

  public $table = 'notulen';
  public $id = 'id_notulen';
  public $order = 'DESC';

  function __construct()
  {
    parent::__construct();
  }

    // datatables
  function json() {
    $this->datatables->select(' 
     a.id_notulen,
     a.agenda,
     a.id_create,
     a.start_time,
     a.end_time,
     a.place,
     a.participan,
     (a.date_create) as tanggal_not,

     b.id_user,
     b.nama,
     b.email,
     b.level,
     b.active,
     b.date_create,
     b.log');

    $this->datatables->from('notulen a');
    $this->datatables->join('login b', 'a.id_create = b.id_user','left');
    $this->datatables->add_column('nama_user','$1','nama');
    if($this->session->level =='admin'):
      $this->datatables->add_column('action', anchor(site_url('notulen/detail/$1'),'<i class="fa fa-book"></i>Read / Print','class="btn btn-info btn-xs edit"')."  ".anchor(site_url('notulen/edit/$1'),'<i class="fa fa-edit"></i> Update','class="btn btn-success btn-xs edit"')."<a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a>", 'id_notulen');
    else:
     $this->datatables->add_column('action', anchor(site_url('notulen/detail/$1'),'<i class="fa fa-book"></i>Read','class="btn btn-info btn-xs edit"'), 'id_notulen'); 
   endif;
   return $this->datatables->generate();
 }

    // get all
 function get_all()
 {
  $this->db->order_by($this->id, $this->order);
  return $this->db->get($this->table)->result();
}

    // get data by id
function get_by_id($id)
{
  $this->db->where($this->id, $id);
  return $this->db->get($this->table)->row();
}

    // get total rows
function total_rows($q = NULL) {
  $this->db->like('id_notulen', $q);
  $this->db->or_like('agenda', $q);
  $this->db->or_like('id_create', $q);
  $this->db->or_like('start_time', $q);
  $this->db->or_like('end_time', $q);
  $this->db->or_like('place', $q);
  $this->db->or_like('participan', $q);
  $this->db->from($this->table);
  return $this->db->count_all_results();
}

    // get data with limit and search
function get_limit_data($limit, $start = 0, $q = NULL) {
  $this->db->order_by($this->id, $this->order);
  $this->db->like('id_notulen', $q);
  $this->db->or_like('agenda', $q);
  $this->db->or_like('id_create', $q);
  $this->db->or_like('start_time', $q);
  $this->db->or_like('end_time', $q);
  $this->db->or_like('place', $q);
  $this->db->or_like('participan', $q);
  $this->db->limit($limit, $start);
  return $this->db->get($this->table)->result();
}

    // insert data
function insert($data)
{
  $this->db->insert($this->table, $data);
}

    // update data
function update($id, $data)
{
  $this->db->where($this->id, $id);
  $this->db->update($this->table, $data);
} 
    // delete data
function delete($id)
{
  $this->db->where($this->id, $id);
  $this->db->delete($this->table);
}

function get_notify(){

  $this->db->select(' 
   a.id_notulen,
   a.agenda,
   a.id_create,
   a.start_time,
   a.end_time,
   a.place,
   a.participan,
   a.date_create,

   b.id_user,
   b.nama,
   b.email,
   b.level,
   b.active,
   b.date_create,
   b.log, 

   c.id_not_detail,
   c.id_notulen,
   c.issue,
   c.PIC,
   c.due_dete,
   c.status,
   c.remarks,
   c.date_created');

  $this->db->from('notulen_detail c'); 
  $this->db->join('notulen a', 'a.id_notulen=c.id_notulen','left');
  $this->db->join('login b', 'a.id_create = b.id_user','left'); 
  $this->db->where('c.status','N');
  return $this->db->get();   


} 

function get_detail($id){ 
 $this->db->select(' 
      a.id_notulen,
      a.agenda,
      a.id_create,
      a.start_time,
      a.end_time,
      a.place,
      a.participan,
      a.date_create as tanggal,
      a.absensi,
      a.no_dokumen,
      a.no_revisi,
      a.notulis,
      a.pimpinan_rapat,
      a.jenis_rapat,
      a.no_agenda,  
      a.tdd_pimpinan,

      b.id_user,
      b.nama,
      b.email,
      b.level,
      b.active,
      b.date_create,
      b.log 

  ');
 $this->db->from('notulen a');
 $this->db->join('login b', 'a.id_create = b.id_user','left');
 $this->db->where('a.id_notulen',$id); 
 return $this->db->get();
}
}

