<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Country</th>
		<th>Actions</th>
	</tr>
<?php foreach( $artists as $artist ): ?>
	<tr>
		<td><?php echo $artist['id']; ?></td>
		<td><?php echo $artist['name']; ?></td>
		<td><?php echo $artist['country']; ?></td>
		<td>
			<a href="<?php echo DX_ROOT_URL ?>">Edit</a>
			<a href="">Delete</a>
		</td>
	</tr>
<?php endforeach;?>
</table>