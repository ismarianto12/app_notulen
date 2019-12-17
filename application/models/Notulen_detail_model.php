<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notulen_detail_model extends CI_Model
{

    public $table = 'notulen_detail';
    public $id = 'id_not_detail';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function list_data(){
      $this->db->select('*');
      $this->db->from('notulen');
      return $this->db->get();  
    }

    // datatables
    function json() {
        $id = $this->input->post('id_notulen');
        $filter_by = $this->input->post('filter_by');

        if ($id == '') {
            return '{"draw":0,"recordsTotal":1,"recordsFiltered":1,"data":[]}';
        }else{ 
        $this->datatables->select('
            a.id_not_detail,
            a.id_notulen,
            a.issue,
            a.PIC,
            a.due_dete,
            a.status,
            a.remarks,

            b.id_notulen,
            b.agenda,
            b.id_create,
            b.start_time,
            b.end_time,
            b.place,
            b.participan,
            b.date_create,

            c.id_user,
            c.nama,
            c.email,
            c.level,
            c.active,
            c.date_create,
            c.log,    
            ');
        $this->datatables->from('notulen_detail a'); 
        $this->datatables->join('notulen b', 'a.id_notulen = b.id_notulen','left');
        $this->datatables->join('login c', 'c.id_user = b.id_create','left'); 
        if ($filter_by != '') {
         $this->datatables->where('a.status',$filter_by);
        }
        $this->datatables->where('a.id_notulen',$id);
        if($this->session->level =='admin'):
        $this->datatables->add_column('action', anchor(site_url('notulen_detail/detail/$1'),'<i class="fa fa-book"></i>Read','class="btn btn-info btn-xs edit"')."  ".anchor(site_url('notulen_detail/edit/$1'),'<i class="fa fa-edit"></i> Update','class="btn btn-success btn-xs edit"')."<a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a> <a href='#' class='btn btn-warning btn-xs delete' onclick='javasciprt: return set_close($1)'><i class='fa fa-check'></i> Set Close </a>", 'id_not_detail');
        else:
           $this->datatables->add_column('action', anchor(site_url('notulen_detail/detail/$1'),'<i class="fa fa-book"></i>Read','class="btn btn-info btn-xs edit"'),'id_not_detail');
        endif;
       return $this->datatables->generate();
      }
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
        $this->db->like('id_not_detail', $q);
	$this->db->or_like('id_notulen', $q);
	$this->db->or_like('issue', $q);
	$this->db->or_like('PIC', $q);
	$this->db->or_like('due_dete', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('remarks', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_not_detail', $q);
	$this->db->or_like('id_notulen', $q);
	$this->db->or_like('issue', $q);
	$this->db->or_like('PIC', $q);
	$this->db->or_like('due_dete', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('remarks', $q);
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


    function json_notulen(){ 
        $this->datatables->select('
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
          b.log 

            ');
        $this->datatables->from('notulen a');
        $this->datatables->join('login b', 'a.id_create = b.id_user','left');
        $this->datatables->add_column('nama_user','$1','nama');
        $this->datatables->add_column('action',"<button class='btn btn-success btn-xs add' onclick='javasciprt: return pilih_agenda($1)'><i class='fa fa-add'></i> + Pilih agenda</button>",'id_notulen');
        return $this->datatables->generate();
    }

    function get_detail($id){ 
        $this->db->select('            
                        a.id_not_detail,
                        a.id_notulen,
                        a.issue,
                        a.PIC,
                        a.due_dete,
                        a.status,
                        a.remarks,
            ');
        $this->db->from('notulen_detail a');
        $this->db->where('a.id_notulen',$id);
        return $this->db->get();
    }
}

 