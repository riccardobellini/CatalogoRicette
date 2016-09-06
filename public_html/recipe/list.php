<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<script src="list.js" type="text/javascript"></script>

<h2>Lista ricette</h2>

<p>
    <label for="recNameFilter">Filtro:</label>
    <input id="recNameFilter" type="text" name="recipeName">
</p>

<!-- list (filtered) results -->
<div id="recipeListContainer" style="margin-bottom: 1em;">
    

<?php include 'search.php'; ?>


</div>


<a href="store.php">Aggiungi ricetta...</a>


<?php include '../footer.php'; ?>