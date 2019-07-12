<html>
	<body>
		<p>
			Your movie was: <?php echo $_POST["movie"]; ?><br>
		</p>

		<?php
			$ch = curl_init("https://api.themoviedb.org/3/search/movie?api_key=eb3482c60b5d2c1104acfe8ce1b67084&query=". $_POST["movie"]);
			echo "curl_init <br />";
			//fwrite($myfile, $data = curl_exec($ch));
			$movies = json_decode(curl_exec($ch));
			echo "execute curl_init <br />";
			foreach ($movies as $key => $value){
				echo $key . ':' . $value;
			}
			/*print_r($movies);
			$myfile = fopen("filename.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $data);
			echo "<br><br>curl_exec <br />";
			$json_string = json_decode($data);
			print_r($json_string);
			echo "<br><br>json_decode <br />";
			curl_close($ch);
			print_r(json_decode(curl_exec($ch)));*/
		?>
	</body>
</html>