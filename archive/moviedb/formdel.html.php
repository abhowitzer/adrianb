<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add Movie</title>
		<style type="text/css">
			textarea {
			display: block;
			width: 100%;
			}
		</style>
	</head>
	<body>
	<p>---- if $_GET query deletemovie is set, show formdel.html.php ----</p>
		<form action="?" method="post">
			<div>
				<label for="moviedelete">Type the joke text of the joke you wish to remove:</label>
				<textarea id="moviedelete" name="moviedelete" rows="3" cols="40"></textarea>
			</div>
			<div>
				<input type="submit" value="Add">
			</div>
		</form>
	</body>
</html>