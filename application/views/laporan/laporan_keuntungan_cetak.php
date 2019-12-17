<?php 

$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';

if ($jenis == 'xls') {
	
	$namafile = "rekap_laporan_pendapatan.xls";
	header("Content-type:application/vnd.ms-excel");
	header("Content-Disposition:attachment;filename=$namafile");
	header("Expires:0");
	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
	header('Content-Transfer-Encoding: text'); 
	header("Pragma: public");


}elseif($jenis == 'word'){

	$namafile = "rekap_laporan_pendapatan.docx";
	header("Content-type:application/vnd.ms-excel");
	header("Content-Disposition:attachment;filename=$namafile");
	header("Expires:0");
	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
	header('Content-Transfer-Encoding: text'); 
	header("Pragma: public");


}elseif($jenis =='pdf'){
 
 
}elseif($jenis == 'csv'){

	$namafile = "rekap_laporan_pendapatan.dbf";
	header("Content-type:application/vnd.ms-excel");
	header("Content-Disposition:attachment;filename=$namafile");
	header("Expires:0");
	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
	header('Content-Transfer-Encoding: text'); 
	header("Pragma: public");  
}else{
	show_404('ERROR REQUES');
	exit();
}
?>
<style>
	table,td,th{font-family:'Trebuchet MS'; vertical-align:middle;}
	th{background:#CCCCCC; font-weight:bold; text-transform:uppercase;}
</style>


 
<table border="1">
	<thead>
		<th colspan="9"><tt>REKAP DATA PENDAPTAN PER <?= tgl_indonesia($dari) ?> s/d <?= tgl_indonesia($sampai) ?> </tt></th>
		<tr>
			<th>No</th>
			<th>Nama Menu</th>
			<th>Kode Menu</th>
			<th>Harga Jual</th>
			<th>Jumlah</th>
            <th>Sub Total</th>
  		</tr>
	</thead>  
	<tbody>
		 <?php
		      $total= '';
		      $total_item = '';

		      $no=1; foreach($data->result_array() as $sql):
              $subtotal =  (int)$sql['jumlah_porsi'] * (int)$sql['harga_jual'];
              $total  += $sql['harga_jual'];
              $total_item += $sql['jumlah_porsi'];
		 ?>
           <tr>
           	<td><?= $no ?></td>
           	<td><?= $sql['nama_menu'] ?></td>
           	<td><?= $sql['kode_menu'] ?></td>
           	<td><?= $sql['harga_jual'] ?></td>
           	<td><?= $sql['jumlah_porsi'] ?></td>
           	<td><?= $subtotal ?></td>
           	</tr>
		
		<?php $no++; endforeach; ?>	
	</tbody>
	<tfoot><tr><td colspan="4"><div align='right'><b>Total</b></div></td><td><?= $total ?></td></tr><tr>
		<td colspan="4"><div align='right'>Item</div></td><td><?= $total_item ?></td></tr>
	</tfoot>
</table>


