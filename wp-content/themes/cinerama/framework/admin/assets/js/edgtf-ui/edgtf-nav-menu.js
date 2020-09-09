(function($) {

	"use strict";
	
	$(document).ready(function() {
        edgtfUpdateIconOptions();
		edgtfInitAdditionalItemOptions();
	});

	/**
	 * Function that serializes additional menu item options in a single field.
	 */
	function edgtfInitAdditionalItemOptions() {
		var navForm = $('#update-nav-menu');

		navForm.on('change', '[data-item-option]', function() {
			edgtfGenerateSerializedString();
		});
	}

	function edgtfGenerateSerializedString() {
		var dataArrayString = '',
			navForm = $('#update-nav-menu'),
			menuItemsData = navForm.find("[data-name]");
		
		menuItemsData.each(function() {
			var thisItem = $(this),
				attributeName = thisItem.data('name'),
				attributeVal  = thisItem.val();

			if(attributeVal !== '') {
				//check if current field is checkbox
				if(thisItem.is('input[type="checkbox"]')) {
					//append it to serialized string only if it's checked
					if(thisItem.is(':checked')) {
						dataArrayString += attributeName+"="+attributeVal+'&';
					}
				} else {
					dataArrayString += attributeName+"="+attributeVal+'&';
				}
			}
		});

		//remove last & character
		dataArrayString = dataArrayString.substr(0, dataArrayString.length - 1);

		var menuOptions = $('input[name="edgtf_menu_options"]');
		if(menuOptions.length) {
			menuOptions.val(encodeURIComponent(dataArrayString));
		} else {
			//generate hidden input field html with serialized string value
			var hiddenMenuItem = '<input type="hidden" name="edgtf_menu_options" value="'+encodeURIComponent(dataArrayString)+'">';

			//append hidden options field to navigation form
			navForm.append(hiddenMenuItem);
		}
	}

    /**
     * Function that loads icon options via AJAX based on icon pack option
     */
    function edgtfUpdateIconOptions() {
        var navForm = $('#update-nav-menu');

        navForm.on('change', '[data-icon-pack]', function() {
	        var thisItem = $(this),
		        chosenIconPack = thisItem.find('option:selected').val(),
		        iconDropdown = thisItem.parents('p').first().next('.edgtf-icon-select-holder').find('select'),
		        spinner = thisItem.parents('li.menu-item').first().find('.spinner');
	
	        var data = {
		        action: 'update_admin_nav_icon_options',
		        icon_pack: chosenIconPack,
				update_nav_menu_nonce: $('#update-nav-menu').find('#update-nav-menu-nonce').val()
	        };

            spinner.show();
            iconDropdown.attr('disabled', 'disabled');

            $.post(ajaxurl, data, function(data){
                iconDropdown.html(data);
                spinner.hide();
                iconDropdown.removeAttr('disabled');
            });
        });
    }
})(jQuery);