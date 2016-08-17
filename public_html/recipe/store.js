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

    var categ_autocomplete_opt = {
        source : function (request, response) {
            $.ajax({
                url: '../category/search.php',
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
            $('#categoryId_' + elemNum).val(ui.item.key);
        },
        minLength: 3
    };

    var init = function () {
        ingrCount = $('#ingredientsTable tbody tr').length;
        
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


        categCount = $('#categorieTable tbody tr').length;
        
        $('#categoriesTable').on('click', '.addCategory', function(event) {
            event.preventDefault();
            ++categCount;
            var str = '<tr><td><input type="hidden" name="categoryId[]" id="categoryId_' + categCount +'"><input type="text" autocomplete="off" class="category" name="categoryName[]" id="categoryName_' + categCount + '"></td><td><button id="removeCategory_' + categCount + '" class="removeCategory">Rimuovi</button></td></tr>';
            var newTr = $(str);
            $('#categoriesTable tbody').append(newTr);
            $('.category', newTr).focus().autocomplete(categ_autocomplete_opt);
        });

        $('#categoriesTable').on('click', '.removeCategory', function(event) {
            event.preventDefault();
            $(this).parent().parent('tr').remove();
        });

        $('.category').autocomplete(categ_autocomplete_opt);
    };

    return {
        init : init,
        debug : function() { debugger; }
    }

})();

$(function() {
    CR.RecipeStore.init();
});