<?php
//include 'header.html';
// Initialize DB connection
try {
	$pdo = new PDO('mysql:host=localhost;dbname=imdb', 'imdbuser', 'Test');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
} catch (PDOException $e)
{
	$error = 'Unable to connect to the database server.';
	include 'error.html.php';
	exit();
}

// Pick up data from DB
//	id, title, year, genre, plot
try {
	$sql = 'SELECT id, title, year, genre, plot, imdbid, poster FROM movielist';
	$result = $pdo->query($sql);
} catch (PDOException $e)
{
	$error = 'Error fetching movies: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

// Loop through result of above data request
// and build an associative array, $movielist, around it.
foreach ($result as $row) {
	$movielist[] = array(
		'id' => $row['id'],
		'title' => $row['title'],
		'year' => $row['year'],
		'genre' => $row['genre'],
		'plot' => $row['plot'],
		'imdbid' => $row['imdbid'],
		'poster' => $row['poster'],
	);
}

// foreach ($movielist as $movie) {
// 	echo $movie['title'] . "<br>";
// }

// include 'omdb.class.php';
// try	{
// 	$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);
// 	foreach ($movielist as $movie) {
// 		$omdbmovie = $omdb->get_by_title($movie['title']);
// 		echo $omdbmovie['Title'] . "<br>";
// 	}
// } catch(Exception $e) {
// 	echo $e->getMessage();
// 	exit();	
// }
include 'omdb.class.php';

$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);

$count = 0;

try	{
	foreach ($movielist as $movie) {

		$omdbmovie = $omdb->get_by_title($movie['title']);
		
		$sql = "UPDATE movielist SET year=:year, plot=:plot, imdbid=:imdbid, poster=:poster WHERE title=:title";

		$s = $pdo->prepare($sql);

		$s->bindValue(":year", $omdbmovie['Year']);
		$s->bindValue(":plot", $omdbmovie['Plot']);
		$s->bindValue(":imdbid", $omdbmovie['imdbID']);
		$s->bindValue(":title", $omdbmovie['Title']);
		$s->bindValue(":poster", $omdbmovie['Poster']);
		$s->execute();
		echo "Updated database for: " . $count.". " . $movie['title'] . "\r\n";
		$count++;
	}
} catch(Exception $e) {
	echo $e->getMessage();
	exit();	
}

?>