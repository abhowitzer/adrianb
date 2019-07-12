<?php
include $_SERVER["DOCUMENT_ROOT"] . 'functions/getsingle.php';
$id = $_GET['id'];
?>

<article>
	<div class="row">
		<div class="col-8">
			<h2 class="text-justify display-5" style="padding-bottom:20px;"><?php echo $note['title']; ?></h2>
		</div>
		<div class="col-4 text-right lead align-middle">
			<p><?php echo $note['time']; ?></p>
			<a href="?view=edit&id=<?php echo($note['id']); ?>">Edit</a>&nbsp;or&nbsp;
			<a href="?view=del&id=<?php echo($note['id']); ?>">Delete</a>			
		</div>
	</div>
	<div class="row">
		<div class="container"><?php echo $note['body']; ?></div>
	</div>
</article>