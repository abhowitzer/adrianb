<?php

// All code for connecting to database
include 'dbconnection.php';

// Code to create the movielist array
include 'getmovies.php';

// Show the addmovie form
if (isset($_GET['addmovie'])) {
	include 'form.html.php';
	exit();
}

// Show header element
include 'header.html';

// Show listing module with all movies in DB
include 'listing.html.php';

// Show footer module
include 'footer.html';

?>