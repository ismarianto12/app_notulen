 
    <body>
        <h2>Notulen List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Agenda</th>
		<th>Id Create</th>
		<th>Start Time</th>
		<th>End Time</th>
		<th>Place</th>
		<th>Participan</th>
		
            </tr><?php
            foreach ($notulen_data as $notulen)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $notulen->agenda ?></td>
		      <td><?php echo $notulen->id_create ?></td>
		      <td><?php echo $notulen->start_time ?></td>
		      <td><?php echo $notulen->end_time ?></td>
		      <td><?php echo $notulen->place ?></td>
		      <td><?php echo $notulen->participan ?></td>	
                </tr>
                <?php
            }
            ?>
        