<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Preview Struk.</title>
</head>
<script src="<?= base_url('assets/template/js/printPreview.js') ?>"></script>

<body>

  <style type="text/css">
    table, td, th {  
    text-align: left;
}

table {
  border-collapse: collapse;
  width: 40%;
}

th, td {
  padding: 2px;
}

td{

border-bottom: 2px dotted;

}
  </style>
  <div id="masterContent">
<table width="40%" align="center">
  <tr>
    <th colspan="6" scope="row"><center><p>CAFE LASKAR PELANGI</p></center>
    <center><p>Jl. Sudirma no 26 B , Padang </p></center></th>
  </tr>
  <tr>
    <th scope="row">NO</th>
    <td>NAMA MENU </td>
    <td>QTY</td>
    <td>HARGA</td>
    <td>DISC</td>
    <td>TOTAL</td>
  </tr>


<?php
 $total_p =''; 
 $jumlah_porsi='';
 $no=1; foreach($data->result_array() as $sql): 
     // $ppn    = (int)$sql['harga_jual'] * 10 / 100;
      $sub = (int)$sql['harga_jual'] * (int)$sql['jumlah_porsi'];
      $total_p = $sql['harga_jual'];
      $paid = $sql['paid'];
      $jumlah_porsi += $sql['jumlah_porsi'];  
   
      $diskon = (int)$sql['harga_jual'] * (int)$sql['diskon'] / 100;
      $total  = (int)$sql['harga_jual'] - (int)$diskon;

       ?>
  <tr>
    <th><?= $no ?></th>
    <td><?= $sql['nama_menu'] ?></td>
    <td><?= $sql['jumlah_porsi'] ?></td>
    <td>Rp.<?= number_format((int)$sql['harga_jual'],0,0,'.') ?></td>
    <td><?= $sql['diskon'] ?></td>
    <td>Rp.<?= number_format((int)$sub,0,0,'.') ?></td>
  </tr>

<?php $no++; endforeach;
  $ppn    = (int)$total_p * 10 / 100;
  $has_tot = (int)$total_p * (int)$jumlah_porsi + $ppn;

  /*kemabalian */
  $kembalian =(int)str_replace(',', '', $this->input->post('jum_bayar'))-(int)$has_tot;
  
 ?>   
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td ><div align="right">TOTAL BAYAR </div></td>
    <td colspan="2">Rp.<?= number_format((int)$has_tot,0,0,'.') ?></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">CASH</div></td>
    <td colspan="2">Rp.<?= str_replace(',', '.', $this->input->post('jum_bayar')) ?></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">KEMBALI</div></td>
    <td colspan="2">Rp.<?=  number_format($kembalian,0,0,'.') ?></td>
  </tr>
</table>
</div>
<button id="btnPrint">Cetak Struk</button>
 <small>Harga sudah termasuk ppn 10 %</small>
 <center>* ) Terima kasih atas kepercayaan anda berbelanja , Semoga puas.</center>
</body>
</html>
<script type="text/javascript">
  
$(function(){
  $("#btnPrint").printPreview({
    obj2print:'#masterContent',
    style:'<style>td{border-bottom: 2px dotted;}</style>',  
   width:'100'
  });
});

</script>