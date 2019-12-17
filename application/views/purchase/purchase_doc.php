 
    <body>
        <h2>Purchase List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Purchase</th>
		<th>Suplier</th>
		<th>Alamat Sup</th>
		<th>Id Barang</th>
		<th>Tanggal Purchase</th>
		<th>Detail</th>
		<th>Jumlah</th>
		
            </tr><?php
            foreach ($purchase_data as $purchase)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $purchase->kode_purchase ?></td>
		      <td><?php echo $purchase->suplier ?></td>
		      <td><?php echo $purchase->alamat_sup ?></td>
		      <td><?php echo $purchase->id_barang ?></td>
		      <td><?php echo $purchase->tanggal_purchase ?></td>
		      <td><?php echo $purchase->detail ?></td>
		      <td><?php echo $purchase->jumlah ?></td>	
                </tr>
                <?php
            }
            ?>
        