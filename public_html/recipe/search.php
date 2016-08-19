<?php require_once '../../main/functions.php'; ?>

<?php
$recipeList = recipelist();
?>

<table style="max-width: 40%;" border="1">
    <thead>
        <tr>
            <th>Titolo</th>
            <th>Azione</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach ($recipeList as $row) {
?>
        <tr>
            <td>
                <a href="store.php?recipeId=<?php echo htmlspecialchars($row['ID']); ?>"><?php echo htmlspecialchars($row['TITOLO']); ?></a>
            </td>
            <td>
                <button type="button">Rimuovi</button>
            </td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
