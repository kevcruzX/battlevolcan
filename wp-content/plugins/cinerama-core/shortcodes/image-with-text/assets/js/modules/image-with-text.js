(function($) {
	'use strict';
	
	var imageWithText = {};
	edgtf.modules.imageWithText = imageWithText;
	
	imageWithText.edgtfInitImageWithText = edgtfInitImageWithText;
	
	imageWithText.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitImageWithText();
	}
	
	/**
	 * Init Interactive Image With Text
	 */
	function edgtfInitImageWithText() {
		var holder = $('.edgtf-image-with-text-holder.edgtf-iwt-animation');
		
		if (holder.length) {
			holder.each(function() {
				var thisHolder = $(this);
				
				thisHolder.appear(function() {
					thisHolder.addClass('edgtf-iwt-appear');
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);