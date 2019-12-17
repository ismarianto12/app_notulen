 
    <body>
        <h2>Notulen_detail List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Notulen</th>
		<th>Issue</th>
		<th>PIC</th>
		<th>Due Dete</th>
		<th>Status</th>
		<th>Remarks</th>
		
            </tr><?php
            foreach ($notulen_detail_data as $notulen_detail)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $notulen_detail->id_notulen ?></td>
		      <td><?php echo $notulen_detail->issue ?></td>
		      <td><?php echo $notulen_detail->PIC ?></td>
		      <td><?php echo $notulen_detail->due_dete ?></td>
		      <td><?php echo $notulen_detail->status ?></td>
		      <td><?php echo $notulen_detail->remarks ?></td>	
                </tr>
                <?php
            }
            ?>
        