<?php require_once '../../main/functions.php'; ?>

<?php

if (isset($_GET['do']) && $_GET['do'] === 'search') {
    $recTitle = key_exists_or('title', $_GET, '');
    $ingrName = key_exists_or('ingredient', $_GET, '');
    $categoryId = key_exists_or('category', $_GET, '');
    $recipeList = search_recipe($recTitle, $ingrName, $categoryId);
} else {
    $recipeList = recipelist();    
}

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
                <button type="button" onclick="CR.RecipeList.remove('<?php echo htmlspecialchars($row['ID']); ?>')">Rimuovi</button>
            </td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
