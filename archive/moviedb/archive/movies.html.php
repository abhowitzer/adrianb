<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>List of movies</title>
	</head>
	<body>
		<p> ---- movie.html.php is loaded ---- </p>
		<p><?php echo $testvariable;?> </p>
		<p>Here are all the movies in the database:</p>
		<?php foreach ($movielist as $movie): ?>
			<form action="?searchmovie" method="post">
				<?php echo $movie['id']; ?>
				<?php echo htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8'); ?>
				<?php echo $movie['added']; ?>
				<input type="hidden" name="title" value="<?php echo ($movie['title']); ?>">					
				<input type="hidden" name="id" value="<?php echo ($movie['id']); ?>">
				<input type="submit" value="Look up">
			</form>
		<?php endforeach; ?>
<?php /*
		<?php foreach ($movielist as $movie): ?>
			<form action="?deletemovie" method="post">
				<?php echo $movie['id']; ?>
				<?php echo htmlspecialchars($movie['text'], ENT_QUOTES, 'UTF-8'); ?>
				<?php echo $movie['added']; ?>
				<input type="hidden" name="id" value="<?php echo $joke['id']; ?>">		
				<input type="submit" value="Delete">
			</form>
		<?php endforeach; ?>
*/ ?>
	</body>
</html>