(function($) {
	'use strict';
	
	var interactiveImageWithText = {};
	edgtf.modules.interactiveImageWithText = interactiveImageWithText;
	
	interactiveImageWithText.edgtfInitInteractiveImageWithText = edgtfInitInteractiveImageWithText;
	
	interactiveImageWithText.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitInteractiveImageWithText();
	}
	
	/**
	 * Init Interactive Image With Text
	 */
	function edgtfInitInteractiveImageWithText() {
		var holder = $('.edgtf-interactive-image-with-text-holder.edgtf-iiwt-has-prefix.edgtf-iiwt-animation');
		
		if (holder.length) {
			holder.each(function() {
				var thisHolder = $(this);
				
				thisHolder.appear(function() {
					thisHolder.addClass('edgtf-iiwt-appear');
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);