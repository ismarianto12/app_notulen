 
    <body>
        <h2>Bahan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Harga Beli</th>
		<th>Harga Jual</th>
		<th>Stok</th>
		<th>Satuan</th>
		<th>Id Kategori</th>
		<th>Id Suplier</th>
		<th>Tanggal Barang</th>
		<th>Id Login</th>
		
            </tr><?php
            foreach ($bahan_data as $bahan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $bahan->kode_barang ?></td>
		      <td><?php echo $bahan->nama_barang ?></td>
		      <td><?php echo $bahan->harga_beli ?></td>
		      <td><?php echo $bahan->harga_jual ?></td>
		      <td><?php echo $bahan->stok ?></td>
		      <td><?php echo $bahan->satuan ?></td>
		      <td><?php echo $bahan->id_kategori ?></td>
		      <td><?php echo $bahan->id_suplier ?></td>
		      <td><?php echo $bahan->tanggal_barang ?></td>
		      <td><?php echo $bahan->id_login ?></td>	
                </tr>
                <?php
            }
            ?>
        