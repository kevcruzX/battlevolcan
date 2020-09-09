(function($) {
    "use strict";

    var searchSlideFromWT = {};
    edgtf.modules.searchSlideFromWT = searchSlideFromWT;

    searchSlideFromWT.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSearchSlideFromWT();
    }
	
	/**
	 * Init Search Types
	 */
	function edgtfSearchSlideFromWT() {
        if ( edgtf.body.hasClass( 'edgtf-search-slides-from-window-top' ) ) {

            var searchOpener = $('a.edgtf-search-opener');

            if ( searchOpener.length > 0 ) {

                var searchForm = $('.edgtf-search-slide-window-top'),
                    searchClose = $('.edgtf-search-close');

                searchOpener.on('click', function(e) {
                    e.preventDefault();

                    if ( searchForm.height() === 0) {
                        $('.edgtf-search-slide-window-top input[type="text"]').focus();
                        //Push header bottom
                        edgtf.body.addClass('edgtf-search-open');
                    } else {
                        edgtf.body.removeClass('edgtf-search-open');
                    }

                    $(window).scroll(function() {
                        if ( searchForm.height() !== 0 && edgtf.scroll > 50 ) {
                            edgtf.body.removeClass('edgtf-search-open');
                        }
                    });

                    searchClose.on('click', function(e){
                        e.preventDefault();
                        edgtf.body.removeClass('edgtf-search-open');
                    });
                });
            }
		}
	}

})(jQuery);
