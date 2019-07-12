<?php
include 'header.html';
include 'omdb.class.php';
	try {
		$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);

        $results = $omdb->search($_GET['movie']);

        echo "<ol>";
        foreach($results['Search'] as $result) {
            echo "<li><a href='addtodb.php?imdbid=" . $result['imdbID'] . "'>" . $result['Title'] . "</li></a>";
        }
	}catch(Exception $e) {
		echo $e->getMessage();
	}
?>


<table class="table table-sm">
	<thead>
		<tr>
			<th scope="col">Title</th>
			<th scope="col">Year</th>
			<th scope="col">Genre</th>
			<th scope="col">IMDB ID</th>
		</tr>
	</thead>
	<?php foreach ($movielist as $movie): ?>
	<tr>
		<td>
			<a href="details.html.php?id=<?php echo $movie['id']; ?>">
			<?php
			echo htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8');
			?>
			</a>
		</td>
		<td><?php echo $movie['year']; ?></td>
		<td><?php print_r($movie['genre']); ?></td>
		<td><a href="details.html.php?id=<?php echo $movie['id']; ?>"><?php echo $movie['imdbid']; ?></a></td>
	</tr>
	<?php endforeach; ?>
</table>
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