 
    <body>
        <h2>Transaksi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Transaksi</th>
		<th>Id Menu</th>
		<th>Id Meja</th>
		<th>Jumlah Porsi</th>
		<th>Penerima</th>
		<th>Id User</th>
		<th>Tanggal Transaksi</th>
		<th>Memo Khusus</th>
		<th>Catatan Trasaksi</th>
		
            </tr><?php
            foreach ($transaksi_data as $transaksi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $transaksi->kode_transaksi ?></td>
		      <td><?php echo $transaksi->id_menu ?></td>
		      <td><?php echo $transaksi->id_meja ?></td>
		      <td><?php echo $transaksi->jumlah_porsi ?></td>
		      <td><?php echo $transaksi->penerima ?></td>
		      <td><?php echo $transaksi->id_user ?></td>
		      <td><?php echo $transaksi->tanggal_transaksi ?></td>
		      <td><?php echo $transaksi->memo_khusus ?></td>
		      <td><?php echo $transaksi->catatan_trasaksi ?></td>	
                </tr>
                <?php
            }
            ?>
        