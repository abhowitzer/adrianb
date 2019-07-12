<?php

    // Pick up data from DB
    //	id, title, year, genre, plot
    try {
        $sql = 'SELECT id, title, year, genre, plot, imdbid, poster FROM movielist
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
        );
    }

?>