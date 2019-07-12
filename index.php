<?php

// Show header element
include $_SERVER["DOCUMENT_ROOT"] . 'views/header.html';
// Decide view to show
if (isset ($_GET['view'])) {
	switch ($_GET['view']) {
		case '':
		case 'list':
			include 'views/note_list.html.php';
			break;
		case 'detail':
			include 'views/detailnote_view.html.php';
			break;		
		case 'add':
			echo "<h3>Add note</h3><br>";
			include 'views/addnote_view.html';
			break;
		case 'del':
			echo "<h3>Delete note</h3><br>";
			include 'views/delnote_view.html.php';
			break;
		case 'edit':
			echo "<h3>Edit note</h3><br>";
			include 'views/editnote_view.html.php';
			break;
	}
} else {
	$_GET['view'] = 'list';
	include 'views/note_list.html.php';
}

// Show footer module
include $_SERVER["DOCUMENT_ROOT"] . 'views/footer.html';

?>