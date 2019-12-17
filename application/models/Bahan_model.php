<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bahan_model extends CI_Model
{

    public $table = 'bahan';
    public $id = 'id_bahan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('a.id_bahan,a.kode_barang,a.nama_barang,a.harga_beli,a.stok,a.satuan,a.id_suplier,a.tanggal_barang,a.id_login,  
          
          b.id_suplier,
          b.nama_suplier,
          b.alamat_suplier,
          b.no_hp,
          b.no_rek,

');
        //add this line for join
        $this->datatables->from('bahan a');
        $this->datatables->join('suplier b', 'a.id_suplier = b.id_suplier');
        $this->datatables->add_column('action', anchor(site_url('bahan/detail/$1'),'<i class="fa fa-book"></i>Read','class="btn btn-info btn-xs edit"')."  ".anchor(site_url('bahan/edit/$1'),'<i class="fa fa-edit"></i> Update','class="btn btn-success btn-xs edit"')."<a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a>", 'id_bahan');
        return $this->datatables->generate();
    }

     function bahan_json() {
        $this->datatables->select('a.id_bahan,a.kode_barang,a.nama_barang,a.harga_beli,a.stok,a.satuan,a.id_suplier,a.tanggal_barang,a.id_login,  
          b.id_suplier,
          b.nama_suplier,
          b.alamat_suplier,
          b.no_hp,
          b.no_rek,
        ');
        //add this line for join
        $this->datatables->from('bahan a');
        $this->datatables->join('suplier b', 'a.id_suplier = b.id_suplier');
        
        $this->datatables->add_column('jumlah', "<input type='number' name='jumlah_data' id='jumlah_data' classs='form-control' required=''>", 'id_bahan');
        $this->datatables->add_column('action', "<button class='btn btn-info btn-xs info' id='id_bahan' value='$1'> Pilih Bahan.</button>", 'id_bahan');
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
        $this->db->like('id_bahan', $q);
	$this->db->or_like('kode_barang', $q);
	$this->db->or_like('nama_barang', $q);
	$this->db->or_like('harga_beli', $q);
	$this->db->or_like('harga_jual', $q);
	$this->db->or_like('stok', $q);
	$this->db->or_like('satuan', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('id_suplier', $q);
	$this->db->or_like('tanggal_barang', $q);
	$this->db->or_like('id_login', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_bahan', $q);
	$this->db->or_like('kode_barang', $q);
	$this->db->or_like('nama_barang', $q);
	$this->db->or_like('harga_beli', $q);
	$this->db->or_like('harga_jual', $q);
	$this->db->or_like('stok', $q);
	$this->db->or_like('satuan', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('id_suplier', $q);
	$this->db->or_like('tanggal_barang', $q);
	$this->db->or_like('id_login', $q);
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


    /*report data unutk dasboard*/
     

     function data_bahan(){

      $this->db->select('id_menu');
      $this->db->from('menu_resto');
      return $this->db->get(); 

     }
     
     function data_transaksi(){
        
      $this->db->select('id_ransaksi');
      $this->db->from('transaksi');
      return $this->db->get(); 

     }


     function data_transaksi_futsal(){
        
      $this->db->select('id_transaksi');
      $this->db->from('futsall_tr');
      return $this->db->get(); 

     }

    function data_meja(){
        
      $this->db->select('id_meja');
      $this->db->from('meja');
      return $this->db->get(); 

     }


function tmp_purchase(){
 $this->db->select('*');
 $this->db->from('tmp_purchase');
 $this->db->join('bahan','bahan.id_bahan=tmp_purchase.id_barang');
 $this->db->group_by('bahan.id_bahan'); 
 return $this->db->get(); 
}



 
    /*end report data*/

}

 