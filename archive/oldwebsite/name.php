<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title>Query String Link Example</title>
  </head>
  <body>
	<p>
	<?php
		$firstName = $_REQUEST['firstname'];
		$lastName = $_REQUEST['lastname'];
		if ($firstName == 'Kevin' or $lastName == 'Yank') {
			echo 'Welcome, oh glorious leader!';
			$Parsedown = new Parsedown();
			echo $Parsedown->text('Hello _$firstName_!'); # prints: <p>Hello <em>Parsedown</em>!</p>
		}
		else {
			echo 'Welcome to our website, ' .
			htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') . ' ' .
			htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8') . '!';
		}
		if ($firstName == 'Kevin') {

		}
	?>
	<br>
	<br>	
	<p> Normal While loop </p>
	<?php
		$count = 1;
		while ($count <= 10) {
			echo "$count ";
			++$count;
		}
	?>
	<br>	
	<br>
	<p> For loop </p>
	<?php
		for ($count = 1; $count <= 10; ++$count)
		{
			echo "$count ";
		}
	?>
	</p>
  </body>
</html>