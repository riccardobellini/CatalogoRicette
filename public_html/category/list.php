<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<ul>

<?php
    foreach (categorylist() as $row) {
?>

<li>
<a href="edit.php?id=<?php echo $row['ID']; ?>"><?php echo $row['NOME']; ?></a>
</li>

<?php
    }
?>

</ul>

<a href="add.php">Aggiungi categoria...</a>


<?php include '../footer.php'; ?>