<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<?php
$id = $_GET['id'];
$row = getbook($id);
?>

<div id="bookDetailsContainer">
	<form action="store.php?method=edit" method="POST">
		<span>Titolo:</span>
		<input type="text" name="bookTitle" placeholder="Titolo libro..." required=""> value="<?php echo $row['TITOLO']; ?>">
		<input type="hidden" name="bookId" value="<?php echo $row['ID']; ?>">
		<br/>
		<input type="submit" value="Modifica"/>
	</form>
</div>


<a href="list.php">Torna alla lista dei libri</a>

<?php include '../footer.php'; ?>