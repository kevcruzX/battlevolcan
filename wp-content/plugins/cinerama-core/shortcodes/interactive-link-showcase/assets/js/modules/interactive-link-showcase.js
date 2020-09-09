(function($) {
    'use strict';

    var interactiveLinkShowcase = {};
    edgtf.modules.interactiveLinkShowcase = interactiveLinkShowcase;

    interactiveLinkShowcase.edgtfInitInteractiveLinkShowcase = edgtfInitInteractiveLinkShowcase;
    interactiveLinkShowcase.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitInteractiveLinkShowcase();
    }

    /**
     * Init item showcase shortcode
     */
    function edgtfInitInteractiveLinkShowcase() {
        var interactiveLinkShowcase = $('.edgtf-ils-holder');
	
	    if (interactiveLinkShowcase.length) {
		    interactiveLinkShowcase.each(function(){
			    var thisInteractiveLinkShowcase = $(this),
				    singleImage = thisInteractiveLinkShowcase.find('.edgtf-ils-item-image'),
				    singleLink  = thisInteractiveLinkShowcase.find('.edgtf-ils-item-link');
			    
			    singleImage.eq(0).addClass('edgtf-active');
			    thisInteractiveLinkShowcase.find('.edgtf-ils-item-link[data-index="0"]').addClass('edgtf-active');
			
			    singleLink.on('touchstart mouseenter', function() {
				    var index = parseInt( $(this).data('index') );
				
				    singleImage.removeClass('edgtf-active').eq(index).addClass('edgtf-active');
				    singleLink.removeClass('edgtf-active');
				    thisInteractiveLinkShowcase.find('.edgtf-ils-item-link[data-index="'+index+'"]').addClass('edgtf-active');
			    });
		    });
	    }
    }

})(jQuery);