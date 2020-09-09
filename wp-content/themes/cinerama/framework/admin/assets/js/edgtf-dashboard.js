(function ($) {
    "use strict";

    var dashboard = {};

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfDashboardInitDatePicker();
        edgtfDashboardUploadImages();
        edgtfDashboardInitGeocomplete();
        edgtfDashboardRemoveMedia();
        edgtfDashboardSelect2();
        edgtfInitColorpicker();
        //edgtfDashboardRepeater();
        edgtfInitIconSelectChange();
 	    edgtfDashboardRepeater.rowRepeater.init();
 	    edgtfDashboardRepeater.rowInnerRepeater.init();
	    edgtfDashboardInitSortable();
    }

    /**
     * All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function edgtfOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function edgtfOnWindowScroll() {
    }

	function edgtfDashboardInitDatePicker() {
		$( ".edgtf-dashboard-input.datepicker" ).datepicker( { dateFormat: "MM dd, yy" });
	}

	function edgtfInitColorpicker() {
		$('.edgtf-dashboard-color-field').wpColorPicker();
	}

    function edgtfInitIconSelectChange() {
        $(document).on('change', 'select.icon-dependence', function (e) {
            var valueSelected = this.value.replace(/ /g, ''),
            	parentSection = $(this).parents('.edgtf-dashboard-icon-holder');

            parentSection.find('.edgtf-icon-collection-holder').fadeOut();
            parentSection.find('.edgtf-icon-collection-holder[data-icon-collection="' + valueSelected + '"]').fadeIn();
        });
    }

	var edgtfDashboardRepeater = function() {
		var repeaterHolder = $('.edgtf-dashboard-repeater-wrapper'),
			numberOfRows;

		var rowRepeater = function() {

			var addNewRow = function(holder) {
				var $addButton = holder.find('.edgtf-dashboard-repeater-add a');
				var templateName = holder.find('.edgtf-dashboard-repeater-wrapper-inner').data('template');
				var $repeaterContent = holder.find('.edgtf-dashboard-repeater-wrapper-inner');
				var repeaterTemplate = wp.template('edgtf-dashboard-repeater-template-' + templateName);

				$addButton.on('click', function(e) {
					e.preventDefault();
					e.stopPropagation();

					var $row = $(repeaterTemplate({
						rowIndex: getLastRowIndex(holder) || 0
					}));

					$repeaterContent.append($row);
					var new_holder = $row.find('.edgtf-dashboard-repeater-inner-wrapper');
					edgtfDashboardRepeater.rowInnerRepeater.addNewRowInner(new_holder);
					edgtfDashboardRepeater.rowInnerRepeater.removeRowInner(new_holder);
					edgtfDashboardInitSortable();
					edgtfDashboardInitDatePicker();
					edgtfDashboardUploadImages();
					edgtfDashboardRemoveMedia();
					edgtfDashboardSelect2();
					edgtfInitColorpicker();
					edgtfInitIconSelectChange();
					numberOfRows += 1;       

				});
			};

			var removeRow = function(holder) {

				var repeaterContent = holder.find('.edgtf-dashboard-repeater-wrapper-inner');
				repeaterContent.on('click', '.edgtf-clone-remove', function(e) {
					e.preventDefault();
					e.stopPropagation();

					if(!window.confirm('Are you sure you want to remove this section?')) {
						return;
					}

					var $rowParent = $(this).parents('.edgtf-dashboard-repeater-fields-holder');
					$rowParent.remove();

					decrementNumberOfRows();

				});
			};

			var getLastRowIndex = function(holder) {
				var $repeaterContent = holder.find('.edgtf-dashboard-repeater-wrapper-inner');
				var fieldsCount = $repeaterContent.find('.edgtf-dashboard-repeater-fields-holder').length;

				return fieldsCount;
			};

			var decrementNumberOfRows = function() {
				if(numberOfRows <= 0) {
					return;
				}

				numberOfRows -= 1;
			}
			var setNumberOfRows = function(holder) {
				numberOfRows =  holder.find('.edgtf-dashboard-repeater-fields-holder').length;

			}
			var getNumberOfRows = function() {
				return numberOfRows;
			}

			return {
				init: function() {
					var repeaterHolder = $('.edgtf-dashboard-repeater-wrapper');

					repeaterHolder.each(function(){
						setNumberOfRows($(this));
						addNewRow($(this));
						removeRow($(this));
					});
				},
				numberOfRows: getNumberOfRows
			}
		}();

		var rowInnerRepeater = function() {
			var repeaterInnerHolder = $('.edgtf-dashboard-repeater-inner-wrapper');


			var addNewRowInner = function(holder) {

				//var repeaterInnerContent = holder.find('.edgtf-dashboard-repeater-inner-wrapper-inner');
				var templateInnerName = holder.find('.edgtf-dashboard-repeater-inner-wrapper-inner').data('template');
				var rowInnerTemplate = wp.template('edgtf-dashboard-repeater-inner-template-' + templateInnerName);
				holder.on('click', '.edgtf-inner-clone', function(e) {

					e.preventDefault();
					e.stopPropagation();

					var $clickedButton = $(this);
					var $parentRow = $clickedButton.parents('.edgtf-dashboard-repeater-fields-holder').first();

					var parentIndex = $parentRow.data('index');

					var $rowInnerContent = $clickedButton.parent().prev();

					var lastRowInnerIndex = $parentRow.find('.edgtf-dashboard-repeater-inner-fields-holder').length;

					var $repeaterInnerRow = $(rowInnerTemplate({
						rowIndex: parentIndex,
						rowInnerIndex: lastRowInnerIndex
					}));

					$rowInnerContent.append($repeaterInnerRow);
					edgtfTinyMCE($repeaterInnerRow, lastRowInnerIndex);
				});
			};

			var removeRowInner = function(holder) {
				var repeaterInnerContent = holder.find('.edgtf-dashboard-repeater-inner-wrapper-inner');
				repeaterInnerContent.on('click', '.edgtf-clone-inner-remove', function(e) {
					e.preventDefault();
					e.stopPropagation();

					if(!confirm('Are you sure you want to remove section?')) {
						return;
					}

					var $removeButton = $(this);
					var $parent = $removeButton.parents('.edgtf-dashboard-repeater-inner-fields-holder');

					$parent.remove();
				});
			};

			return {
				init: function() {
					var repeaterInnerHolder = $('.edgtf-dashboard-repeater-inner-wrapper');
					repeaterInnerHolder.each(function(){
						addNewRowInner($(this));
						removeRowInner($(this));
					});

				},
				addNewRowInner:addNewRowInner,
				removeRowInner:removeRowInner
			}
		}();

		return {
			rowRepeater: rowRepeater,
			rowInnerRepeater: rowInnerRepeater
		}
	}();

	function edgtfDashboardInitSortable() {
		$('.edgtf-dashboard-repeater-wrapper-inner.sortable').sortable();
		$('.edgtf-dashboard-repeater-inner-wrapper-inner.sortable').sortable();
	}


    // function edgtfDashboardRepeater(){
    //     var wrapper = $('.edgtf-dashboard-repeater-wrapper');

    //     function initCloneRow(wrapper, button) {
    //         var fieldsHolder = wrapper.find('> .edgtf-dashboard-repeater-fields-holder');
    //         var parentChildRepeater = !!fieldsHolder.hasClass('edgtf-enable-pc');
    //         var rows;
    //         if(fieldsHolder.hasClass('edgtf-table-layout')) {
    //              rows = fieldsHolder.find('tbody tr.edgtf-dashboard-repeater-fields-row');
    //         } else {
    //             if(parentChildRepeater) {
    //                 var name = button.data("name");
    //                 rows = fieldsHolder.find('> .edgtf-dashboard-repeater-fields-row[data-name=' + name + ']');
    //             } else {
    //                 rows = fieldsHolder.find('> .edgtf-dashboard-repeater-fields-row');
    //             }
    //         }
    //         var append = true; // flag for showing or appending new row
    //         if (rows.length == 1 && rows.css('display') == 'none') {
    //             rows.show();
    //             append = false;
    //         }
    //         if (append) {
    //             var child = rows.eq(0);
    //             //FIND FIRST ELEMENT AND DESTROY INITIALIZED SCRIPTS
    //             child.find('.edgtf-dashboard-repeater-field').each(function () {
    //                 var thisField = $(this);
    //                 thisField.find('select').each(function () {
    //                     var thisInput = $(this);
    //                     if(thisInput.hasClass('edgtf-select2')) {
    //                         $('select.edgtf-select2').select2("destroy");
    //                     }
    //                 });
    //             });

    //             var rowIndex = button.data('count'); // number of rows for changing id stored as data of add new button
    //             var firstChild = rows.eq(0).clone(); // clone first row
    //             var colorPicker = false; // flag for initializing color picker - calling wpColorPicker
    //             var mediaUploader = false; // flag for initializing media uploader - calling mediaUploader
    //             var yesNoSwitcher = false; // flag for initializing yes no switcher - calling initSwitch
    //             var select2 = false; // flag for initializing select2 - calling select2
    //             var innerRepeater = false; // flag for initializing select2 - calling select2

    //             firstChild.find('.edgtf-dashboard-repeater-field').each(function () {
    //                     var thisField = $(this);
    //                     var id = thisField.attr('id');
    //                     if (typeof id !== 'undefined') {
    //                         thisField.attr('id', id.slice(0, -1) + rowIndex); // change id - first row will have 0 as the last char
    //                     }
    //                     thisField.find(':input, textarea').each(function () {
    //                         var thisInput = $(this);
    //                         if (thisInput.hasClass('edgtf-dashboard-gallery-upload-hidden')) {// if input type is media uploader
    //                             mediaUploader = true;
    //                             var btn = thisInput.siblings('.edgtf-dashboard-gallery-upload');
    //                             edgtfInitMediaRemoveBtn(btn); // get and init new remove btn
    //                         }
    //                         else if(thisInput.hasClass('checkbox')) {
    //                             yesNoSwitcher = true;
    //                         }
    //                         thisInput.val('').removeAttr('checked').removeAttr('selected'); //empty fields values
    //                         if(thisInput.is(':radio')){
    //                             thisInput.val(fieldsHolder.find(':radio').length);
    //                         }
    //                     });
    //                     thisField.find('select').each(function () {
    //                         var thisInput = $(this);
    //                         if(thisInput.hasClass('edgtf-select2')) {
    //                             select2 = true;
    //                         }
    //                     });
    //                 }
    //             );
    //             rows.each(function () {
    //                 if($(this).find('.edgtf-dashboard-repeater-wrapper').length) {
    //                     innerRepeater = true;
    //                 }
    //             });
    //             button.data('count', rowIndex + 1); //increase number of rows
    //             firstChild.appendTo(fieldsHolder); // append html
    //             initCoreRepeater(firstChild.find('.edgtf-dashboard-repeater-wrapper'));
    //             initRemoveRow(firstChild);
    //             if (colorPicker) { // reinit colorpickers
    //                 $('.edgtf-page .my-color-field').wpColorPicker();
    //             }
    //             if (mediaUploader) {
    //                 // deregister click on all media buttons (multiple frames will be opened otherwise)
    //                 $('.edgtf-media-uploader').off('click', '.edgtf-media-upload-btn');
    //                 edgtfDashboardUploadImages();
    //                 edgtfDashboardRemoveMedia();
    //             }
    //             if (yesNoSwitcher) {
    //                 edgtfInitSwitch(); //init yes no switchers
    //             }
    //             if (select2) {
    //                 edgtfSelect2(); //init select2 script
    //             }
    //         }

    //         function edgtfInitMediaRemoveBtn(btn) {
    //         	var imagesHolder = btn.parents('.edgtf-dashboard-gallery-holder').find('.edgtf-dashboard-gallery-images-holder'),
    //         		removeButton = btn.siblings('.edgtf-dashboard-remove-image');

    //         	btn.removeClass("edgtf-binded");
    //         	removeButton.removeClass("edgtf-binded");

    //             //remove image src
    //             imagesHolder.empty();

    //             //reset meta fields
    //             btn.siblings('.edgtf-dashboard-gallery-upload-hidden').each(function(e) {
    //                 $(this).val('');
    //             });
    //         }
    //     }
    // }

    function edgtfDashboardInitGeocomplete() {
        var geo_inputs = $(".edgtf-dashboard-address-field");

        if(geo_inputs.length && !edgtf.body.hasClass('edgtf-empty-google-api')) {
            geo_inputs.each(function () {
                var geo_input = $(this),
                    reset = geo_input.find("#reset"),
                    inputField = geo_input.find('input'),
                    mapField = geo_input.find('.map_canvas'),
                    countryLimit = geo_input.data('country'),
                    latFieldName = geo_input.data('lat-field'),
                    latField = $("input[name=" + latFieldName + "]"),
                    longFieldName = geo_input.data('long-field'),
                    longField =  $("input[name=" + longFieldName + "]"),
                    initialAddress = inputField.val(),
                    initialLat = latField.val(),
                    initialLong = longField.val();

                latField.attr('data-geo','lat');
                longField.attr('data-geo','lng');

                inputField.geocomplete({
                    map: mapField,
                    details: ".edgtf-dashboard-address-elements",
                    detailsAttribute: "data-geo",
                    types: ["geocode", "establishment"],
                    country: countryLimit,
                    markerOptions: {
                        draggable: true
                    }
                });

                inputField.on('bind', "geocode:dragged", function (event, latLng) {
                    latField.val(latLng.lat());
                    longField.val(latLng.lng());
                    $("#reset").show();
                    var map = inputField.geocomplete("map");
                    map.panTo(latLng);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'latLng': latLng}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                var road = results[0].address_components[1].short_name;
                                var town = results[0].address_components[2].short_name;
                                var county = results[0].address_components[3].short_name;
                                var country = results[0].address_components[4].short_name;
                                inputField.val(road + ' ' + town + ' ' + county + ' ' + country);
                            }
                        }
                    });
                });

                inputField.on('focus',function(){
                    var map = inputField.geocomplete("map");
                    google.maps.event.trigger(map, 'resize')
                });
                reset.on("click",function () {
                    inputField.geocomplete("resetMarker");
                    inputField.val(initialAddress);
                    latField.val(initialLat);
                    longField.val(initialLong);
                    $("#reset").hide();
                    return false;
                });

                $(window).on("load",function () {
                    inputField.trigger("geocode");
                })
            });
        }
    }

    function edgtfDashboardUploadImages(){
    	var galleries = $('.edgtf-dashboard-gallery-uploader');

    	if (galleries.length){
    		galleries.each(function(){
    			var thisGallery = $(this),
    				inputButton = thisGallery.find('.edgtf-dashboard-gallery-upload-hidden'),
    				uploadButton = thisGallery.find('.edgtf-dashboard-gallery-upload'),
    				thisGalleryImageHolder = thisGallery.parents('.edgtf-dashboard-gallery-holder').find('.edgtf-dashboard-gallery-images-holder');

    			if (!uploadButton.hasClass("edgtf-binded")) {

					inputButton.on("change", function(e){
						var filesNumber = e.target.files.length;

						thisGalleryImageHolder.empty();

						for (var i = 0, file; file = e.target.files[i] ; i++) {

							var reader = new FileReader();

							// Closure to capture the file information.
							reader.onload = (function(theFile) {
								return function(e) {
									if ($.inArray(theFile.type, ["image/gif", "image/jpeg", "image/png"]) !== -1) {
										thisGalleryImageHolder.append('<li class="edgtf-dashboard-gallery-image"><img src="' + e.target.result + '" title="' + escape(theFile.name) + '"/></li>');
									} else {
										thisGalleryImageHolder.append('<li class="edgtf-dashboard-gallery-image"><span class="edgtf-dashboard-input-text">' + escape(theFile.name) + '</span></li>');
									}
								};
							})(file);

							// Read in the image file as a data URL.
							reader.readAsDataURL(file);
						};
					});

					uploadButton.on("click", function(e){
						e.preventDefault();

						inputButton.trigger("click");
					});
					uploadButton.addClass("edgtf-binded");
				}

    		});
    	}
    }

    function edgtfDashboardRemoveMedia(){
    	var removeMediaBttns = $('.edgtf-dashboard-remove-image');

    	if (removeMediaBttns.length){
    		removeMediaBttns.each(function(){
    			var thisRemoveMedia = $(this),
    				removeImagesHolder = thisRemoveMedia.parents('.edgtf-dashboard-gallery-holder').find('.edgtf-dashboard-gallery-images-holder'),
    				inputHiddenValue = thisRemoveMedia.siblings('.edgtf-dashboard-media-hidden');


    			if (!thisRemoveMedia.hasClass("edgtf-binded")) {
					thisRemoveMedia.on("click", function(e){
						e.preventDefault();

						inputHiddenValue.val('');

						removeImagesHolder.empty();

					});

					thisRemoveMedia.addClass("edgtf-binded");
				}
    		});
    	}
    }


	function edgtfDashboardSelect2() {
		if ($('select.edgtf-select2').length) {
			$('select.edgtf-select2').select2({
                allowClear: true
            });
		}
	}

})(jQuery);