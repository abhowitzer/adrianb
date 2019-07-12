<?php
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=imdb', 'imdbuser', 'Test');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
    } catch (PDOException $e) {
        $error = 'Error connecting to database: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
    echo "test";
    try {
        echo $_POST['id'] . "<br>";
        echo $_POST['year'] . "<br>";
        echo $_POST['plot'] . "<br>";
        echo $_POST['poster'] . "<br>";
    
        $sql = "UPDATE movielist SET year=:year, plot=:plot, poster=:poster WHERE imdbid=:imdbid";
        $s = $pdo->prepare($sql);
        $s->bindValue(':imdbid', $_POST['imdbid']);
        $s->bindValue(':plot', $_POST['plot']);
        $s->bindValue(':year', $_POST['year']);
        $s->bindValue(':poster', $_POST['poster']);
        $s->execute();
        echo "<p> UPDATED FIELDS! </p>";
    } catch (PDOException $e) {
        $error = 'Error updating movie in database: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

?>