<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<ul>

<?php
    foreach (booklist() as $row) {
?>

<li>
<a href="edit.php?id=<?php echo $row['ID']; ?>"><?php echo $row['TITOLO']; ?></a>
</li>

<?php
    }
?>

</ul>

<a href="add.php">Aggiungi libro...</a>


<?php include '../footer.php'; ?>