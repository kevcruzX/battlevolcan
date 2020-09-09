(function($) {
	'use strict';
	
	var lightboxImageGallery = {};
	edgtf.modules.lightboxImageGallery = lightboxImageGallery;
	
	lightboxImageGallery.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitLightboxImageGalleryVideoPreview();
	}
	
	/*
	 **  Init lightbox image gallery preview video functionality
	 */
	function edgtfInitLightboxImageGalleryVideoPreview(){
		var holder = $('.edgtf-lig-holder .edgtf-lig-item.edgtf-has-video');
		
		if(holder.length && edgtf.windowWidth > 1024){
			holder.each(function(){
				var thisHolder  = $(this),
					video = thisHolder.find('video.edgtf-self-hosted-video');
				
				thisHolder.waitForImages(function(){
					thisHolder.on('mouseover', function(e){
						e.preventDefault();
						
						video.get(0).play();
					}).on('mouseleave', function(e){
						e.preventDefault();
						
						setTimeout(function(){
							video.get(0).pause();
							video.get(0).currentTime = 0;
						}, 200);
					});
				});
			});
		}
	}
	
})(jQuery);