(function($){

	"use strict";

	window.edgtfUIAdmin = {};
	
	edgtfUIAdmin.edgtfInitDatePicker = edgtfInitDatePicker;
	edgtfUIAdmin.edgtfSelect2 = edgtfSelect2;
	edgtfUIAdmin.edgtfInitSwitch = edgtfInitSwitch;
	edgtfUIAdmin.edgtfInitMediaUploader = edgtfInitMediaUploader;
	edgtfUIAdmin.edgtfInitColorpicker = edgtfInitColorpicker;
	
	$(document).ready(function () {
		edgtfInitTooltips();
		edgtfInitColorpicker();
		edgtfInitRangeSlider();
		edgtfInitMediaUploader();
		edgtfInitGalleryUploader();
        edgtfInitSelectSwitcherChange();
        edgtfInitSwitch();
        edgtfInitSaveCheckBoxesValue();
        edgtfCheckBoxMultiSelectInitState();
        edgtfInitCheckBoxMultiSelectChange();
        edgtfCheckVisibilityOfAnchorSelectOptions();
        edgtfCheckOptionAnchorsOnDependencyChange();
		
		if ($('.edgtf-page-form').length > 0) {
			edgtfInitAjaxForm();
			edgtfInitSelectPicker();
		}

		edgtfShowHidePostFormats();
		edgtfInitDatePicker();
		edgtfInitSortable();
		edgtfSelect2();
		edgtfInitGeocomplete();
		edgtfImportOptions();
		edgtfImportCustomSidebars();
		edgtfImportWidgets();
		edgtfInitImportContent();
	});

	$(window).load(function () {
		edgtfShowHidePostFormatsGutenberg();
	});
	
	function edgtfInitTooltips() {
		var holder = $('.edgtf-tooltip');
		
		if (holder.length) {
			holder.tooltip();
		}
	}
	
	function edgtfInitColorpicker() {
		var holder = $('.edgtf-page .my-color-field');
		
		if (holder.length) {
			holder.wpColorPicker({
				change: function (event, ui) {
					$('.edgtf-input-change').addClass('yes');
				}
			});
		}
	}
	
	function edgtfInitMediaUploaderAdded(addButton) {
		addButton.siblings('.edgtf-portfolio-media:last').find('.edgtf-media-uploader').each(function(){
			var thisItem = $(this),
				fileFrame,
				uploadUrl,
				uploadHeight,
				uploadWidth,
				uploadImageHolder,
				attachment,
				removeButton;
			
			//set variables values
			uploadUrl           = thisItem.find('.edgtf-media-upload-url');
			uploadHeight        = thisItem.find('.edgtf-media-upload-height');
			uploadWidth        = thisItem.find('.edgtf-media-upload-width');
			uploadImageHolder   = thisItem.find('.edgtf-media-image-holder');
			removeButton        = thisItem.find('.edgtf-media-remove-btn');
			
			if (uploadImageHolder.find('img').attr('src') !== '') {
				removeButton.show();
				edgtfInitMediaRemoveBtn(removeButton);
			}
			
			thisItem.on('click', '.edgtf-media-upload-btn', function() {
				//if the media frame already exists, reopen it.
				if (fileFrame) {
					fileFrame.open();
					return;
				}
				
				var clickedItem = $(this);
				
				//create the media frame
				fileFrame = wp.media.frames.fileFrame = wp.media({
					title: clickedItem.data('frame-title'),
					button: {
						text: clickedItem.data('frame-button-text')
					},
					multiple: false
				});
				
				//when an image is selected, run a callback
				fileFrame.on( 'select', function() {
					attachment = fileFrame.state().get('selection').first().toJSON();
					removeButton.show();
					edgtfInitMediaRemoveBtn(removeButton);
					
					//write to url field and img tag
					if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
						uploadUrl.val(attachment.url);
						
						if (attachment.sizes.thumbnail) {
							uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
						} else {
							uploadImageHolder.find('img').attr('src', attachment.url);
						}
						
						uploadImageHolder.show();
					} else if (attachment.hasOwnProperty('url')) {
						uploadUrl.val(attachment.url);
						uploadImageHolder.find('img').attr('src', attachment.url);
						uploadImageHolder.show();
					}
					
					//write to hidden meta fields
					if(attachment.hasOwnProperty('height')) {
						uploadHeight.val(attachment.height);
					}
					
					if(attachment.hasOwnProperty('width')) {
						uploadWidth.val(attachment.width);
					}
					
					$('.edgtf-input-change').addClass('yes');
				});
				
				//open media frame
				fileFrame.open();
			});
		});
		
		function edgtfInitMediaRemoveBtn(btn) {
			btn.on('click', function() {
				//remove image src and hide it's holder
				btn.siblings('.edgtf-media-image-holder').hide();
				btn.siblings('.edgtf-media-image-holder').find('img').attr('src', '');
				
				//reset meta fields
				btn.siblings('.edgtf-media-meta-fields').find('input[type="hidden"]').each(function(e) {
					$(this).val('');
				});
				
				btn.hide();
			});
		}
	}
	
	function edgtfInitDatePicker() {
		var holder = $('.edgtf-input.datepicker');
		
		if (holder.length) {
			holder.datepicker({dateFormat: "yy-mm-dd"});
		}
	}
	
	function edgtfInitSelectPicker() {
		var holder = $('.edgtf-selectpicker');
		
		if (holder.length) {
			holder.selectpicker();
		}
	}
	
	function edgtfInitRangeSlider() {
		var holder = $('.edgtf-slider-range');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					Link = $.noUiSlider.Link;
				
				var start = 0;            //starting position of slider
				var min = 0;            //minimal value
				var max = 100;          //maximal value of slider
				var step = 1;            //number of steps to snap to
				var orientation = 'horizontal';   //orientation. Could be vertical or horizontal
				var prefix = '';           //prefix to the serialized value that is written field
				var postfix = '';           //postfix to the serialized value that is written to field
				var thousand = '';           //separator for thousand
				var decimals = 2;            //number of decimals
				var mark = '.';          //decimal separator
				
				//is data-start attribute set for current instance?
				if (thisItem.data('start') !== null && thisItem.data('start') !== "" && thisItem.data('start') !== "0.00") {
					start = thisItem.data('start');
					if (start === "1.00") start = 1;
					
					if (parseInt(start) === start) {
						start = parseInt(start);
					}
				}
				
				//is data-min attribute set for current instance?
				if (thisItem.data('min') !== null && thisItem.data('min') !== "") {
					min = thisItem.data('min');
				}
				
				//is data-max attribute set for current instance?
				if (thisItem.data('max') !== null && thisItem.data('max') !== "") {
					max = thisItem.data('max');
				}
				
				//is data-step attribute set for current instance?
				if (thisItem.data('step') !== null && thisItem.data('step') !== "") {
					step = thisItem.data('step');
				}
				
				//is data-orientation attribute set for current instance?
				if (thisItem.data('orientation') !== null && thisItem.data('orientation') !== "") {
					//define available orientations
					var availableOrientations = ['horizontal', 'vertical'];
					
					//is data-orientation value in array of available orientations?
					if (availableOrientations.indexOf(thisItem.data('orientation'))) {
						orientation = thisItem.data('orientation');
					}
				}
				
				//is data-prefix attribute set for current instance?
				if (thisItem.data('prefix') !== null && thisItem.data('prefix') !== "") {
					prefix = thisItem.data('prefix');
				}
				
				//is data-postfix attribute set for current instance?
				if (thisItem.data('postfix') !== null && thisItem.data('postfix') !== "") {
					postfix = thisItem.data('postfix');
				}
				
				//is data-thousand attribute set for current instance?
				if (thisItem.data('thousand') !== null && thisItem.data('thousand') !== "") {
					thousand = thisItem.data('thousand');
				}
				
				//is data-decimals attribute set for current instance?
				if (thisItem.data('decimals') !== null && thisItem.data('decimals') !== "") {
					decimals = thisItem.data('decimals');
				}
				
				//is data-mark attribute set for current instance?
				if (thisItem.data('mark') !== null && thisItem.data('mark') !== "") {
					mark = thisItem.data('mark');
				}
				
				thisItem.noUiSlider({
					start: start,
					step: step,
					orientation: orientation,
					range: {
						'min': min,
						'max': max
					},
					serialization: {
						lower: [
							new Link({
								target: thisItem.prev('.edgtf-slider-range-value')
							})
						],
						format: {
							// Set formatting
							thousand: thousand,
							postfix: postfix,
							prefix: prefix,
							decimals: decimals,
							mark: mark
						}
					}
				}).on({
					change: function () {
						$('.edgtf-input-change').addClass('yes');
					}
				});
			});
		}
	}
	
	function edgtfInitMediaUploader() {
		var holder = $('.edgtf-media-uploader');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this);
				var fileFrame;
				var uploadUrl;
				var uploadHeight;
				var uploadWidth;
				var uploadImageHolder;
				var attachment;
				var removeButton;
				
				//set variables values
				uploadUrl = thisItem.find('.edgtf-media-upload-url');
				uploadHeight = thisItem.find('.edgtf-media-upload-height');
				uploadWidth = thisItem.find('.edgtf-media-upload-width');
				uploadImageHolder = thisItem.find('.edgtf-media-image-holder');
				removeButton = thisItem.find('.edgtf-media-remove-btn');
				
				if (uploadImageHolder.find('img').attr('src') !== "") {
					removeButton.show();
					edgtfInitMediaRemoveBtn(removeButton);
				}
				
				thisItem.on('click', '.edgtf-media-upload-btn', function () {
					//if the media frame already exists, reopen it.
					if (fileFrame) {
						fileFrame.open();
						return;
					}
					
					//create the media frame
					fileFrame = wp.media.frames.fileFrame = wp.media({
						title: $(this).data('frame-title'),
						button: {
							text: $(this).data('frame-button-text')
						},
						multiple: false
					});
					
					//when an image is selected, run a callback
					fileFrame.on('select', function () {
						attachment = fileFrame.state().get('selection').first().toJSON();
						removeButton.show();
						edgtfInitMediaRemoveBtn(removeButton);
						
						//write to url field and img tag
						if (attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
							uploadUrl.val(attachment.url);
							
							if (attachment.sizes.thumbnail) {
								uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
							} else {
								uploadImageHolder.find('img').attr('src', attachment.url);
							}
							
							uploadImageHolder.show();
						} else if (attachment.hasOwnProperty('url')) {
							uploadUrl.val(attachment.url);
							uploadImageHolder.find('img').attr('src', attachment.url);
							uploadImageHolder.show();
						}
						
						//write to hidden meta fields
						if (attachment.hasOwnProperty('height')) {
							uploadHeight.val(attachment.height);
						}
						
						if (attachment.hasOwnProperty('width')) {
							uploadWidth.val(attachment.width);
						}
						
						$('.edgtf-input-change').addClass('yes');
					});
					
					//open media frame
					fileFrame.open();
				});
			});
		}
		
		function edgtfInitMediaRemoveBtn(btn) {
			btn.on('click', function () {
				//remove image src and hide it's holder
				btn.siblings('.edgtf-media-image-holder').hide();
				btn.siblings('.edgtf-media-image-holder').find('img').attr('src', '');
				
				//reset meta fields
				btn.siblings('.edgtf-media-meta-fields').find('input[type="hidden"]').each(function (e) {
					$(this).val('');
				});
				
				btn.hide();
			});
		}
	}
	
	function edgtfInitGalleryUploader() {
		var $edgtf_upload_button = jQuery('.edgtf-gallery-upload-btn'),
			$edgtf_clear_button = jQuery('.edgtf-gallery-clear-btn'),
			$thumbs_wrap,
			$input_gallery_items;
		
		wp.media.customlibEditGallery1 = {
			frame: function () {
				
				if (this._frame)
					return this._frame;
				
				var selection = this.select();
				
				this._frame = wp.media({
					id: 'edgtf-portfolio-image-gallery',
					frame: 'post',
					state: 'gallery-edit',
					title: wp.media.view.l10n.editGalleryTitle,
					editing: true,
					multiple: true,
					selection: selection
				});
				
				this._frame.on('update', function () {
					var controller = wp.media.customlibEditGallery1._frame.states.get('gallery-edit');
					var library = controller.get('library');
					// Need to get all the attachment ids for gallery
					var ids = library.pluck('id');
					
					$input_gallery_items.val(ids);

					var data = {
						action: 'cinerama_edge_gallery_upload_get_images',
						ids: ids,
						post_name: $input_gallery_items.attr('name'),
						gallery_upload_get_images: $('#edgtf_gallery_upload_get_images_' + $input_gallery_items.attr('name')).val()
					};
					
					jQuery.ajax({
						type: "post",
						url: ajaxurl,
						data: data,
						success: function (data) {
							$thumbs_wrap.empty().html(data);
						}
					});
				});
				
				return this._frame;
			},
			
			init: function () {
				$edgtf_upload_button.on('click', function (event) {
					$thumbs_wrap = $(this).parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();
					
					event.preventDefault();
					wp.media.customlibEditGallery1.frame().open();
				});
				
				$edgtf_clear_button.on('click', function (event) {
					$thumbs_wrap = $edgtf_upload_button.parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();
					
					event.preventDefault();
					$thumbs_wrap.empty();
					$input_gallery_items.val("");
				});
			},
			
			// Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
			// in wp-includes/js/media-editor.js.source.html
			select: function () {
				
				var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'),
					defaultPostId = wp.media.gallery.defaults.id,
					attachments, selection;
				
				// Bail if we didn't match the shortcode or all of the content.
				if (!shortcode)
					return;
				
				// Ignore the rest of the match object.
				shortcode = shortcode.shortcode;
				
				if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
					shortcode.set('id', defaultPostId);
				
				attachments = wp.media.gallery.attachments(shortcode);
				selection = new wp.media.model.Selection(attachments.models, {
					props: attachments.props.toJSON(),
					multiple: true
				});
				
				selection.gallery = attachments.gallery;
				
				// Fetch the query's attachments, and then break ties from the
				// query to allow for sorting.
				selection.more().done(function () {
					// Break ties with the query.
					selection.props.set({
						query: false
					});
					selection.unmirror();
					selection.props.unset('orderby');
				});
				
				return selection;
			}
		};
		
		$(wp.media.customlibEditGallery1.init);
	}
	
	function edgtfInitSortable() {
		var sortingHolder = $('.edgtf-sortable-holder'),
			enableParentChild = sortingHolder.hasClass('edgtf-enable-pc');
		
		if (sortingHolder.length) {
			sortingHolder.sortable({
				handle: '.edgtf-repeater-sort',
				cursor: 'move',
				placeholder: "placeholder",
				start: function (event, ui) {
					ui.placeholder.height(ui.item.height());
					if (enableParentChild) {
						if (ui.helper.hasClass('second-level')) {
							ui.placeholder.removeClass('placeholder');
							ui.placeholder.addClass('placeholder-sub');
						}
						else {
							ui.placeholder.removeClass('placeholder-sub');
							ui.placeholder.addClass('placeholder');
						}
					}
				},
				sort: function (event, ui) {
					if (enableParentChild) {
						var pos;
						if (ui.helper.hasClass('second-level')) {
							pos = ui.position.left + 50;
						}
						else {
							pos = ui.position.left;
						}
						if (pos >= 75 && !ui.helper.hasClass('second-level') && !ui.helper.hasClass('edgtf-sort-parent')) {
							ui.placeholder.removeClass('placeholder');
							ui.placeholder.addClass('placeholder-sub');
							ui.helper.addClass('second-level');
						}
						else if (pos < 30 && ui.helper.hasClass('second-level') && !ui.helper.hasClass('edgtf-sort-child')) {
							ui.placeholder.removeClass('placeholder-sub');
							ui.placeholder.addClass('placeholder');
							ui.helper.removeClass('second-level');
						}
					}
				}
			});
		}
	}
	
	function edgtfSelect2() {
		var holder = $('select.edgtf-select2');
		
		if (holder.length) {
			holder.select2({
				allowClear: true
			});
		}
	}
	
	function edgtfInitGeocomplete() {
		var geo_inputs = $(".edgtf-address-field");
		
		if (geo_inputs.length && !$('body').hasClass('edgtf-empty-google-api')) {
			geo_inputs.each(function () {
				var geo_input = $(this),
					reset = geo_input.find("#reset"),
					inputField = geo_input.find('input'),
					mapField = geo_input.find('.map_canvas'),
					countryLimit = geo_input.data('country'),
					latFieldName = geo_input.data('lat-field'),
					latField = $("input[name=" + latFieldName + "]"),
					longFieldName = geo_input.data('long-field'),
					longField = $("input[name=" + longFieldName + "]"),
					initialAddress = inputField.val(),
					initialLat = latField.val(),
					initialLong = longField.val();
				
				inputField.geocomplete({
					map: mapField,
					details: ".edgtf-address-elements",
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
				
				inputField.on('focus', function () {
					var map = inputField.geocomplete("map");
					google.maps.event.trigger(map, 'resize')
				});
				reset.on("click", function () {
					inputField.geocomplete("resetMarker");
					inputField.val(initialAddress);
					latField.val(initialLat);
					longField.val(initialLong);
					$("#reset").hide();
					return false;
				});
				
				$(window).on("load", function () {
					inputField.trigger("geocode");
				})
			});
		}
	}
	
	function edgtfShowHidePostFormats() {
		$('input[name="post_format"]').each(function () {
			var id = $(this).attr('id');
			
			if (id !== '' && id !== undefined) {
				var metaboxName = id.replace(/-/g, '_');
				
				$('#edgtf-meta-box-' + metaboxName + '_meta').hide();
			}
		});
		
		var selectedId = $("input[name='post_format']:checked").attr("id");
		
		if (selectedId !== '' && selectedId !== undefined) {
			var selected = selectedId.replace(/-/g, '_');
			$('#edgtf-meta-box-' + selected + '_meta').fadeIn();
		}
		
		$("input[name='post_format']").change(function () {
			edgtfShowHidePostFormats();
		});
	}

	function edgtfShowHidePostFormatsGutenberg() {
		var gutenbergEditor = $('.block-editor__container');

		if(gutenbergEditor.length) {
			var gPostFormatField = gutenbergEditor.find('.editor-post-format');

			gPostFormatField.find('select option').each(function () {
				$('#edgtf-meta-box-post_format_' + $(this).val() + '_meta').hide();
			});

			if (gPostFormatField.find('select option:selected')) {
				$('#edgtf-meta-box-post_format_' + gPostFormatField.find('select option:selected').val() + '_meta').fadeIn();
			}

			gPostFormatField.find('select').change(function(){
				edgtfShowHidePostFormatsGutenberg();
			})
		}
	}
	
	function edgtfInitAjaxForm() {
		$('#edgtf_top_save_button').on('click', function () {
			$('.edgtf_ajax_form').submit();
			
			var inputChangeClass = $('.edgtf-input-change.yes'),
				changesClass = $('.edgtf-changes-saved');
			
			if (inputChangeClass.length) {
				inputChangeClass.removeClass('yes');
			}
			
			changesClass.addClass('yes');
			setTimeout(function () {
				changesClass.removeClass('yes');
			}, 3000);
			
			return false;
		});
		
		$(document).delegate(".edgtf_ajax_form", "submit", function (a) {
			var b = $(this),
				c = {
					action: "cinerama_edge_save_options"
				};
			
			jQuery.ajax({
				url: ajaxurl,
				cache: !1,
				type: "POST",
				data: jQuery.param(c, !0) + "&" + b.serialize()
			}), a.preventDefault(), a.stopPropagation()
		})
	}
	
	function edgtfImportOptions() {
		var holder = $('.edgtf-backup-options-page-holder');
		
		if (holder.length) {
			var edgtfImportBtn = $('#edgtf-import-theme-options-btn');
			
			edgtfImportBtn.on('click', function (e) {
				e.preventDefault();
				
				if (confirm('Are you sure, you want to import Options now?')) {
					edgtfImportBtn.blur();
					edgtfImportBtn.text('Please wait');
					
					var importValue = $('#import_theme_options').val(),
						importNonce = $('#edgtf_import_theme_options_secret').val();
					
					var data = {
						action: 'cinerama_core_import_theme_options',
						content: importValue,
						nonce: importNonce
					};
					
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							
							if (response.status === 'error') {
								alert(response.message);
							} else {
								edgtfImportBtn.text('Import');
								$('.edgtf-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	
	function edgtfImportCustomSidebars() {
		var holder = $('.edgtf-backup-options-page-holder');
		
		if (holder.length) {
			var edgtfImportBtn = $('#edgtf-import-custom-sidebars-btn');
			
			edgtfImportBtn.on('click', function (e) {
				e.preventDefault();
				
				if (confirm('Are you sure, you want to import Custom Sidebars now?')) {
					edgtfImportBtn.blur();
					edgtfImportBtn.text('Please wait');
					
					var importValue = $('#import_custom_sidebars').val(),
						importNonce = $('#edgtf_import_custom_sidebars_secret').val();
					
					var data = {
						action: 'cinerama_core_import_custom_sidebars',
						content: importValue,
						nonce: importNonce
					};
					
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							
							if (response.status === 'error') {
								alert(response.message);
							} else {
								edgtfImportBtn.text('Import');
								$('.edgtf-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	
	function edgtfImportWidgets() {
		var holder = $('.edgtf-backup-options-page-holder');
		
		if (holder.length) {
			var edgtfImportBtn = $('#edgtf-import-widgets-btn');
			
			edgtfImportBtn.on('click', function (e) {
				e.preventDefault();
				
				if (confirm('Are you sure, you want to import Widgets now?')) {
					edgtfImportBtn.blur();
					edgtfImportBtn.text('Please wait');
					
					var importValue = $('#import_widgets').val(),
						importNonce = $('#edgtf_import_widgets_secret').val();
					
					var data = {
						action: 'cinerama_core_import_widgets',
						content: importValue,
						nonce: importNonce
					};
					
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							
							if (response.status === 'error') {
								alert(response.message);
							} else {
								edgtfImportBtn.text('Import');
								$('.edgtf-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	
	function edgtfInitImportContent() {
		var edgtfImportHolder = $('.edgtf-import-page-holder');
		
		if (edgtfImportHolder.length) {
			var edgtfImportBtn = $('#edgtf-import-demo-data'),
				confirmMessage = edgtfImportHolder.data('confirm-message');
			
			edgtfImportBtn.on('click', function (e) {
				e.preventDefault();
				
				if (confirm(confirmMessage)) {
					$('.edgtf-import-load').css('display', 'block');
					
					var progressbar = $('#progressbar'),
						import_opt = $('#import_option').val(),
						import_expl = $('#import_example').val(),
						p = 0;
					
					if (import_opt === 'content') {
						for (var i = 1; i < 10; i++) {
							var str = i < 10 ? 'cinerama_content_0' + i + '.xml' : 'cinerama_content_' + i + '.xml';
							
							jQuery.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'cinerama_core_data_import',
									xml: str,
									example: import_expl,
									import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
								},
								success: function (data, textStatus, XMLHttpRequest) {
									p += 10;
									$('.progress-value').html((p) + '%');
									progressbar.val(p);
									
									if (p === 90) {
										str = 'cinerama_content_10.xml';
										jQuery.ajax({
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'cinerama_core_data_import',
												xml: str,
												example: import_expl,
												import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
											},
											success: function (data, textStatus, XMLHttpRequest) {
												p += 10;
												$('.progress-value').html((p) + '%');
												progressbar.val(p);
												$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
											}
										});
									}
								}
							});
						}
					} else if (import_opt === 'widgets') {
						$.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'cinerama_core_widgets_import',
								example: import_expl
							},
							success: function (data, textStatus, XMLHttpRequest) {
								$('.progress-value').html((100) + '%');
								progressbar.val(100);
							}
						});
						
						$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
					} else if (import_opt === 'options') {
						jQuery.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'cinerama_core_options_import',
								example: import_expl
							},
							success: function (data, textStatus, XMLHttpRequest) {
								$('.progress-value').html((100) + '%');
								progressbar.val(100);
							}
						});
						
						$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
					} else if (import_opt === 'complete_content') {
						for (var i = 1; i < 10; i++) {
							var str = i < 10 ? str = 'cinerama_content_0' + i + '.xml' : 'cinerama_content_' + i + '.xml';
							
							jQuery.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'cinerama_core_data_import',
									xml: str,
									example: import_expl,
									import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
								},
								success: function (data, textStatus, XMLHttpRequest) {
									p += 10;
									$('.progress-value').html((p) + '%');
									progressbar.val(p);
									
									if (p === 90) {
										str = 'cinerama_content_10.xml';
										
										jQuery.ajax({
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'cinerama_core_data_import',
												xml: str,
												example: import_expl,
												import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
											},
											success: function (data, textStatus, XMLHttpRequest) {
												jQuery.ajax({
													type: 'POST',
													url: ajaxurl,
													data: {
														action: 'cinerama_core_other_import',
														example: import_expl
													},
													success: function (data, textStatus, XMLHttpRequest) {
														//alert(data);
														$('.progress-value').html((100) + '%');
														progressbar.val(100);
														$('.progress-bar-message').html('<div class="alert alert-success">Import is completed.</div>');
													}
												});
											}
										});
									}
								}
							});
						}
					}
				}
				
				return false;
			});
		}
	}

    function edgtfInitSelectSwitcherChange() { //used in lms plugin
        var switchers = $('select.edgtf-switcher');
        switchers.each(function() {
            changeActions($(this), $(this).val(), true);
        });

        switchers.on('change', function (e) {
            var valueSelected = this.value.replace(/ /g, '');
            changeActions($(this), valueSelected, false);
        });

        function changeActions(selectField, valueSelected, initialCall) {
            var switchType = selectField.data('switch-type');
            var switchProperty = selectField.data('switch-property');
            var switchEnabled = selectField.data('switch-enabled');

            if (switchType === 'single_yesno') {
                var switchers = $('.switch-' + switchProperty);
                if (switchEnabled === valueSelected) {
                    switchers.addClass('edgtf-switch-single-mode');
                    switchers.attr('data-switch-selector', switchProperty);
                } else {
                    switchers.removeClass('edgtf-switch-single-mode');
                    switchers.removeAttr('data-switch-selector');
                }

                //On property change leave only one switcher enabled
                if(!initialCall) {
                    var oneSwitcherEnabled = false;
                    switchers.removeClass('switcher-auto-enabled');
                    switchers.each(function () {
                        var switcher = $(this);
                        var enabled = $(this).find('.cb-enable');
                        if (!oneSwitcherEnabled && enabled.hasClass('selected')) {
                            oneSwitcherEnabled = true;
                            $(this).addClass('switcher-auto-enabled');
                        }
                        if (!switcher.hasClass('switcher-auto-enabled')) {
                            switcher.find('.cb-disable').addClass('selected');
                            switcher.find('.cb-enable').removeClass('selected');
                            switcher.find('.checkbox').attr('checked', false);
                            switcher.find('.checkboxhidden_yesno').val("no");
                        }
                    });
                }
            }
        }
    }

    function edgtfInitSwitch() {
        //Logic for setting element initial to be no
        var yesNoElements = $(".switch");
        yesNoElements.each(function () {
            var element = $(this);
            if (element.parents('.edgtf-repeater-field') && !element.find('input[type="hidden"]').val()) {
                element.find('.cb-enable').removeClass('selected');
                element.find('.cb-disable').addClass('selected');
            }
        });
        $(".cb-enable").on('click', function(){
            var parent = $(this).parents('.switch');
            //This condition is if only one element can be active, developed for repeater purposes
            //First disable all yes/no elements...
            if(parent.hasClass('edgtf-switch-single-mode')) {
                var selector = '.switch-'+ parent.data('switch-selector');
                var switchers = $(selector);
                switchers.each(function() {
                    var switcher = $(this);
                    switcher.find('.cb-disable').addClass('selected');
                    switcher.find('.cb-enable').removeClass('selected');
                    switcher.find('.checkbox').attr('checked', false);
                    switcher.find('.checkboxhidden_yesno').val("no");
                });
                //Then enable the one that is clicked
                $('.cb-disable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox',parent).attr('checked', true);
                $('.checkboxhidden_yesno',parent).val("yes");
            } else {
                $('.cb-disable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox', parent).attr('checked', true);
                $('.checkboxhidden_yesno', parent).val("yes");
                $('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_follow");
                $('.checkboxhidden_zeroone', parent).val("1");
                $('.checkboxhidden_imagevideo', parent).val("image");
                $('.checkboxhidden_yesempty', parent).val("yes");
                $('.checkboxhidden_flagpost', parent).val("post");
                $('.checkboxhidden_flagpage', parent).val("page");
                $('.checkboxhidden_flagmedia', parent).val("attachment");
                $('.checkboxhidden_flagportfolio', parent).val("portfolio_page");
                $('.checkboxhidden_flagproduct', parent).val("product");
            }
        });
        $(".cb-disable").on('click', function(){
            var parent = $(this).parents('.switch');
            //If only one element can be active, than no value shouldn't be clickable
            if(!parent.hasClass('edgtf-switch-single-mode')) {
                $('.cb-enable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox', parent).attr('checked', false);
                $('.checkboxhidden_yesno', parent).val("no");
                $('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_no_follow");
                $('.checkboxhidden_zeroone', parent).val("0");
                $('.checkboxhidden_imagevideo', parent).val("video");
                $('.checkboxhidden_yesempty', parent).val("");
                $('.checkboxhidden_flagpost', parent).val("");
                $('.checkboxhidden_flagpage', parent).val("");
                $('.checkboxhidden_flagmedia', parent).val("");
                $('.checkboxhidden_flagportfolio', parent).val("");
                $('.checkboxhidden_flagproduct', parent).val("");
            }
        });
    }

    function edgtfInitSaveCheckBoxesValue(){
        var checkboxes = $('.edgtf-single-checkbox-field');
        checkboxes.change(function(){
            edgtfDisableHidden($(this));
        });
        checkboxes.each(function(){
            edgtfDisableHidden($(this));
        });
        function edgtfDisableHidden(thisBox){
            if(thisBox.is(':checked')){
                thisBox.siblings('.edgtf-checkbox-single-hidden').prop('disabled', true);
            }else{
                thisBox.siblings('.edgtf-checkbox-single-hidden').prop('disabled', false);
            }
        }
    }

    function edgtfCheckBoxMultiSelectInitState() {
        var element = $('input[type="checkbox"].dependence.multiselect');

        if (element.length) {
            element.each(function () {
                var thisItem = $(this);
                edgtfInitCheckBox(thisItem);
            });
        }
    }

    function edgtfInitCheckBoxMultiSelectChange() {
        var element = $('input[type="checkbox"].dependence.multiselect');

        element.on('change', function () {
            var thisItem = $(this);
            edgtfInitCheckBox(thisItem);
        });
    }

    function edgtfInitCheckBox(checkBox) {
        var thisItem = checkBox;
        var checked = thisItem.attr('checked');
        var dataShow = thisItem.data('show');

        if (checked === 'checked') {
            if (typeof(dataShow) !== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');

                $.each(elementsToShow, function (index, value) {
                    $(value).fadeIn();
                });
            }
        } else {
            if (typeof(dataShow) !== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');

                $.each(elementsToShow, function (index, value) {
                    $(value).fadeOut();
                });
            }
        }
    }

    function edgtfCheckVisibilityOfAnchorSelectOptions() {
        var holder = $('.edgtf-page-form > div:hidden');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    $panelID = thisHolder.attr('id');

                $('#edgtf-select-anchor option').each(function () {
                    var thisItem = $(this);

                    if (thisItem.data('anchor') === '#' + $panelID) {
                        thisItem.hide();
                    }
                });
            });
        }
    }

    function edgtfShowHideContainersAndAnchorsSelectOptions(){
        setTimeout(function(){
            $('#edgtf-select-anchor option').show();
            $('.edgtf-page-form-section-holder.edgtf-dependency-holder').each(function(){
                var $this = $(this);
                var $id = $this.attr('id');
                if(!$this.is(':visible')){
                    $('#edgtf-select-anchor option').each ( function() {
                        var $thisOption = $(this);
                        var $option = $thisOption.data('anchor') !== undefined ? $(this).data('anchor').substr(1) : '';

                        if ($option == $id) {
                            $thisOption.hide();
                        }
                    });

                }
            });
            $('#edgtf-select-anchor').selectpicker('refresh');
        },300); //after show/hide animation is finished
    }

    function edgtfCheckOptionAnchorsOnDependencyChange() {
        $(document).on('click','.edgtf-dependency-option .cb-enable, .edgtf-dependency-option .cb-disable',function(){
            edgtfShowHideContainersAndAnchorsSelectOptions();
        });

        $(document).on('change','.edgtf-dependency-option input[type=radio]',function(){
            edgtfShowHideContainersAndAnchorsSelectOptions()
        });

        $(document).on('change','.edgtf-form-element.edgtf-dependency-option',function(){
            edgtfShowHideContainersAndAnchorsSelectOptions();
        });
    }

})(jQuery);