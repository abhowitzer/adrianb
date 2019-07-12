<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>List of Movies</title>
	</head>
	<body>
		<p>Here are all the movies in the database:</p>
		<?php foreach ($movielist as $movie): ?>
			<blockquote>
				<p>
					<?php echo htmlspecialchars($movie, ENT_QUOTES, 'UTF-8'); ?>
				</p>
			</blockquote>
		<?php endforeach; ?>
	</body>
</html>