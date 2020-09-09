(function($) {
    "use strict";

    var blogMasonryGallery = {};
    edgtf.modules.blogMasonryGallery = blogMasonryGallery;

    blogMasonryGallery.edgtfOnDocumentReady = edgtfOnDocumentReady;
    blogMasonryGallery.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitBlogMasonryGalleryAppearLoadMore();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogMasonryGalleryAppear();
    }

    /**
     *  Animate blog masonry gallery type
     */
    function edgtfInitBlogMasonryGalleryAppear() {
        var blogList = $('.edgtf-blog-holder.edgtf-blog-masonry-gallery');
        
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgtf-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
	
                    if(thisArticle.hasClass('edgtf-twitter-post-format') && thisBlogList.find('article.format-standard.edgtf-masonry-size-default').length) {
	                    thisArticle.css({'height': thisBlogList.find('article.format-standard.edgtf-masonry-size-default').height()});
                    }
                    
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            
                            if(animateCycleCounter === animateCycle) {
                                animateCycleCounter = 0;
                            }
                            
                            setTimeout(function(){
                                thisArticle.addClass('edgtf-appeared');
                            },animateCycleCounter * 150);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('edgtf-appeared');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }
    }

    function edgtfInitBlogMasonryGalleryAppearLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            edgtfInitBlogMasonryGalleryAppear();
        });
    }

})(jQuery);