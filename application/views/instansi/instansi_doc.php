 
    <body>
        <h2>Instansi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Instantsi</th>
		<th>Nama Instansi</th>
		<th>Alamat Lengkap</th>
		<th>Telp</th>
		<th>Fax</th>
		<th>Npwp</th>
		<th>Logo</th>
		
            </tr><?php
            foreach ($instansi_data as $instansi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $instansi->id_instantsi ?></td>
		      <td><?php echo $instansi->nama_instansi ?></td>
		      <td><?php echo $instansi->alamat_lengkap ?></td>
		      <td><?php echo $instansi->telp ?></td>
		      <td><?php echo $instansi->fax ?></td>
		      <td><?php echo $instansi->npwp ?></td>
		      <td><?php echo $instansi->logo ?></td>	
                </tr>
                <?php
            }
            ?>
        