<?php
// This file makes picks up OMDB data for the given movie,
// and adds this movie with details to the databse.

include 'header.html';
include 'dbconnection.php';
include 'omdb.class.php';

$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);

$imdbid = $_GET['imdbid'];
$omdbmovie = $omdb->get_by_id($imdbid);

// Is there already a movie with this IMDBID in the database?

try {
	$sql = "SELECT title FROM `movielist` WHERE `imdbid` LIKE ':imdbid'";
	$s = $pdo->prepare($sql);
	$s->bindValue(":imdbid", $_GET['imdbid']);
	$s->execute();
	$count = $s->rowCount();
	$result = $s->fetchAll();
} catch(PDOException $e) {
	echo $e->getMessage();
	exit();	
}

// Only add the movie if the movie _doesn't_ exist in the database

if ($count > 0) {
	echo "<div class='alert alert-danger text-center' role='alert'>Can not add movie. This movie has already been added before.<br>Click <a href='/search.html.php'>here</a> to add another movie.</div>";
	echo "<br>" . $count;
	print_r($result);
} else {
	try	{
		$sql = "INSERT INTO movielist (title, year, plot, imdbid, poster, imdbrating)
		VALUES (:title, :year, :plot, :imdbid, :poster, :imdbrating)";
		$s = $pdo->prepare($sql);
		$s->bindValue(":title", $omdbmovie['Title']);
		$s->bindValue(":year", $omdbmovie['Year']);
		$s->bindValue(":plot", $omdbmovie['Plot']);
		$s->bindValue(":imdbid", $omdbmovie['imdbID']);
		$s->bindValue(":poster", $omdbmovie['Poster']);
		$s->bindValue(":imdbrating", $omdbmovie['imdbRating']);
		//$s->bindValue(":added", date('Y-m-d');
		$s->execute();
		$id = $pdo->lastInsertId();
		echo $id;
	} catch(PDOException $e) {
		echo $e->getMessage();
		exit();	
	}
	echo "<p>Movie has been added. Click below to see the movie.</p>";
	echo "<div class='btn btn-primary'><a href='/details.html.php?id=" . $id . "'>MOVIE</a></div>";
}
?>
<?php include 'footer.html'; ?>