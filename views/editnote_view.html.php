<?php include $_SERVER["DOCUMENT_ROOT"] . 'functions/getsingle.php';
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
	<p>test test test</p>
	<head>
		<meta charset="utf-8">
		<title>Add Joke</title>
		<style type="text/css">
			textarea {
			display: block;
			width: 100%;
			}
		</style>
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bkyvhl6i8f23gwzvcj6zkabsn2ipxm9mhff00j6ks4p23fxo"></script>
		<script>
			tinymce.init({
				selector:'#body',
				branding: false,
				toolbar: 'undo redo | styleselect | bold italic | link image',
				menu: {
				}
			});
		</script>
	</head>
	<body>
		<form action="../functions/process_note.php" method="POST">
			<div class="form-group">
				<input type="hidden" name="process_type" value="edit">
				<input type="hidden" name="id" value="<?php echo $id; ?>">

				<label for="title">
					<strong>Title</strong>
				</label>

				<textarea id="title" name="title" rows="1" cols="20">
					<?php echo $note['title']; ?>
				</textarea>

				<label for="body">
					<strong>Note</strong>
				</label>

				<textarea id="body" name="body" rows="5" cols="40">
					<?php echo $note['body']; ?>
				</textarea>
			</div>
		<row>
			<input type="submit" class="btn btn-primary" value="Submit edit">
			<a class="btn btn-outline-dark" value="Cancel edit" onclick="goBack()">Cancel</a>
			<button type="reset" class="btn btn-reset" value="Reset changes">Reset</button>
		</row>
		</form>
	</body>
</html>