<?php
require_once '../../main/functions.php';

if (isset($_GET['method']) && $_GET['method'] === 'add') {
    $recipeId = $_POST['recipeId'];
    $isEdit = false;
    
    if ($recipeId !== '') {
        $isEdit = true;
    }

    $name = $_POST['recipeName'];
    if ($name !== '') {
        $ingredients = array();
        if (isset($_POST['ingredientId'])) {
            foreach ($_POST['ingredientId'] as $key => $value) {
                array_push($ingredients, $value);
            }
        }

        $categories = array();
        if (isset($_POST['categoryId'])) {
            foreach ($_POST['categoryId'] as $key => $value) {
                array_push($categories, $value);
            }
        }

        $volumeNum = issetor($_POST['volumeNum'], 0);
        $yearNum = issetor($_POST['yearNum'], 0);

        addrecipe($name, $ingredients, $categories, $volumeNum, $yearNum);        
    }
}

$bookList = bookList();

?>


<?php
include '../header.php';
?>

<script type="text/javascript" src="store.js"></script>

<!-- The Modal -->
<div id="ingrModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
              <span class="close">×</span>
              <h2>Nuovo ingrediente</h2>
        </div>
        <div class="modal-body">
            <form action="../ingredient/store.php?method=add" method="POST" id="newIngrForm">
                <label for="ingredientName">Nome:</label>
                <input type="text" name="ingredientName" placeholder="Nome ingrediente..." required="">
                <p><button type="submit" id="addNewIngrBtn">Aggiungi</button></p>
            </form>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="categModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
              <span class="close">×</span>
              <h2>Nuova categoria</h2>
        </div>
        <div class="modal-body">
            <form action="../category/store.php?method=add" method="POST" id="newCategForm">
                <label for="categoryName">Nome:</label>
                <input type="text" name="categoryName" placeholder="Nome categoria..." required="">
                <p><button type="submit" id="addNewCategBtn">Aggiungi</button></p>
            </form>
        </div>
    </div>
</div>


<div id="recipeDetailsContainer">
    <form action="store.php?method=add" method="POST">
        <h2>Dati Ricetta</h2>
        <input type="hidden" name="recipeId" value="<?php echo issetor($recId); ?>" autofocus="autofocus">
        <span>Nome:</span>
        <input type="text" name="recipeName" placeholder="Nome ricetta..." required="">
        <br/>
        
        <h3>Ingredienti</h3>
        <table id="ingredientsTable">
            <thead>
                <th style="text-align: center">Nome</th>
                <th style="text-align: center">Azione</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="ingredientId[]" id="ingredientId_1">
                        <input type="text" autocomplete="off" class="ingredient" name="ingredientName[]" id="ingredientName_1">
                    </td>
                    <td><button id="removeIngredient_1" class="removeIngredient">Rimuovi</button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><button class="addIngredient">Aggiungi ingrediente</button></td>
                </tr>
            </tfoot>
        </table>

        <!-- Trigger/Open The Modal -->
        <button id="newIngrBtn">Nuovo ingrediente</button>

        <h3>Categorie</h3>
        <table id="categoriesTable">
            <thead>
                <th style="text-align: center">Nome</th>
                <th style="text-align: center">Azione</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="categoryId[]" id="categoryId_1">
                        <input type="text" autocomplete="off" class="category" name="categoryName[]" id="categoryName_1">
                    </td>
                    <td><button id="removeCategory_1" class="removeCategory">Rimuovi</button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><button class="addCategory">Aggiungi categoria</button></td>
                </tr>
            </tfoot>
        </table>

        <!-- Trigger/Open The Modal -->
        <button id="newCategBtn">Nuova categoria</button>

        <h3>Rivista/Libro</h3>

        <p>
            <label for="bookName">Titolo:</label>
            <select name="bookName">
            <?php foreach ($bookList as $row) { ?>
                <option value="<?php echo htmlspecialchars($row['ID']); ?>"><?php echo $row['TITOLO']; ?></option>                
            <?php } ?>
            </select>
        </p>

        <div style="margin-top: 2em;">
            <p>
                <label for="volumeNum">Volume:</label>
                <input type="number" name="volumeNum" min="1" max="100">
            </p>
            <p>
                <label for="yearNum">Anno:</label>
                <input type="number" name="yearNum" min="1" max="2020">
            </p>
        </div>

        <div style="margin-top: 1em;">
            <input type="submit" value="Salva ricetta" id="addRecipeBtn"/>
        </div>
    </form>
</div>

<?php include '../footer.php'; ?>