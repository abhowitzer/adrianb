<?php
// This file initializes the connection to the MYSQL database,
// and puts all the information from it into a $movielist array.

// Initialize DB connection
try {
	$pdo = new PDO('mysql:host=localhost;dbname=notedb', 'notesuser', 'Test');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
} catch (PDOException $e) {
	$error = 'Unable to connect to the database server.';
	include 'error.html.php';
	exit();
}

// Pick up data from DB
//	id, title, year, genre, plot

if ($_GET['filter'] == 'all' OR empty($_GET['filter'])) {
	try {
		$sql = "SELECT id, title, body, time, visible
		FROM notes
		WHERE visible in (0, 1)
		ORDER BY time DESC";
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching items: ' . $e->getMessage();
		include 'views/error.html.php';
		exit();
	}
} elseif ($_GET['filter'] == 'active') {
	try {
		$sql = "SELECT id, title, body, time, visible
		FROM notes
		WHERE visible = 1
		ORDER BY time DESC";
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching items: ' . $e->getMessage();
		include 'views/error.html.php';
		exit();
	}
} elseif ($_GET['filter'] == 'hidden') {
	try {
		$sql = "SELECT id, title, body, time, visible
		FROM notes
		WHERE visible = 0
		ORDER BY time DESC";
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching items: ' . $e->getMessage();
		include 'views/error.html.php';
		exit();
	}
}

// Loop through result of above data request
// and build an associative array, $movielist, around it.
foreach ($result as $note) {
	$notelist[] = array(
		'id' => $note['id'],
		'title' => $note['title'],
		'body' => $note['body'],
		'time' => $note['time']
	);
}

?>