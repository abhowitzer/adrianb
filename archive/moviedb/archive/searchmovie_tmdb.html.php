<html>
	<body>
		<p>
			Your movie was: <?php echo $_POST["title"]; ?><br>
		</p>
		<?php
			try {
                echo "<p>initialize \$tmdb settings</p>";
                $token  = new \Tmdb\ApiToken('eb3482c60b5d2c1104acfe8ce1b67084');             
                $client = new \Tmdb\Client($token);

				echo "<p>initialize \$movie</p>";
				echo "<pre>";
					print_r($omdb);
				echo "</pre>";
				$movie = $omdb->get_by_title($_POST['title']);

				echo "<p>initialize print_r</p>";

				print_r($movie['Plot']);
				print_r($movie['Title']);
				print_r($movie['Year']);
				print_r($movie['Genre']);
				print_r($movie['Plot']);

			}catch(Exception $e) {
				echo $e->getMessage();
			}
		?>
	</body>
</html>