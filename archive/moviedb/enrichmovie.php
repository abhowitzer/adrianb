<?php
include 'omdb.class.php';
	try {
		$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);

		$movie = $omdb->get_by_id($_GET['id']);
		$title = $movie['Title'];
		$year = $movie['Year'];
		$plot = $movie['Plot'];
		$poster_unsafe = htmlspecialchars($movie['Poster'], ENT_QUOTES, 'UTF-8');
		$poster = base64_encode($poster_unsafe);

		echo "<h2>" . $title . "</h2>";

		echo "<p>Year: " . $year . "</p>";
		echo "<p>Genres: ";
		foreach ($movie['Genre'] as $key => $value) {
			echo "{$value}, ";
		}
		echo "</p>";
		echo "<p class='blockquote'>Plot: " . $plot . "</p>";
		echo "<p><img class='figure' src=\"" . $poster_unsafe . "\"\> </p>";
	}catch(Exception $e) {
		echo $e->getMessage();
	}
?>
	<form action="updatemovie.php" method="post">
		<a>Add the above movie information to the database for this movie?<?php echo $_POST['id'];?></p>
		<input type="hidden" name ="id" value="<?php echo $_POST['id']; ?>">
		<input type="hidden" name="year" value="<?php echo $year; ?>">
		<input type="hidden" name="plot" value="<?php echo $plot; ?>">
		<input type="hidden" name="poster" value="<?php echo $poster; ?>">
		<input type="submit" value="Update movie">
	</form>