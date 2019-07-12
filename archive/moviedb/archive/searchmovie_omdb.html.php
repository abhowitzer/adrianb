<html>
	<body>
	<p><?php echo $testvariable;?> </p>	
		<?php
			include 'omdb.class.php';
			try {
				/*echo "<p>initialize \$omdb</p>";*/
				$omdb = new OMDb(['tomatoes' => TRUE, 'apikey' => 'ba45df32', 'plot' => 'full']);

				/*echo "<p>initialize \$movie</p>";
				echo "<pre>";
					print_r($omdb);
				echo "</pre>";*/
				$movie = $omdb->get_by_title($_POST['title']);

				/*echo "<p>initialize print_r</p>";*/
				
				echo "<p>Title: ";
				print_r($movie['Title']);
				$title = $movie['Title'];
				echo "</p>";
				echo "<p>Year: ";
				print_r($movie['Year']);
				$year = $movie['Year'];
				echo "</p>";
				echo "<p>Genres: ";
				foreach ($movie['Genre'] as $key => $value) {
					echo "{$value}, ";
				}
				echo "</p>";
				echo "<p>Plot: ";
				print_r($movie['Plot']);
				$plot = $movie['Plot'];
				echo "</p>";
			}catch(Exception $e) {
				echo $e->getMessage();
			}
		?>
		<form action="updatemovie.php" method="post">
			<a>Add the above movie information to the database for this movie?<?php echo $_POST['id'];?></p>
			<input type="hidden" name ="id" value="<?php echo $_POST['id']; ?>">
			<input type="hidden" name="year" value="<?php echo $year; ?>">
			<input type="hidden" name="plot" value="<?php echo $plot; ?>">
			<input type="submit" value="Update movie">
		</form>
	</body>
</html>