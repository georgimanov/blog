<form method="POST">
	<p>
		Name: <input type="text" name="name" value="<?php echo addslashes($album['name']) ?>" />
	</p>
	<p>
		Year: <input type="text" name="year" value="<?php echo addslashes( $album['year'] )  ?>" />
	</p>
	<input type="hidden" name="id" value="<?php echo $album['id'] ?>" />
	<input type="submit" />
</form>
