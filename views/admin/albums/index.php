<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Year</th>
		<th>Artist ID</th>
	</tr>
<?php foreach( $albums as $album ): ?>
	<tr>
		<td><?php echo $album['id']; ?></td>
		<td><?php echo $album['name']; ?></td>
		<td><?php echo $album['year']; ?></td>
		<td><?php echo $album['artist_id']; ?></td>
	</tr>
<?php endforeach;?>
</table>