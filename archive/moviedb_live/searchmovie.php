<?php
include 'header.html';
include 'omdb.class.php';
$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);
try {
	$results = $omdb->search($_GET['title']);
	echo "<p class='alert alert-secondary'>Select the movie you wish to add below.</p>";
	echo "<ol>";
	foreach($results['Search'] as $result) {
		if ($result['Type'] == 'movie') {
			echo "<a href='addmovie.php?imdbid=" . $result['imdbID'] . "'>";
			echo "	<li>". $result['Title'] . ", " . $result['Year'];
			echo "<p>" . $result['Plot'] . "</p>" . "</li>";
			echo "</a>";
		} else {
			exit();
		}
	}
	echo "</ol>";
	} catch(Exception $e) {
		echo $e->getMessage();
	}
include 'footer.html';
?>