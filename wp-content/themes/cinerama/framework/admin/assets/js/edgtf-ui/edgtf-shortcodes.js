(function () {

    "use strict";

    tinymce.PluginManager.add('edgtf_shortcodes', function (ed, url) {
        ed.addButton('edgtf_shortcodes', {
            title: window.edgtSCLabel,
            image: window.edgtSCIcon,
            icon: false,
            type: 'menubutton',
            menu: [
                {
                    text: 'Button',
                    onclick: function () {
                        ed.windowManager.open({
                            title: 'Button Shortcode',
                            body: [
                                {
                                    type: 'listbox',
                                    name: 'size',
                                    label: 'Size',
                                    'values': [
                                        {text: 'Default', value: ''},
                                        {text: 'Small', value: 'small'},
                                        {text: 'Medium', value: 'medium'},
                                        {text: 'Large', value: 'large'},
                                        {text: 'Huge', value: 'huge'}
                                    ]
                                },
                                {
                                    type: 'listbox',
                                    name: 'type',
                                    label: 'Type',
                                    'values': [
                                        {text: 'Default', value: ''},
                                        {text: 'Outline', value: 'outline'},
                                        {text: 'Solid', value: 'solid'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'text',
                                    label: 'Text'
                                },
                                {
                                    type: 'textbox',
                                    name: 'link',
                                    label: 'Link'
                                },
                                {
                                    type: 'listbox',
                                    name: 'target',
                                    label: 'Link Target',
                                    'values': [
                                        {text: 'Self', value: '_self'},
                                        {text: 'Blank', value: '_blank'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'custom_class',
                                    label: 'Custom CSS Class'
                                },
                                {
                                    type: 'listbox',
                                    name: 'icon_pack',
                                    label: 'Icon Pack',
                                    'values': [
                                        {text: 'Font Awesome', value: 'font_awesome'},
                                        {text: 'Font Elegant', value: 'font_elegant'},
                                        {text: 'Ion Icons', value: 'ion_icons'},
                                        {text: 'Linea Icons', value: 'linea_icons'},
                                        {text: 'Linear Icons', value: 'linear_icons'},
                                        {text: 'Simple Line Icons', value: 'simple_line_icons'},
                                        {text: 'Dripicons', value: 'dripicons'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'icon',
                                    label: 'Icon'
                                },
                                {
                                    type: 'textbox',
                                    name: 'color',
                                    label: 'Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'hover_color',
                                    label: 'Hover Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'background_color',
                                    label: 'Background Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'hover_background_color',
                                    label: 'Hover Background Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'border_color',
                                    label: 'Border Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'hover_border_color',
                                    label: 'Hover Border Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'font_size',
                                    label: 'Font Size (px)'
                                },
                                {
                                    type: 'listbox',
                                    name: 'font_weight',
                                    label: 'Font Weight',
                                    'values': [
                                        {text: 'Default', value: ''},
                                        {text: 'Thin 100', value: '100'},
                                        {text: 'Extra-Light 200', value: '200'},
                                        {text: 'Light 300', value: '300'},
                                        {text: 'Regular 400', value: '400'},
                                        {text: 'Medium 500', value: '500'},
                                        {text: 'Semi-Bold 600', value: '600'},
                                        {text: 'Bold 700', value: '700'},
                                        {text: 'Extra-Bold 800', value: '800'},
                                        {text: 'Ultra-Bold 900', value: '900'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'margin',
                                    label: 'Margin(in format: 0px 0px 1px 0px)'
                                }
                            ],
                            onsubmit: function (e) {
                                var icon_pack_prefix = '';
                                switch (e.data.icon_pack) {
                                    case "font_awesome":
                                        icon_pack_prefix = "fa_icon";
                                        break;
                                    case "font_elegant":
                                        icon_pack_prefix = "fe_icon";
                                        break;
                                    case "ion_icons":
                                        icon_pack_prefix = "ion_icon";
                                        break;
                                    case "linea_icons":
                                        icon_pack_prefix = "linea_icon";
                                        break;
                                    case "linear_icons":
                                        icon_pack_prefix = "linear_icon";
                                        break;
                                    case "simple_line_icons":
                                        icon_pack_prefix = "simple_line_icon";
                                        break;
                                    case "dripicons":
                                        icon_pack_prefix = "dripicon";
                                        break;
                                }

                                ed.insertContent('[edgtf_button size="' + e.data.size + '" type="' + e.data.type + '" text="' + e.data.text + '" custom_class="' + e.data.custom_class + '" icon_pack="' + e.data.icon_pack + '" ' + icon_pack_prefix + '="' + e.data.icon + '" link="' + e.data.link + '" target="' + e.data.target + '" color="' + e.data.color + '" hover_color="' + e.data.hover_color + '" background_color="' + e.data.background_color + '" hover_background_color="' + e.data.hover_background_color + '" border_color="' + e.data.border_color + '" hover_border_color="' + e.data.hover_border_color + '" font_size="' + e.data.font_size + '" font_weight="' + e.data.font_weight + '" margin="' + e.data.margin + '"]');
                            }
                        });
                    }
                },
                {
                    text: 'Dropcaps',
                    onclick: function () {
                        ed.windowManager.open({
                            title: 'Dropcaps Shortcode',
                            body: [
                                {
                                    type: 'listbox',
                                    name: 'type',
                                    label: 'Type',
                                    'values': [
                                        {text: 'Normal', value: 'normal'},
                                        {text: 'Square', value: 'square'},
                                        {text: 'Circle', value: 'circle'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'letter',
                                    label: 'Letter'
                                },
                                {
                                    type: 'textbox',
                                    name: 'color',
                                    label: 'Letter Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'background_color',
                                    label: 'Background Color (Only for Square and Circle type)'
                                }
                            ],
                            onsubmit: function (e) {
                                ed.insertContent('[edgtf_dropcaps type="' + e.data.type + '" color="' + e.data.color + '" background_color="' + e.data.background_color + '"]' + e.data.letter + '[/edgtf_dropcaps]');
                            }
                        });
                    }
                },
                {
                    text: 'Highlights',
                    onclick: function () {
                        ed.windowManager.open({
                            title: 'Highlights Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'text',
                                    label: 'Text'
                                },
                                {
                                    type: 'textbox',
                                    name: 'color',
                                    label: 'Text Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'background_color',
                                    label: 'Background Color'
                                }
                            ],
                            onsubmit: function (e) {
                                ed.insertContent('[edgtf_highlight background_color="' + e.data.background_color + '" color="' + e.data.color + '"]' + e.data.text + '[/edgtf_highlight]');
                            }
                        });
                    }
                },
                {
                    text: 'Icon',
                    onclick: function () {
                        ed.windowManager.open({
                            title: 'Icon Shortcode',
                            body: [
                                {
                                    type: 'listbox',
                                    name: 'icon_pack',
                                    label: 'Icon Pack',
                                    'values': [
                                        {text: 'Font Awesome', value: 'font_awesome'},
                                        {text: 'Font Elegant', value: 'font_elegant'},
                                        {text: 'Ion Icons', value: 'ion_icons'},
                                        {text: 'Linea Icons', value: 'linea_icons'},
                                        {text: 'Linear Icons', value: 'linear_icons'},
                                        {text: 'Simple Line Icons', value: 'simple_line_icons'},
                                        {text: 'Dripicons', value: 'dripicons'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'icon',
                                    label: 'Icon'
                                },
                                {
                                    type: 'listbox',
                                    name: 'size',
                                    label: 'Size',
                                    'values': [
                                        {text: 'Tiny', value: 'edgtf-icon-tiny'},
                                        {text: 'Small', value: 'edgtf-icon-small'},
                                        {text: 'Medium', value: 'edgtf-icon-medium'},
                                        {text: 'Large', value: 'edgtf-icon-large'},
                                        {text: 'Very Large', value: 'edgtf-icon-huge'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'custom_size',
                                    label: 'Custom Size (px)'
                                },
                                {
                                    type: 'listbox',
                                    name: 'type',
                                    label: 'Type',
                                    'values': [
                                        {text: 'Normal', value: 'normal'},
                                        {text: 'Circle', value: 'circle'},
                                        {text: 'Square', value: 'square'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'border_radius',
                                    label: 'Border Radius (px)'
                                },
                                {
                                    type: 'textbox',
                                    name: 'shape_size',
                                    label: 'Shape Size (px)'
                                },
                                {
                                    type: 'textbox',
                                    name: 'icon_color',
                                    label: 'Icon Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'border_color',
                                    label: 'Border Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'border_width',
                                    label: 'Border Width (px)'
                                },
                                {
                                    type: 'textbox',
                                    name: 'background_color',
                                    label: 'Background Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'hover_icon_color',
                                    label: 'Hover Icon Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'hover_border_color',
                                    label: 'Hover Border Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'hover_background_color',
                                    label: 'Hover Background Color'
                                },
                                {
                                    type: 'textbox',
                                    name: 'margin',
                                    label: 'Margin (top right bottom left)'
                                },
                                {
                                    type: 'listbox',
                                    name: 'icon_animation',
                                    label: 'Icon Animation',
                                    'values': [
                                        {text: 'No', value: ''},
                                        {text: 'Yes', value: 'icon_animation'},

                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'icon_animation_delay',
                                    label: 'Icon Animation Delay (ms)'
                                },
                                {
                                    type: 'textbox',
                                    name: 'link',
                                    label: 'Link'
                                },
                                {
                                    type: 'listbox',
                                    name: 'anchor_icon',
                                    label: 'Use Link as Anchor',
                                    'values': [
                                        {text: 'No', value: ''},
                                        {text: 'Yes', value: 'yes'}

                                    ]
                                },
                                {
                                    type: 'listbox',
                                    name: 'target',
                                    label: 'Target',
                                    'values': [
                                        {text: 'Self', value: '_self'},
                                        {text: 'Blank', value: '_blank'},

                                    ]
                                }
                            ],
                            onsubmit: function (e) {
                                var icon_pack_prefix = '';
                                switch (e.data.icon_pack) {
                                    case "font_awesome":
                                        icon_pack_prefix = "fa_icon";
                                        break;
                                    case "font_elegant":
                                        icon_pack_prefix = "fe_icon";
                                        break;
                                    case "ion_icons":
                                        icon_pack_prefix = "ion_icon";
                                        break;
                                    case "linea_icons":
                                        icon_pack_prefix = "linea_icon";
                                        break;
                                }
                                ed.insertContent('[edgtf_icon icon_pack="' + e.data.icon_pack + '" ' + icon_pack_prefix + '="' + e.data.icon + '" size="' + e.data.size + '" custom_size="' + e.data.custom_size + '" type="' + e.data.type + '" border_radius="' + e.data.border_radius + '" shape_size="' + e.data.shape_size + '" icon_color="' + e.data.icon_color + '" border_color="' + e.data.border_color + '" border_width="' + e.data.border_width + '" background_color="' + e.data.background_color + '" hover_icon_color="' + e.data.hover_icon_color + '" hover_border_color="' + e.data.hover_border_color + '" hover_background_color="' + e.data.hover_background_color + '" margin="' + e.data.margin + '" icon_animation="' + e.data.icon_animation + '" icon_animation_delay="' + e.data.icon_animation_delay + '" link="' + e.data.link + '" anchor_icon="' + e.data.anchor_icon + '" target="' + e.data.target + '"]');
                            }
                        });
                    }
                },
                {
                    text: 'Separator',
                    onclick: function () {
                        ed.windowManager.open({
                            title: 'Separator Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'class_name',
                                    label: 'Extra Class Name'
                                },
                                {
                                    type: 'listbox',
                                    name: 'type',
                                    label: 'Type',
                                    'values': [
                                        {text: 'Normal', value: 'normal'},
                                        {text: 'Full Width', value: 'full-width'}
                                    ]
                                },
                                {
                                    type: 'listbox',
                                    name: 'position',
                                    label: 'Position (for normal type)',
                                    'values': [
                                        {text: 'Center', value: 'center'},
                                        {text: 'Left', value: 'left'},
                                        {text: 'Right', value: 'right'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'color',
                                    label: 'Color'
                                },
                                {
                                    type: 'listbox',
                                    name: 'border_style',
                                    label: 'Border style',
                                    'values': [
                                        {text: 'Default', value: ''},
                                        {text: 'Dashed', value: 'dashed'},
                                        {text: 'Solid', value: 'solid'},
                                        {text: 'Dotted', value: 'dotted'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'width',
                                    label: 'Width (for normal type)'
                                },
                                {
                                    type: 'textbox',
                                    name: 'thickness',
                                    label: 'Thickness (px)'
                                },
                                {
                                    type: 'textbox',
                                    name: 'top_margin',
                                    label: 'Margin Top'
                                },
                                {
                                    type: 'textbox',
                                    name: 'bottom_margin',
                                    label: 'Margin Bottom'
                                }
                            ],
                            onsubmit: function (e) {
                                ed.insertContent('[edgtf_separator class_name="' + e.data.class_name + '" type="' + e.data.type + '" position="' + e.data.position + '" color="' + e.data.color + '" border_style="' + e.data.border_style + '" width="' + e.data.width + '" thickness="' + e.data.thickness + '" top_margin="' + e.data.top_margin + '" bottom_margin="' + e.data.bottom_margin + '"]');
                            }
                        });
                    }
                }
            ]
        });
    });
})();