var CR = CR || {};

CR.RecipeStore = (function() {

    var ingrCount = 0;
    var categCount = 0;

    var ingr_autocomplete_opt = {
        source : function (request, response) {
            $.ajax({
                url: '../ingredient/search.php',
                type: 'GET',
                dataType: 'json',
                data: {query: request.term},
                cache: false,
                async: true
            })
            .done(function(data) {
                response($.map(data, function(item, index) {
                    return {value: item.name, key: item.id};
                }));
            })
            .fail(function(xhr, status, error) {
                console.log("error: " + error);
                console.log(xhr.responseText);
            })

        },
        select: function (event, ui) {
            var elemNum = $(this).attr('id').split('_')[1];
            $('#ingredientId_' + elemNum).val(ui.item.key);
        },
        minLength: 3
    };

    var init = function () {
        ingrCount = $('#ingredientsTable tbody tr').length;
        console.log('Number of ingredients: ' + ingrCount);

        $('#ingredientsTable').on('click', '.addIngredient', function(event) {
            event.preventDefault();
            ++ingrCount;
            var str = '<tr><td><input type="hidden" name="ingredientId[]" id="ingredientId_' + ingrCount +'"><input type="text" autocomplete="off" class="ingredient" name="ingredientName[]" id="ingredientName_' + ingrCount + '"></td><td><button id="removeIngredient_' + ingrCount + '" class="removeIngredient">Rimuovi</button></td></tr>';
            var newTr = $(str);
            $('#ingredientsTable tbody').append(newTr);
            $('.ingredient', newTr).focus().autocomplete(ingr_autocomplete_opt);
        });

        $('#ingredientsTable').on('click', '.removeIngredient', function(event) {
            event.preventDefault();
            $(this).parent().parent('tr').remove();
        });

        $('.ingredient').autocomplete(ingr_autocomplete_opt);

        categCount = $('#categoriesTable tbody tr').length;
        console.log('Number of categories: ' + categCount);

        $('#categoriesTable').on('click', '.addCategory', function(event) {
            event.preventDefault();
            ++categCount;
            var newRow = $('<tr></tr>');
            var tdSelect = $('<td></td>');
            var selectEl = $('<select name="categoryId=[]" id="categoryId_' + categCount + '"></select>');
            selectEl.html($('#categoryList').html());
            tdSelect.append(selectEl);
            var tdRemove = $('<td><button id="removeCategory_' + categCount + '" class="removeCategory">Rimuovi</button></td>')
            newRow.append(tdSelect).append(tdRemove);
            $('#categoriesTable tbody').append(newRow);
        });

        $('#categoriesTable').on('click', '.removeCategory', function(event) {
            event.preventDefault();
            $(this).parent().parent('tr').remove();
        });

        $('#newIngrBtn').on('click', function(event) {
            event.preventDefault();
            $('#ingrModal').show();
            $('#ingrModal input').focus();
        });

        $('#ingrModal .close').on('click', function(event) {
            $('#ingrModal').hide();
        });

        $('#newCategBtn').on('click', function(event) {
            event.preventDefault();
            $('#categModal').show();
            $('#categModal input').focus();
        });

        $('#categModal .close').on('click', function(event) {
            $('#categModal').hide();
        });

        $('#newIngrForm').on('submit', function(event) {
            event.preventDefault();
            _addNewIngredient();
        });

        $('#newCategForm').on('submit', function(event) {
            event.preventDefault();
            _addNewCategory();
        });
    };

    function _addNewIngredient() {
        $.post('../ingredient/store.php?method=add', $('#newIngrForm').serialize())
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('#ingrModal').hide();
            $('#ingrModal input').val('');
        });
    };

    function _addNewCategory() {
        $.post('../category/store.php?method=add', $('#newCategForm').serialize())
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('#categModal').hide();
            $('#categModal input').val('');
        });
    };

    return {
        init : init,
        debug : function() { debugger; }
    }

})();

$(function() {
    CR.RecipeStore.init();
});