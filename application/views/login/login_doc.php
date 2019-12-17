 
    <body>
        <h2>Login List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Username</th>
		<th>Password</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Foto</th>
		<th>Level</th>
		<th>Active</th>
		<th>Date Create</th>
		
            </tr><?php
            foreach ($login_data as $login)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $login->username ?></td>
		      <td><?php echo $login->password ?></td>
		      <td><?php echo $login->nama ?></td>
		      <td><?php echo $login->email ?></td>
		      <td><?php echo $login->foto ?></td>
		      <td><?php echo $login->level ?></td>
		      <td><?php echo $login->active ?></td>
		      <td><?php echo $login->date_create ?></td>	
                </tr>
                <?php
            }
            ?>
        