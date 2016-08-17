<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<div id="bookDetailsContainer">
    <form action="store.php?method=add" method="POST">
        <span>Titolo:</span>
        <input type="text" name="bookTitle" placeholder="Titolo libro..." required="">
        <br/>
        <input type="submit" value="Aggiungi"/>
    </form>
</div>


<a href="list.php">Torna alla lista dei libri</a>


<?php include '../footer.php'; ?>