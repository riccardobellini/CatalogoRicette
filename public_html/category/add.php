<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<div id="catDetailsContainer">
	<form action="store.php?method=add" method="POST">
		<span>Nome:</span>
		<input type="text" name="categoryName" placeholder="Nome categoria..." required="">
		<br/>
		<input type="submit" value="Aggiungi"/>
	</form>
</div>


<a href="list.php">Torna alla lista delle categorie</a>


<?php include '../footer.php'; ?>