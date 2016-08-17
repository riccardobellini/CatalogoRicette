<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<?php
$id = $_GET['id'];
$row = getingredient($id);
?>

<div id="ingrDetailsContainer">
	<form action="store.php?method=edit" method="POST">
		<span>Nome:</span>
		<input type="text" name="ingredientName" placeholder="Nome ingrediente..." required="" value="<?php echo $row['NOME']; ?>">
		<input type="hidden" name="ingredientId" value="<?php echo $row['ID']; ?>">
		<br/>
		<input type="submit" value="Modifica"/>
	</form>
</div>


<a href="list.php">Torna alla lista degli ingredienti</a>

<?php include '../footer.php'; ?>