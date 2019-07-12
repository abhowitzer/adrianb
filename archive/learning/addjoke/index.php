<p>---- Index.php is loaded ----</p>
<p><a href="?addjoke">Add your own joke</a></p>
<!-- <p><a href="?jokedelete">Delete a joke</a></p> -->
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

if (isset($_GET['addjoke'])) {
	// echo "<p>---- if $_GET query addjoke is set, show form.html.php ----</p>";
	include 'form.html.php';
	exit();
}

// if (isset($_GET['jokedelete'])) {
// 	// echo "<p>---- if $_GET query deljoke is set, show formdel.html.php ----</p>";
// 	include 'formdel.html.php';
// 	exit();
// }

try
{
	$pdo = new PDO('mysql:host=localhost;dbname=ijdb', 'ijdbuser', 'Test');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
	$error = 'Unable to connect to the database server.';
	include 'error.html.php';
	exit();
}

if (isset($_POST['joketext']))
{
	// echo "<p>---- if $_POST query joketext is set from the form.html.php form, add this to the DB ----</p>";
	try
	{
		$sql = 'INSERT INTO joke SET
		joketext = :joketext,
		jokedate = CURDATE()';
		$s = $pdo->prepare($sql);
		$s->bindValue(':joketext', $_POST['joketext']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error adding submitted joke: ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}

if (isset($_GET['deletejoke']))
{
	try
	{
		$sql = 'DELETE FROM joke WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error deleting joke: ' . $e->getMessage();
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

try
{
	$sql = 'SELECT joke.id, joketext, name, email FROM joke INNER JOIN author ON authorid = author.id';
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching jokes: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

foreach ($result as $row)
{
	$jokes[] = array(
		'id' => $row['id'],
		'text' => $row['joketext'],
		'name' => $row['name'],
		'email' => $row['email'],
	);
}

// echo "<p>---- Include jokes.html.php so existing jokes are shown ----</p>";
include 'jokes.html.php';