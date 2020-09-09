(function ($) {
	window.edgtfDependencyAdmin = {};
	
	edgtfDependencyAdmin.edgtfReInitOptionsDependency = edgtfReInitOptionsDependency;
	
	$(document).ready(function () {
		edgtfInitOptionsDependency().init();
		edgtfInitSelectChange();
		edgtfInitIconSelectChange();
		edgtfInitRadioChange();
	});
	
	function edgtfReInitOptionsDependency() {
		edgtfInitOptionsDependency().init(true);
	}
	
	var edgtfInitOptionsDependency = function () {
		
		function getNumberOfItems(items) {
			var numberOfItems = 0;
			
			for (var item in items) {
				if (items.hasOwnProperty(item)) {
					++numberOfItems;
				}
			}
			
			return numberOfItems;
		}
		
		function multipleDependencyLogic(items, optionHolder, optionName, optionValue, dependencyType) {
			var flag = [],
				itemVisibility = true;
			
			$.each(items, function (key, value) {
				value = value.split(',');
				
				if (optionName === key) {
					if (value.indexOf(optionValue) !== -1) {
						flag.push(true);
					} else {
						flag.push(false);
					}
				} else {
					var otherOptionType = $('.edgtf-dependency-option[data-option-name="' + key + '"]').data('option-type');
					switch (otherOptionType) {
						case 'checkbox':
							var otherValue = $('.edgtf-dependency-option[data-option-name="' + key + '"]').find('input[type="hidden"][name="' + key + '"]').val();
							break;
						case 'selectbox':
							var otherValue = $('.edgtf-dependency-option[data-option-name="' + key + '"]').val();
							break;
					}
					
					if (value.indexOf(otherValue) !== -1) {
						flag.push(true);
					} else {
						flag.push(false);
					}
				}
			});
			
			for (var f in flag) {
				if (!flag[f]) itemVisibility = false;
			}
			
			if (dependencyType === 'show') {
				
				if (itemVisibility) {
					optionHolder.fadeIn(200);
				} else {
					optionHolder.fadeOut(200);
				}
			} else {
				
				if (itemVisibility) {
					optionHolder.fadeOut(200);
				} else {
					optionHolder.fadeIn(200);
				}
			}
		}
		
		function singleDependencyLogic(items, optionHolder, optionName, optionValue, dependencyType) {
			$.each(items, function (key, value) {
				if (optionName === key) {
					value = value.split(',');
					
					if (dependencyType === 'show') {
						if (value.indexOf(optionValue) !== -1) {
							optionHolder.fadeIn(200);
						} else {
							optionHolder.fadeOut(200);
						}
					} else {
						if (value.indexOf(optionValue) !== -1) {
							optionHolder.fadeOut(200);
						} else {
							optionHolder.fadeIn(200);
						}
					}
				}
			});
		}
		
		function mainLogic(thisItem, optionValue) {
			var dependencyHolder = $('.edgtf-dependency-holder'),
				optionName = thisItem.data('option-name');
			
			if (dependencyHolder.length && optionName !== undefined && optionName !== '' && optionValue !== undefined) {
				dependencyHolder.each(function () {
					var thisHolder = $(this),
						showDataItems = thisHolder.data('show'),
						hideDataItems = thisHolder.data('hide');
					
					if (showDataItems !== '' && showDataItems !== undefined) {
						if (getNumberOfItems(showDataItems) > 1) {
							multipleDependencyLogic(showDataItems, thisHolder, optionName, optionValue, 'show');
						} else {
							singleDependencyLogic(showDataItems, thisHolder, optionName, optionValue, 'show');
						}
					}
					
					if (hideDataItems !== '' && hideDataItems !== undefined) {
						if (getNumberOfItems(hideDataItems) > 1) {
							multipleDependencyLogic(hideDataItems, thisHolder, optionName, optionValue, 'hide');
						} else {
							singleDependencyLogic(hideDataItems, thisHolder, optionName, optionValue, 'hide');
						}
					}
				});
			}
		}
		
		function checkBox(thisItem, repeater) {
			var cbItem = thisItem.find('.cb-enable, .cb-disable');
			
			if (repeater) {
				var repeaterOptionValue = thisItem.find('.selected').data('value');
				
				if (thisItem.parents('.edgtf-repeater-fields-holder').length && repeaterOptionValue !== undefined) {
					mainLogic(thisItem, repeaterOptionValue);
				}
			}
			
			cbItem.on('click', function (e) {
				var optionValue = $(this).data('value');
				mainLogic(thisItem, optionValue);
			});
		}
		
		function selectBox(thisItem, repeater) {
			if (repeater && thisItem.parents('.edgtf-repeater-fields-holder').length) {
				mainLogic(thisItem, thisItem.val());
			}
			
			thisItem.on('change', function () {
				var optionValue = $(this).val();
				mainLogic(thisItem, optionValue);
			});
		}
		
		function radioGroup(thisItem, repeater) {
			var optionName = thisItem.data('option-name'),
				radioItem = thisItem.find('input[name=' + optionName + ']');
			
			if (repeater && thisItem.parents('.edgtf-repeater-fields-holder').length) {
				mainLogic(thisItem, radioItem.value);
			}
			
			radioItem.on('change', function () {
				var optionValue = this.value;
				mainLogic(thisItem, optionValue);
			});
		}
		
		return {
			init: function (repeater) {
				var dependencyOption = $('.edgtf-section-content .edgtf-field[data-option-name]');
				
				if (dependencyOption.length) {
					dependencyOption.each(function () {
						var thisOptions = $(this),
							thisOptionsType = thisOptions.data('option-type');
						
						thisOptions.addClass('edgtf-dependency-option');
						
						switch (thisOptionsType) {
							case 'checkbox':
								checkBox(thisOptions, repeater);
								break;
							case 'selectbox':
								selectBox(thisOptions, repeater);
								break;
							case 'radiogroup':
								radioGroup(thisOptions, repeater);
								break;
						}
					});
				}
			}
		};
	};
	
	function edgtfInitSelectChange() {
		$(document).on('change', 'select.dependence', function (e) {
			var thisItem = $(this),
				valueSelected = this.value.replace(/ /g, '');
			
			$(thisItem.data('hide-' + valueSelected)).fadeOut();
			$(thisItem.data('show-' + valueSelected)).fadeIn();
		});
	}

    function edgtfInitIconSelectChange() {
        $(document).on('change', 'select.icon-dependence', function (e) {
            var valueSelected = this.value.replace(/ /g, ''),
            	parentSection = $(this).parents('.edgtf-section-content');

            parentSection.find('.row.edgtf-icon-collection-holder').fadeOut();
            parentSection.find('.row.edgtf-icon-collection-holder[data-icon-collection="' + valueSelected + '"]').fadeIn();
        });
    }
	
	function edgtfInitRadioChange() {
		$(document).on('change', 'input[type="radio"].dependence', function () {
			var thisItem = $(this),
				dataHide = thisItem.data('hide'),
				dataShow = thisItem.data('show');
			
			if (typeof(dataHide) !== 'undefined' && dataHide !== '') {
				var elementsToHide = dataHide.split(',');
				
				$.each(elementsToHide, function (index, value) {
					$(value).fadeOut();
				});
			}
			
			if (typeof(dataShow) !== 'undefined' && dataShow !== '') {
				var elementsToShow = dataShow.split(',');
				
				$.each(elementsToShow, function (index, value) {
					$(value).fadeIn();
				});
			}
		});
	}
	
})(jQuery);