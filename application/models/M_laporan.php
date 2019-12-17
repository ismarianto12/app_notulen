<?php 
class M_laporan extends CI_model{
	
 
  function laporan_laba(){
   

    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai'); 
    $dari_f=date("Y-m-d", strtotime($dari));
    $sampai_f=date("Y-m-d", strtotime($sampai));
     
    if ($dari !='' AND $sampai !='') { 
        $this->datatables->select('a.id_ransaksi,a.kode_transaksi,a.id_menu,a.id_meja,a.jumlah_porsi,a.penerima,a.id_user,a.tanggal_transaksi,a.memo_khusus,a.catatan_trasaksi,a.paid,a.diskon,date_format(a.tanggal_transaksi,"%y-%M-%d") as t_transaksi,

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
          c.id_user,

          (a.jumlah_porsi *  b.harga_jual) as subtotal, 

        ');
      $this->datatables->from('transaksi a'); 
      $this->datatables->join('menu_resto b', 'b.id_menu = a.id_menu');
      $this->datatables->join('meja c', 'c.id_meja = a.id_meja');
      $this->datatables->where('a.paid','Y'); 
      $this->datatables->where("a.tanggal_transaksi Between '$dari_f' AND '$sampai_f'");
      //$this->datatables->add_column('subtotal','$1  $2','jumlah_porsi,harga_jual');
      return $this->datatables->generate();  
     }else{
      echo '{"draw":0,"recordsTotal":0,"recordsFiltered":0,"data":[]}';
    }  
  
  }



  function get_total_lap($dari,$sampai){ 

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
      $this->db->where('a.paid','Y'); 
      $this->db->where("a.tanggal_transaksi Between '$dari' AND '$sampai'");
        return  $this->db->get();

 
   }


   function laporan_makanan_c($dari,$sampai){
   

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
      $this->db->where('a.paid','Y'); 
      $this->db->where("a.tanggal_transaksi Between '$dari' AND '$sampai'");
      return $this->db->get(); 


   } 

}