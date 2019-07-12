<?php
include $_SERVER["DOCUMENT_ROOT"] . 'views/header.html';
include $_SERVER["DOCUMENT_ROOT"] . 'functions/dbconnection.php';

switch ($_POST['process_type']) {
	case '':
		echo "Failure.";
		break;
	case 'add':
		try	{
			$sql = "INSERT INTO notes (title, body)
			VALUES (:title, :body)";
			
			$s = $pdo->prepare($sql);

			$s->bindValue(":title", $_POST['title']);
			$s->bindValue(":body", $_POST['body']);

			$s->execute();
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		echo "<p>Note has been added.</p>";
		break;
	case 'edit':
		echo $_POST['title'];
		echo $_POST['body'];
		echo $_POST['id'];				
		try	{
			$sql = "UPDATE notes
			SET  title = :title, body = :body
			WHERE id = :id";
			
			$s = $pdo->prepare($sql);

			$s->bindValue(":title", $_POST['title']);
			$s->bindValue(":body", $_POST['body']);
			$s->bindValue(":id", $_POST['id']);

			$s->execute();
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		echo "<p>Note has been edited.</p>";
		break;
	case 'del':
		try {
			$sql = "UPDATE notes
			SET visible = 0
			WHERE id = :id";

			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			
			$s->execute();
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		echo "<p>Note has been deleted.</p>";
		break;
}
echo "<button class='btn btn-primary' href='adrianb.be/>Go to hompage</button>";		

?>

<?php $_SERVER["DOCUMENT_ROOT"] . 'views/footer.html'; ?>