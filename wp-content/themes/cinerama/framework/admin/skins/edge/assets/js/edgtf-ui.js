(function($){

	"use strict";

	window.edgtfAdmin = {};
	edgtfAdmin.framework = {};
	
	$(document).ready(function() {
		//plugins init goes here


		if ($('.edgtf-page-form').length > 0) {
            edgtfFixHeaderAndTitle();
            initTopAnchorHolderSize();
            edgtfScrollToAnchorSelect();
            edgtfChangedInput();
		}
    });

	function edgtfFixHeaderAndTitle () {
		var pageHeader 				= $('.edgtf-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
		var pageTitle				= $('.edgtf-page-title');
		var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
		var tabsNavWrapper			= $('.edgtf-tabs-navigation-wrapper');
		var tabsNavWrapperTop		= pageHeaderHeight;
		var tabsContentWrapper	    = $('.edgtf-tab-content');
		var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();

		$(window).on('scroll load', function() {
			if($(window).scrollTop() >= pageHeaderTopPosition) {
				pageHeader.addClass('edgtf-header-fixed').css('top', parseInt(adminBarHeight));
				pageTitle.addClass('edgtf-page-title-fixed').css('top', pageTitleTopPosition);
				tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
				tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
			} else {
				pageHeader.removeClass('edgtf-header-fixed').css('top', 0);
				pageTitle.removeClass('edgtf-page-title-fixed').css('top', 0);
				tabsNavWrapper.css('marginTop', 0);
				tabsContentWrapper.css('marginTop', 0);
			}
		});
	}
	
	function initTopAnchorHolderSize() {
		function initTopSize() {
			var optionsPageHolder = $('.edgtf-options-page'),
				anchorAndSaveHolder = $('.edgtf-top-section-holder'),
				pageTitle = $('.edgtf-page-title'),
				tabsContentWrapper = $('.edgtf-tabs-content');
			
			anchorAndSaveHolder.css('width', optionsPageHolder.width() - parseInt(anchorAndSaveHolder.css('margin-left')));
			pageTitle.css('width', tabsContentWrapper.outerWidth());
		}
		
		initTopSize();
		
		$(window).on('resize', function () {
			initTopSize();
		});
	}
	
	function edgtfScrollToAnchorSelect() {
		var selectAnchor = $('#edgtf-select-anchor');
		
		selectAnchor.on('change', function () {
			var selectAnchor = $('option:selected', selectAnchor);
			
			if (typeof selectAnchor.data('anchor') !== 'undefined') {
				edgtfScrollToPanel(selectAnchor.data('anchor'));
			}
		});
	}

    function edgtfScrollToPanel(panel) {
        var pageHeader = $('.edgtf-page-header'),
            pageHeaderHeight = pageHeader.height(),
            adminBarHeight = $('#wpadminbar').height(),
            pageTitle = $('.edgtf-page-title'),
            pageTitleHeight = pageTitle.outerHeight();

        var panelTopPosition = $(panel).offset().top - adminBarHeight - pageHeaderHeight - pageTitleHeight;

        $('html, body').animate({
            scrollTop: panelTopPosition
        }, 1000);

        return false;
    }
	
	function edgtfChangedInput() {
		$('.edgtf-tabs-content form.edgtf_ajax_form:not(.edgtf-import-page-holder):not(.edgtf-backup-options-page-holder)').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
			$('.edgtf-input-change').addClass('yes');
		});
		
		$('.edgtf-tabs-content form.edgtf_ajax_form:not(.edgtf-import-page-holder):not(.edgtf-backup-options-page-holder) .field.switch label:not(.selected)').on('click', function () {
			$('.edgtf-input-change').addClass('yes');
		});
		
		$('.edgtf-tabs-content form.edgtf_ajax_form:not(.edgtf-import-page-holder):not(.edgtf-backup-options-page-holder) #anchornav input').on('click', function () {
			var inputChange = $('.edgtf-input-change.yes'),
				changesSave = $('.edgtf-changes-saved');
			
			if (inputChange.length) {
				inputChange.removeClass('yes');
			}
			
			changesSave.addClass('yes');
			setTimeout(function () {
				changesSave.removeClass('yes');
			}, 3000);
		});
		
		$(window).on('beforeunload', function () {
			if ($('.edgtf-input-change.yes').length) {
				return 'You haven\'t saved your changes.';
			}
		});
	}

})(jQuery);