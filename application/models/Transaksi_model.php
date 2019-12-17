<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $table = 'transaksi';
    public $id = 'id_ransaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {

    $id_meja = $this->input->post('id_meja'); 
    $searchQuery = "";
    if ($id_meja !='') {
      $searchQuery = $this->datatables->where('a.id_meja',$id_meja);    
    }
    if($id_meja == 'B'){
      $searchQuery = $this->datatables->where('a.id_meja','B');      
    }

    if($id_meja == ''){
      $searchQuery ="";      
    }

        $this->datatables->select('a.id_ransaksi,a.kode_transaksi,a.id_menu,a.id_meja,a.jumlah_porsi,a.penerima,a.id_user,a.tanggal_transaksi,a.memo_khusus,a.catatan_trasaksi,a.paid,a.diskon,

            b.id_menu,
            b.nama_menu,
            b.harga_jual,
            b.kode_menu,
            b.ketersedian,
            b.tanggal_create,

            c.id_meja,
            c.nama_meja,
            c.jumlah_kapasitas,
            c.create_date,
            c.id_user 

            ');
        $this->datatables->from('transaksi a'); 
        $this->datatables->join('menu_resto b', 'b.id_menu = a.id_menu','left');
        $this->datatables->join('meja c', 'c.id_meja = a.id_meja','left');
        $searchQuery; 
        $this->datatables->where('a.paid','N'); 
        $this->datatables->add_column('diskon','$1','diskon');
        $this->datatables->add_column('action',"<a href='#' id='hapus_item' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus_transaksi($1,$2)'><i class='fa fa-trash'></i> Cancel</a>", 'id_ransaksi,id_meja');
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
        $this->db->like('id_ransaksi', $q);
	$this->db->or_like('kode_transaksi', $q);
	$this->db->or_like('id_menu', $q);
	$this->db->or_like('id_meja', $q);
	$this->db->or_like('jumlah_porsi', $q);
	$this->db->or_like('penerima', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('tanggal_transaksi', $q);
	$this->db->or_like('memo_khusus', $q);
	$this->db->or_like('catatan_trasaksi', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_ransaksi', $q);
	$this->db->or_like('kode_transaksi', $q);
	$this->db->or_like('id_menu', $q);
	$this->db->or_like('id_meja', $q);
	$this->db->or_like('jumlah_porsi', $q);
	$this->db->or_like('penerima', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('tanggal_transaksi', $q);
	$this->db->or_like('memo_khusus', $q);
	$this->db->or_like('catatan_trasaksi', $q);
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


    function data_meja(){
      $this->db->select('a.id_meja,a.nama_meja,a.jumlah_kapasitas,a.create_date,
          
          b.id_ransaksi,
          b.kode_transaksi,
          b.id_menu,
          b.id_meja
          ');
      $this->db->from('meja a');
      $this->db->join('transaksi b','a.id_meja=b.id_meja');
      $this->db->group_by('b.id_meja');
      return $this->db->get();
    }


    function  hitung_transaksi($id_meja){

     $this->db->select('a.id_ransaksi,a.kode_transaksi,a.id_menu,a.id_meja,a.jumlah_porsi,a.penerima,a.id_user,a.tanggal_transaksi,a.memo_khusus,a.catatan_trasaksi,a.paid,a.diskon,

        b.id_menu,
        b.nama_menu,
        b.harga_jual,
        b.kode_menu,
        b.ketersedian,
        b.tanggal_create,

        c.id_meja,
        c.nama_meja,
        c.jumlah_kapasitas,
        c.create_date,
        c.id_user 

        ');
     $this->db->from('transaksi a'); 
     $this->db->join('menu_resto b', 'b.id_menu = a.id_menu');
     $this->db->join('meja c', 'c.id_meja = a.id_meja');
     $this->db->where('a.paid','N');
     $this->db->where('a.id_meja',$id_meja);
     return $this->db->get();
  }
}

 