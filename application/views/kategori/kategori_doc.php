 
    <body>
        <h2>Kategori List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Kategori</th>
		<th>Tanggal Kategori</th>
		
            </tr><?php
            foreach ($kategori_data as $kategori)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kategori->nama_kategori ?></td>
		      <td><?php echo $kategori->tanggal_kategori ?></td>	
                </tr>
                <?php
            }
            ?>
        