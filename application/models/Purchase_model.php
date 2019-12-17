<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_model extends CI_Model
{

    public $table = 'purchase';
    public $id = 'id_purchase';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('a.id_purchase,a.kode_purchase,a.suplier,a.alamat_sup,a.id_barang,a.tanggal_purchase,a.detail,a.jumlah');
        $this->datatables->select('b.id_suplier,
                                   b.nama_suplier,
                                   b.alamat_suplier,
                                   b.no_hp,
                                   b.no_rek'); 
        $this->datatables->from('purchase a');
     
        //add this line for join
        $this->datatables->join('suplier b', 'a.suplier = b.id_suplier');
        $this->datatables->add_column('detail','<button class="btn btn-success" onclick="return detail(\'$1\')">Cetak Detail</button>','kode_purchase');
        $this->datatables->add_column('action', anchor(site_url('purchase/detail/$1'),'<i class="fa fa-book"></i>Read','class="btn btn-info btn-xs edit"')."  ".anchor(site_url('purchase/edit/$1'),'<i class="fa fa-edit"></i> Update','class="btn btn-success btn-xs edit"')."<a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a>", 'id_purchase');
        $this->datatables->group_by('a.kode_purchase');
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
        $this->db->like('id_purchase', $q);
	$this->db->or_like('kode_purchase', $q);
	$this->db->or_like('suplier', $q);
	$this->db->or_like('alamat_sup', $q);
	$this->db->or_like('id_barang', $q);
	$this->db->or_like('tanggal_purchase', $q);
	$this->db->or_like('detail', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_purchase', $q);
	$this->db->or_like('kode_purchase', $q);
	$this->db->or_like('suplier', $q);
	$this->db->or_like('alamat_sup', $q);
	$this->db->or_like('id_barang', $q);
	$this->db->or_like('tanggal_purchase', $q);
	$this->db->or_like('detail', $q);
	$this->db->or_like('jumlah', $q);
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

 