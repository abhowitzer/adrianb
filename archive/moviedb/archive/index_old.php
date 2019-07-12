<p>---- TES TTEST is loaded ----</p>
<p>
	<a href="?addmovie">Add your own movie</a>
</p>
<!-- <p><a href="?jokedelete">Delete a movie</a></p> -->
<?php
/* PHP magic I don't need to understand yet.*/
if (get_magic_quotes_gpc())
{
  $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
  while (list($key, $val) = each($process))
  {
    foreach ($val as $k => $v)
    {
      unset($process[$key][$k]);
      if (is_array($v))
      {
        $process[$key][stripslashes($k)] = $v;
        $process[] = &$process[$key][stripslashes($k)];
      }
      else
      {
        $process[$key][stripslashes($k)] = stripslashes($v);
      }
    }
  }
  unset($process);
}
/* End of magic */

if (isset($_GET['addmovie'])) {
	// echo "<p>---- if $_GET query addmovie is set, show form.html.php ----</p>";
	include 'form.html.php';
	exit();
}

if (isset($_GET['searchmovie'])) {
	echo "<p>---- if $_GET $_POST query searchmovie is set, show searchmovie.html.php ----</p>";
	include 'searchmovie_omdb.html.php';
	exit();
}
// if (isset($_GET['moviedelete'])) {
// 	// echo "<p>---- if $_GET query delmovie is set, show formdel.html.php ----</p>";
// 	include 'formdel.html.php';
// 	exit();
// }

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

if (isset($_POST['movie']))
{
	// echo "<p>---- if $_POST query joketext is set from the form.html.php form, add this to the DB ----</p>";
	try
	{
		$sql = 'INSERT INTO movielist SET
		movie = :movie,
		added = CURDATE()';
		$s = $pdo->prepare($sql);
		$s->bindValue(':movie', $_POST['movie']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error adding submitted movie: ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}

if (isset($_POST['updatemovie']))
{
	// echo "<p>---- if $_POST query joketext is set from the form.html.php form, add this to the DB ----</p>";
	try
	{
		$sql = 'INSERT INTO movielist SET
			movie = :movie,
			added = CURDATE()';
		$s = $pdo->prepare($sql);
		$s->bindValue(':movie', $_POST['movie']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error adding submitted movie: ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}

if (isset($_GET['deletemovie']))
{
	try
	{
		$sql = 'DELETE FROM movielist WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error deleting movie: ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}


// if (isset($_POST['jokedelete']))
// {
// 	// echo "<p>---- if $_POST query jokedel is set from the formdel.html.php form, remove this joke from the DB ----</p>";
// 	try
// 	{
// 		$sql = 'DELETE FROM joke WHERE joketext LIKE :jokedelete';
// 		$s = $pdo->prepare($sql);
// 		$s->bindValue(':jokedelete', $_POST['jokedelete']);
// 		$s->execute();
// 	}
// 	catch (PDOException $e)
// 	{
// 		$error = 'Error removing joke: ' . $e->getMessage();
// 		include 'error.html.php';
// 		exit();
// 	}
// 	header('Location: .');
// 	exit();
// }

/*try
{
	$sql = 'SELECT movielist.id, movie, name, email FROM movielist INNER JOIN author ON authorid = author.id';
	$result = $pdo->query($sql);
}*/
try
{
	$sql = 'SELECT id, title, year, genre, plot, imdbid, poster FROM movielist';
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching jokes: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

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
foreach ($movielist as $movie) {
	echo "<p>" . $movie['id'] . "</p>";
	echo "<p>" . $movie['title'] . "</p>";
	echo "<p>" . $movie['year'] . "</p>";
	echo "<p>" . $movie['genre'] . "</p>";
	echo "<p>" . $movie['plot'] . "</p>";
	echo "<p>" . $movie['imdbid'] . "</p>";
	echo "<p>" . $movie['poster'] . "</p>";
}


// echo "<p>---- Include jokes.html.php so existing jokes are shown ----</p>";
//include 'movies.html.php';