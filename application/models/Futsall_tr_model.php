<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Futsall_tr_model extends CI_Model
{

    public $table = 'futsall_tr';
    public $id = 'id_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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
        $this->db->like('id_transaksi', $q);
        $this->db->or_like('kode_transaksi', $q);
        $this->db->or_like('waktu_mulai', $q);
        $this->db->or_like('waktu_selesai', $q);
        $this->db->or_like('tanggal_transaksi', $q);
        $this->db->or_like('id_kasir', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_transaksi', $q);
        $this->db->or_like('kode_transaksi', $q);
        $this->db->or_like('waktu_mulai', $q);
        $this->db->or_like('waktu_selesai', $q);
        $this->db->or_like('tanggal_transaksi', $q);
        $this->db->or_like('id_kasir', $q);
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

    function detail_transaksi($id){
        $this->db->select('*');
        $this->db->select('b.id_user,b.username,b.password,b.nama,b.email');
        $this->db->from('futsall_tr a'); 
        $this->db->where('a.id_transaksi',$id);
        $this->db->join('login b', 'a.id_kasir = b.id_user','left'); 
        return $this->db->get();

    }

    function hitung_js(){
      $this->db->select('*');
      $this->db->from('futsall_tr a');
      $this->db->join('login b','b.id_user=a.id_kasir','left');
      $this->db->where('paid','N');
      return $this->db->get(); 

  }

/*revisi*/

function table_data(){
    $this->db->select('*');
    $this->db->from('futsall_tr');
    $this->db->order_by('id_transaksi','asc');
    $this->db->where('paid','N');
    return $this->db->get(); 
}

/*end data revisi*/


}

