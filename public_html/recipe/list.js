var CR = CR || {};

CR.RecipeList = (function() {

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
        if (str.length > 2) {
            console.log('Searching for: ' + str);
        }
    };

    return {
        init : function() {
            _setupHandlers();
        }
    }

})();


$(function() {
    CR.RecipeList.init();
});