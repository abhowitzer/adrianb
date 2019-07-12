<?php

// This file initializes the connection to the MYSQL database,
// and puts all the information from it into a $movielist array.

// Initialize DB connection
try {
	$pdo = new PDO('mysql:host=localhost;dbname=imdb', 'imdbuser', 'Test');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
	$error = 'Unable to connect to the database server.';
	include 'error.html.php';
	exit();
}

// Pick up data from DB
//	id, title, year, genre, plot
try {
	$sql = 'SELECT id, title, year, genre, plot, imdbid, poster, imdbrating FROM movielist
	ORDER BY title ASC';
	$result = $pdo->query($sql);
}
catch (PDOException $e)
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
		'imdbrating' => $row['imdbrating']
	);
}

?>