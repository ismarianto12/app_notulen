<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Meja_model extends CI_Model
{

    public $table = 'meja';
    public $id = 'id_meja';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('a.id_meja,a.nama_meja,a.jumlah_kapasitas,a.create_date,a.id_user');
        
        $this->datatables->select('b.id_user,
                                   b.nama,
                                   b.level'); 
        $this->datatables->from('meja a');
        //add this line for join
        $this->datatables->join('login b', 'a.id_user = b.id_user');
        $this->datatables->add_column('action', anchor(site_url('meja/detail/$1'),'<i class="fa fa-book"></i>Read','class="btn btn-info btn-xs edit"')."  ".anchor(site_url('meja/edit/$1'),'<i class="fa fa-edit"></i> Update','class="btn btn-success btn-xs edit"')."<a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a>", 'id_meja');
        return $this->datatables->generate();
    }

    function json_transaksi() {
        $this->datatables->select('id_meja,nama_meja,jumlah_kapasitas,create_date,id_user');
        $this->datatables->from('meja');
        //add this line for join
        //$this->datatables->join('table2', 'meja.field = table2.field');
        $this->datatables->add_column('action',"<input type='radio' name='nama_meja' class='pilih_meja' value='$1'>Pilih Meja", 'id_meja');
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
        $this->db->like('id_meja', $q);
        $this->db->or_like('nama_meja', $q);
        $this->db->or_like('jumlah_kapasitas', $q);
        $this->db->or_like('create_date', $q);
        $this->db->or_like('id_user', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_meja', $q);
        $this->db->or_like('nama_meja', $q);
        $this->db->or_like('jumlah_kapasitas', $q);
        $this->db->or_like('create_date', $q);
        $this->db->or_like('id_user', $q);
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

}

