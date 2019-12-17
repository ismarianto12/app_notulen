 
<body>
	<h2>Menu List</h2>
	<table class="word-table" style="margin-bottom: 10px">
		<tr>
			<th>No</th>
			<th>Id Parent</th>
			<th>Nama Menu</th>
			<th>Icon</th>
			<th>Link</th>
			<th>Aktif</th>
			<th>Urutan</th>
			<th>Position</th>
			<th>Level</th>
			
			</tr><?php
			foreach ($menu_data as $menu)
			{
				?>
				<tr>
					<td><?php echo ++$start ?></td>
					<td><?php echo $menu->id_parent ?></td>
					<td><?php echo $menu->nama_menu ?></td>
					<td><?php echo $menu->icon ?></td>
					<td><?php echo $menu->link ?></td>
					<td><?php echo $menu->aktif ?></td>
					<td><?php echo $menu->urutan ?></td>
					<td><?php echo $menu->position ?></td>
					<td><?php echo $menu->level ?></td>	
				</tr>
				<?php
			}
			?>
			