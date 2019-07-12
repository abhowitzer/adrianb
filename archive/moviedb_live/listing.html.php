<table class="table table-sm">
	<thead>
		<tr>
			<th scope="col">Title</th>
			<th scope="col">Year</th>
			<th scope="col">Rating</th>
			<th scope="col">IMDB ID</th>
		</tr>
	</thead>
	<?php foreach ($movielist as $movie): ?>
	<tr>
		<td>
			<a id="<?php echo $movie['id']; ?>" href="details.html.php?id=<?php echo $movie['id']; ?>">
			<?php
			echo htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8');
			?>
			</a>
		</td>
		<td><?php echo $movie['year']; ?></td>
		<td><?php echo($movie['rating']); ?></td>
		<td><a href="details.html.php?id=<?php echo $movie['id']; ?>"><?php echo $movie['imdbid']; ?></a></td>
	</tr>
	<?php endforeach; ?>
</table>