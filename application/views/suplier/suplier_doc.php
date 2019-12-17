 
    <body>
        <h2>Suplier List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Suplier</th>
		<th>Alamat Suplier</th>
		<th>No Hp</th>
		<th>No Rek</th>
		
            </tr><?php
            foreach ($suplier_data as $suplier)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $suplier->nama_suplier ?></td>
		      <td><?php echo $suplier->alamat_suplier ?></td>
		      <td><?php echo $suplier->no_hp ?></td>
		      <td><?php echo $suplier->no_rek ?></td>	
                </tr>
                <?php
            }
            ?>
        