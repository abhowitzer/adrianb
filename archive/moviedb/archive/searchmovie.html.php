<html>
	<body>
		<p>
			Your movie was: <?php echo $_POST["title"]; ?><br>
		</p>
		<?php
		
			print_r($_POST);
			echo "<br>";
			json_encode($_POST);
			echo "<br>";
			print_r($_POST);

			echo "<br />curl_init<br />";

			$query = str_replace(" ", "+", $_POST["title"]);
			/*$ch = curl_init("https://api.themoviedb.org/3/search/movie?api_key=eb3482c60b5d2c1104acfe8ce1b67084&results&query=".$query);*/

			$ch = curl_init("http://www.omdbapi.com/?apikey=ba45df32&t=" . $query);

			echo "execute curl_exec <br />";
			echo "<pre>";			
			$request = curl_exec($ch);
			echo "</pre> <br>";
			echo "execute json_decode <br />";
			$json = json_decode($request, true);
			echo "<pre> <br>";
			echo "execute print_r <br />";
			print_r($json[0], true);
			foreach ($json->results as $res) {
				print_r($res);
			}
			echo "</pre>";
			echo "<br />";
			echo "<p>  Echo the results <br />";

			echo $json;
			echo json_last_error();
		?>

		<?php /*
			$json = file_get_contents("example.json");
			echo "json_decode <br>";
			$json_a = json_decode($json_a, true);
			echo "<pre>";
			echo "$json <br>" . $json . "<br>";
			echo "$json_a <br>" . $json_a . "<br>";
			echo "</pre>";
		*/ ?>
	</body>
</html>