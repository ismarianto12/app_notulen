<!DOCTYPE html>
<html>
<head>
	<title>Detail Data Purchase.</title>
</head>
<body>
	<?php $identitas=$data->row_array(); ?>

 <h3>DETAIL DATA PURCHASE BAHAN.</h3>
 <hr />
	<table style="border-collapse: collapse; width: 100%; height: 36px;" border="1">
		<tbody>
			<tr>
				<th>Tujuan Purchase</th>
				<th><?= $identitas['nama_suplier'] ?></th>
				<th>No Purchase&nbsp;</th>
				<th><?= $identitas['kode_purchase'] ?></th>
			</tr>
			<tr style="height: 18px;">
				<td style="width: 33.3333%; height: 18px;background: #ddd;">No&nbsp;</td>
				<td style="width: 33.3333%; height: 18px;background: #ddd;">Nama Barang</td>
				<td style="width: 33.3333%; height: 18px;background: #ddd;" colspan="2">Harga Purchase&nbsp;</td>
			</tr>

			<?php 
             $total='';
			 $no=1; foreach($data->result_array() as $sql_data):
             $total += $sql_data['harga_beli']; 
			  ?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $sql_data['nama_barang'] ?></td>
				<td colspan="2">Rp.<?= number_format($sql_data['harga_beli'],0,0,'.') ?></td>
			</tr>
			<?php $no++; endforeach; ?>
		 
				<tr><td style="text-align: right;font-weight: bold;">Total</td><td colspan="2">Rp.<?= number_format($total,0,0,'.') ?></td></tr>
		 

		</tbody>
	</table>

	<br />
		<center>
			
			<u>PIMPINAN</u>
			<br /><br /><br />
			 
			DTO

		</center>
</body>
</html>