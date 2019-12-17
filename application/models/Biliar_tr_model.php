<?php

/**
 * 
 */
class Biliar_tr_model extends CI_model
{
	

	function list_data(){
		$this->db->select('*');
		$this->db->from('biliar_tr'); 
		$this->db->order_by('id_transaksi','asc');
		$this->db->where('paid','N');
		return $this->db->get(); 
	} 

	function table_data(){ 
		$this->db->select('*');
		$this->db->from('biliar_tr');
		$this->db->order_by('id_transaksi','asc');
		$this->db->where('paid','N');
		return $this->db->get(); 
	}

   function detail_bill($id_transaksi){
   	$this->db->select('*');
   	$this->db->from('biliar_tr');
   	$this->db->order_by('id_transaksi','asc');
   	$this->db->where('id_transaksi',$id_transaksi);
   	$this->db->where('paid','N');
   	return $this->db->get(); 


   }
 
}