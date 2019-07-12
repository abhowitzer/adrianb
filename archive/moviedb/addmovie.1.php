<?php
include 'header.html';
include 'omdb.class.php';

$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);

if (isset($_POST['imdbid']))
{
	try {
		$movie = $omdb->get_by_id($_POST['imdbid']);
		$title = $movie['Title'];
		$year = $movie['Year'];
		$plot = $movie['Plot'];
		$poster = htmlspecialchars($movie['Poster'], ENT_QUOTES, 'UTF-8');
		//$poster = base64_encode($poster_unsafe);

		echo "<h2>" . $title . "</h2>";

		echo "<p>Year: " . $year . "</p>";
		echo "<p>Genres: ";
		foreach ($movie['Genre'] as $key => $value) {
			echo "{$value}, ";
		}
		echo "</p>";
		echo "<p class='blockquote'>Plot: " . $plot . "</p>";
		echo "<p><img class='figure' src=\"" . $poster . "\"\> </p>";
	}catch(Exception $e) {
		echo $e->getMessage();
	}
} else
{
	try {
		$results = $omdb->search($_GET['movie']);

		echo "<ol>";
		foreach($results['Search'] as $result) {
			echo "<li><a href='addtodb.php?imdbid=" . $result['imdbID'] . "'>" . $result['Title'] . "</li></a>";
		}
		} catch(Exception $e) {
			echo $e->getMessage();
		}
}


?>
	<form action="updatemovie.php" method="post">
		<a>Add the above movie information to the database for this movie?<?php echo $_POST['id'];?></p>
		<input type="hidden" name ="id" value="<?php echo $_POST['id']; ?>">
		<input type="hidden" name="year" value="<?php echo $year; ?>">
		<input type="hidden" name="plot" value="<?php echo $plot; ?>">
		<input type="hidden" name="poster" value="<?php echo $poster; ?>">
		<button class="btn btn-primary" type="submit" value="Add movie">Add movie</button>
	</form>
<?php
include 'footer.html';
//     try {
//         $pdo = new PDO('mysql:host=localhost;dbname=imdb', 'imdbuser', 'Test');
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $pdo->exec('SET NAMES "utf8"');
//     } catch (PDOException $e) {
//         $error = 'Unable to connect to the database server.';
//         include 'error.html.php';
//         exit();
//     }
//     echo $_POST['imdbid'] . "<br>";
    
//     try {
//         $sql = "INSERT INTO movielist(imdbid)
//         VALUES(:imdbid)";
//         $s = $pdo->prepare($sql);
//         $s->bindValue(':imdbid', $_POST['imdbid']);
//         $s->execute();
//     } catch (PDOException $e) {
//         $error = 'Unable to add to the database server.';
//         include 'error.html.php';
//         exit();
//     }

//     echo "<p> UPDATED FIELDS! </p>"
//
?>