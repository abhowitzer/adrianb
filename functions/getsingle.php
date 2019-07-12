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
try {
	//$sql = "SELECT id, title, body, time FROM notes WHERE `id` is :id ORDER BY time DESC";
	$sql = "SELECT id, title, body, time FROM `notes` WHERE id = :id";
	$result = $pdo->prepare($sql);
	$result->bindValue(":id", $_GET['id']);
	$result->execute();
	$note = $result->fetch();
} catch (PDOException $e) {
	$error = 'Error fetching items: ' . $e->getMessage();
	include 'views/error.html.php';
	exit();
}
?>