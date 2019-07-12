<?php
try
{
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

try
{
	$sql = 'SELECT movie FROM movielist';
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching movies: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

while ($row = $result->fetch())
{
	$movielist[] = $row['movie'];
}

include 'movies.html.php';