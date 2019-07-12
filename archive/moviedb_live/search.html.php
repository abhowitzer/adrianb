<?php include 'header.html'; ?>
	<form action="searchmovie.php" method="get">
		<div>
			<label for="title">Search for the title of a movie you'd like to add.</label>
			<input type="text" id="title" name="title">						
		</div>
		<div>
			<input type="submit" value="Add">
		</div>
	</form>
<?php include 'footer.html'; ?>