<?php
// All code for connecting to database
include $_SERVER["DOCUMENT_ROOT"] . 'functions/dbconnection.php';
if (isset ($_GET['filter'])) {
} else {
	$_GET['filter'] = 'active';
}
?>
<div class="row">
  <a class="btn btn-secondary" href="/?view=list&filter=all" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    All posts
  </a>
  <a class="btn btn-secondary" href="/?view=list&filter=active" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Only active posts
  </a>
  <a class="btn btn-secondary" href="/?view=list&filter=hidden" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Only hidden posts
  </a>  
</div>
<?php foreach ($notelist as $note): ?>
<article style="padding-bottom:20px;">
	<div class="row">
		<h2 class="text-justify display-5"><a href="?view=detail&id=<?php echo($note['id']); ?>"><?php echo $note['title']; ?></a></h2>
	</div>
	<div class="row">
		<div class="col-8">
			<?php echo $note['time']; ?>
		</div>
		<div class="col-4">
			<a href="?view=edit&id=<?php echo($note['id']); ?>">Edit</a>&nbsp;or&nbsp;
			<a href="?view=del&id=<?php echo($note['id']); ?>">Delete</a>
		</div>
	</div>	
	<div class="row">
		<div><?php echo $note['body']; ?></div>
	</div>
</article>
<?php endforeach; ?>
