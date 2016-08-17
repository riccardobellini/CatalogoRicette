<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<div id="ingrDetailsContainer">
	<form action="store.php?method=add" method="POST">
		<label for="ingredientName"></label>>Nome:</span>
		<input type="text" name="ingredientName" placeholder="Nome ingrediente..." required="">
		<br/>
		<input type="submit" value="Aggiungi"/>
	</form>
</div>


<a href="list.php">Torna alla lista degli ingredienti</a>


<?php include '../footer.php'; ?>