<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<?php
$id = $_GET['id'];
$row = getcategory($id);
?>

<div id="catDetailsContainer">
	<form action="store.php?method=edit" method="POST">
		<span>Nome:</span>
		<input type="text" name="categoryName" placeholder="Nome categoria..." required="" value="<?php echo $row['NOME']; ?>">
		<input type="hidden" name="categoryId" value="<?php echo $row['ID']; ?>">
		<br/>
		<input type="submit" value="Modifica"/>
	</form>
</div>


<a href="list.php">Torna alla lista delle categorie</a>

<?php include '../footer.php'; ?>