<?php
include $_SERVER["DOCUMENT_ROOT"] . 'functions/getsingle.php';
$id = $_GET['id'];
?>

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
		<form action="../functions/process_note.php" method="POST">
			<p>Are you sure you wish to delete the following note?</p>
			<div class="form-group">
				<input type="hidden" name="process_type" value="del">
				<input type="hidden" name="id" value="<?php echo $id; ?>">

				<label for="title">
					<strong>Title</strong>
				</label>

				<textarea readonly id="title" name="title" rows="1" cols="20">
					<?php echo $note['title']; ?>
				</textarea>

				<label for="body">
					<strong>Note</strong>
				</label>

				<textarea readonly id="body" name="body" rows="5" cols="40">
					<?php echo $note['body']; ?>
				</textarea>
			</div>
			<row>
				<input type="submit" class="btn btn-danger" value="Delete">
				<a class="btn btn-outline-dark" value="Cancel edit" onclick="goBack()">Cancel</a>
				<button type="reset" class="btn btn-reset" value="Reset changes">Reset</button>
			</row>
		</form>
	</body>
</html>