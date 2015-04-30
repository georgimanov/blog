<form method="POST">
	<p>
		Name: <input type="text" name="name" value="<?php echo addslashes($artist['name']) ?>" />
	</p>
	<p>
		Country: <input type="text" name="country" value="<?php echo addslashes( $artist['country'] )  ?>" />
	</p>
	<input type="hidden" name="id" value="<?php echo $artist['id'] ?>" />
	<input type="submit" />
</form>
