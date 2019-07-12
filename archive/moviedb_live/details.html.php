<?php include 'header.html'; ?>
<?php include 'dbconnection.php'; ?>
<?php
	// Pick up data from DB
	//	id, title, year, genre, plot
	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		try {
			$sql = 'SELECT title, year, genre, plot, imdbid, poster FROM movielist WHERE id=?';
			$s = $pdo->prepare($sql);
			$s->execute([$id]);
			$movie = $s->fetch();
	
		} catch (PDOException $e){
			$error = 'Error fetching movies: ' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
	
		$id = $movie['id'];
		$title = $movie['title'];
		$year = $movie['year'];
		$genre = $movie['genre'];
		$plot = $movie['plot'];
		$imdbid = $movie['imbid'];
		$poster = $movie['poster'];
		
		// if(!isset($title)) {
		// 	echo "<div class='alert alert-primary text-center'>We haven't found any details about this movie. Please use the update function down below to get basic information on this movie.</div>";
		// 	echo "<a class='btn btn-primary' href='updatemovie.php?imdbid=" . $imbdid . "'> Update Movie</a>";
		// }
	}
	elseif (isset($_GET['imdbid']))
	{
		include 'getomdbinformation.html.php';
	}
	?>
	<h2><?php echo $title; ?></h2>
	<p>Year: <?php echo $year; ?></p>
	<p>Rating: <?php echo $imdbrating; ?></p>
	<p class='blockquote'>Plot: <?php echo $plot; ?> </p>
	<p class="text-center"><img class='figure' src=<?php echo $poster; ?>> </p>
<?php include 'footer.html'; ?>