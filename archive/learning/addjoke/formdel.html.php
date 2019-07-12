<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add Joke</title>
		<style type="text/css">
			textarea {
			display: block;
			width: 100%;
			}
		</style>
	</head>
	<body>
	<p>---- if $_GET query jokedel is set, show formdel.html.php ----</p>
		<form action="?" method="post">
			<div>
				<label for="jokedelete">Type the joke text of the joke you wish to remove:</label>
				<textarea id="jokedelete" name="jokedelete" rows="3" cols="40"></textarea>
			</div>
			<div>
				<input type="submit" value="Add">
			</div>
		</form>
	</body>
</html>