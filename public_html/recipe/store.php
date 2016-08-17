<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<script type="text/javascript" src="store.js"></script>

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

        <div style="margin-top: 1em;">
            <input type="submit" value="Salva ricetta"/>
        </div>
    </form>
</div>

<?php include '../footer.php'; ?>