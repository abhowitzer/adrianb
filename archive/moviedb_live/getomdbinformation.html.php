<div class="alert alert-warning text-center" role="alert">
	Attention. This movie hasn't been found in the database. All information below comes directly from IMDB.
</div>
<?php

include 'omdb.class.php';

try {
	$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);

	$movie = $omdb->get_by_id($_GET['imdbid']);
	
	$title = $movie['Title'];
	$year = $movie['Year'];
	$plot = $movie['Plot'];
	$poster = $movie['Poster'];
	$imdbrating = $movie{'imdbRating'}
    } catch(Exception $e) {
	echo $e->getMessage();
}

?>