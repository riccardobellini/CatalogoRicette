var CR = CR || {};

CR.RecipeList = (function() {

    var _isSearching = false;

    function _setupHandlers() {
        $('#recNameFilter').on('keyup', function(event) {
            clearTimeout($.data(this, 'timer'));
            if (event.keyCode === 13) {
                // enter was pressed, start search immediately
                _doSearch();
            } else {
                $(this).data('timer', setTimeout(_doSearch, 500));
            }
        });
    };

    function _doSearch() {
        var str = $('#recNameFilter').val().trim();
        if (!_isSearching && (str.length > 2 || str.length == 0)) {
            _isSearching = true;
            console.log('Searching for: ' + str);
            $.get('search.php', {
                do : 'search',
                title : str
            })
            .done(function(data) {
                $('#recipeListContainer').html(data);
            })
            .always(function() {
                _isSearching = false;
            });
        }
    };

    function _remove(recId) {
        console.log('Removing recipe ' + recId);
    }

    return {
        init : function() {
            _setupHandlers();
        },
        remove : function(recId) {
            _remove(recId);
        }
    }

})();


$(function() {
    CR.RecipeList.init();
});