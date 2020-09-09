<?php

/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class CineramaEdgeClass_Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) { }
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) { }
	
	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @global int $_wp_nav_menu_max_depth
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
		
		ob_start();
		$item_id      = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);
		
		$original_title = false;
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) ) {
				$original_title = false;
			}
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title  = get_the_title( $original_object->ID );
		} elseif ( 'post_type_archive' == $item->type ) {
			$original_object = get_post_type_object( $item->object );
			if ( $original_object ) {
				$original_title = $original_object->labels->archives;
			}
		}
		
		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive' ),
		);
		
		$title = $item->title;
		
		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)', 'cinerama' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__( '%s (Pending)', 'cinerama' ), $item->title );
		}
		
		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;
		
		$submenu_text = 0 == $depth ? 'style=display:none;' : '';
		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
			<div class="menu-item-bar">
				<div class="menu-item-handle">
					<span class="item-title">
						<span class="menu-item-title"><?php echo esc_html( $title ); ?></span>
						<span class="is-submenu" <?php echo esc_attr($submenu_text); ?>><?php esc_html_e( 'sub item', 'cinerama' ); ?></span>
					</span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php echo esc_url(wp_nonce_url( add_query_arg( array( 'action' => 'move-up-menu-item', 'menu-item' => $item_id, ), remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) ), 'move-menu_item' )); ?>" class="item-move-up" aria-label="<?php esc_attr_e( 'Move up', 'cinerama' ) ?>">&#8593;</a>
							|
							<a href="<?php echo esc_url(wp_nonce_url( add_query_arg( array( 'action' => 'move-down-menu-item', 'menu-item' => $item_id, ), remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) ), 'move-menu_item' )); ?>" class="item-move-down" aria-label="<?php esc_attr_e( 'Move down', 'cinerama' ) ?>">&#8595;</a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" href="<?php echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>" aria-label="<?php esc_attr_e( 'Edit menu item', 'cinerama' ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Edit', 'cinerama' ); ?></span></a>
					</span>
				</div>
			</div>
		
			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
				<?php if ( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'URL', 'cinerama' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-wide">
					<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Navigation Label', 'cinerama' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="field-title-attribute field-attr-title description description-wide">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Title Attribute', 'cinerama' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new tab', 'cinerama' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'CSS Classes (optional)', 'cinerama' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'cinerama' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Description', 'cinerama' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'cinerama'); ?></span>
					</label>
				</p>
				
				<?php
				/* New fields insertion starts here */
				?>
				<p class="field-custom description description-thin description-thin-custom">
					<label for="edit-menu-item-anchor-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Anchor', 'cinerama' ); ?><br />
						<input type="text" id="edit-menu-item-anchor-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-anchor" data-item-option data-name="menu_item_anchor_<?php echo esc_attr($item_id); ?>" value="<?php echo esc_attr( $item->anchor ); ?>" />
					</label>
				</p>
				<p class="field-custom description description-wide">
					<?php
					$value = $item->nolink;
					if($value != "") $value = "checked";
					?>
					<label for="edit-menu-item-nolink-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-nolink-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" data-item-option data-name="menu_item_nolink_<?php echo esc_attr($item_id); ?>" value="nolink" <?php echo esc_attr($value); ?> />
						<?php esc_html_e( "Don't link", 'cinerama' ); ?>
					</label>
				</p>
				<p class="field-custom description description-wide">
					<?php
					$value = $item->hide;
					if($value != "") $value = "checked";
					?>
					<label for="edit-menu-item-hide-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-hide-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" data-item-option data-name="menu_item_hide_<?php echo esc_attr($item_id); ?>" value="hide" <?php echo esc_attr($value); ?> />
						<?php esc_html_e( "Don't show", 'cinerama' ); ?>
					</label>
				</p>
				
				<?php if ( $depth == 0 ) { ?>
					<p class="field-custom description description-thin description-thin-custom">
						<label for="edit-menu-item-type-menu-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'Type', 'cinerama' ); ?><br/>
							<select class="widefat" id="edit-menu-item-type-menu<?php echo esc_attr( $item_id ); ?>" data-item-option data-name="menu_item_type_menu_<?php echo esc_attr( $item_id ); ?>">
								<option value="" <?php if ( $item->type_menu == "" ) { echo 'selected="selected"'; } ?>></option>
								<option value="wide" <?php if ( $item->type_menu == "wide" ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Wide', 'cinerama' ); ?></option>
							</select>
						</label>
					</p>
					<p class="field-custom description description-thin description-thin-custom">
						<label for="edit-menu-item-wide-position-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'Wide menu position', 'cinerama' ); ?><br/>
							<select class="widefat" id="edit-menu-item-wide-position<?php echo esc_attr( $item_id ); ?>" data-item-option data-name="menu_item_wide_position_<?php echo esc_attr( $item_id ); ?>">
								<option value="" <?php if ( $item->wide_position == "" ) { echo 'selected="selected"'; } ?>></option>
								<option value="left" <?php if ( $item->wide_position == "left" ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Left', 'cinerama' ); ?></option>
								<option value="right" <?php if ( $item->wide_position == "right" ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Right', 'cinerama' ); ?></option>
							</select>
						</label>
					</p>
				<?php } ?>
				
				<?php
				$iconCollections = cinerama_edge_icon_collections()->getIconCollectionsEmpty();
				
				if ( is_array( $iconCollections ) && count( $iconCollections ) ) { ?>
					<p class="field-custom description description-thin description-thin-custom">
						<label for="edit-menu-item-icon-pack-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Icon Pack', 'cinerama' ); ?><br />
							<select class="widefat" id="edit-menu-item-icon-pack-<?php echo esc_attr($item_id); ?>" data-item-option data-item-id="<?php echo esc_attr($item_id); ?>" data-icon-pack data-name="menu_item_icon_pack_<?php echo esc_attr($item_id); ?>">
								<?php foreach ($iconCollections as $collectionKey => $collectionTitle) { ?>
									<option value="<?php echo esc_attr($collectionKey); ?>" <?php if($item->icon_pack == $collectionKey){echo 'selected="selected"';} ?>><?php echo esc_html($collectionTitle); ?></option>
								<?php } ?>
							</select>
							<br/><?php esc_html_e( 'Only with "default" & "wide with icons" menu types', 'cinerama' ); ?>
						</label>
					</p>
					
					<?php
					$icon_data_attr = 'menu_item_icon_'.$item_id;
					$collection_obj = cinerama_edge_icon_collections()->getIconCollection($item->icon_pack);
					?>
					<p class="field-custom description description-thin description-thin-custom edgtf-icon-select-holder">
						<label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Icon', 'cinerama' ); ?><br />
							<select class="widefat" id="edit-menu-item-icon<?php echo esc_attr($item_id); ?>" data-item-option data-name="<?php echo esc_attr($icon_data_attr); ?>">
								<?php
								if($collection_obj) { ?>
									<?php
									$icons_array = $collection_obj->getIconsArray();
									foreach ($icons_array as $key => $value) { ?>
										<option value="<?php echo esc_attr($value); ?>" <?php if($item->icon == $value){echo 'selected="selected"';} ?>><?php echo esc_html($key); ?></option>
										<?php
									}
									?>
								<?php } ?>
							</select>
						</label>
					</p>
				
				<?php } ?>
				<p class="field-custom description description-thin description-thin-custom" style="clear:both;">
					<label for="edit-menu-item-featured-icon-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Featured Icon', 'cinerama' ); ?><br />
						<select class="widefat" id="edit-menu-item-featured-icon<?php echo esc_attr($item_id); ?>" data-item-option data-name="menu_item_featured_icon_<?php echo esc_attr($item_id); ?>">
							<option value="" <?php if($item->featured_icon == ""){echo 'selected="selected"';} ?>></option>
							<option value="fa-star" <?php if($item->featured_icon == "fa-star"){echo 'selected="selected"';} ?>><?php esc_html_e('Star', 'cinerama'); ?></option>
							<option value="fa-paw" <?php if($item->featured_icon == "fa-paw"){echo 'selected="selected"';} ?>><?php esc_html_e('Paw', 'cinerama'); ?></option>
							<option value="fa-heart " <?php if($item->featured_icon == "fa-heart "){echo 'selected="selected"';} ?>><?php esc_html_e('Heart', 'cinerama'); ?></option>
							<option value="fa-thumbs-up " <?php if($item->featured_icon == "fa-thumbs-up "){echo 'selected="selected"';} ?>><?php esc_html_e('Thumbs Up', 'cinerama'); ?></option>
						</select>
					</label>
				</p>
				<p class="field-custom description description-thin description-thin-custom">
				</p>
				<p class="field-custom description description-wide">
					<label for="edit-menu-item-sidebar-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Custom widget area', 'cinerama' ); ?><br />
						<select class="widefat" id="edit-menu-item-sidebar<?php echo esc_attr($item_id); ?>" data-item-option data-name="menu_item_sidebar_<?php echo esc_attr($item_id); ?>">
							<option value="" <?php if($item->sidebar == ""){echo 'selected="selected"';} ?>></option>
							<?php
							$cinerama_custom_sidebars = cinerama_edge_get_custom_sidebars();
							foreach ($cinerama_custom_sidebars as $sidebar_key => $sidebar) { ?>
								<option value="<?php echo esc_attr($sidebar_key); ?>" <?php if ($item->sidebar == $sidebar_key) { ?> selected="selected" <?php } ?>>
									<?php echo esc_html(ucwords( $sidebar )); ?>
								</option>
							<?php } ?>
						</select>
						<br/><?php esc_html_e( 'Only with "wide & wide with icons" menu type', 'cinerama' ); ?>
					</label>
				</p>
				<?php
				/* New fields insertion ends here */
				?>
				
				<fieldset class="field-move hide-if-no-js description description-wide">
					<span class="field-move-visual-label" aria-hidden="true"><?php esc_html_e( 'Move', 'cinerama' ); ?></span>
					<button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'cinerama' ); ?></button>
					<button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'cinerama' ); ?></button>
					<button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
					<button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
					<button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'cinerama' ); ?></button>
				</fieldset>
				
				<div class="menu-item-actions description-wide submitbox">
					<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__('Original: %s', 'cinerama'), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php echo wp_nonce_url( add_query_arg( array( 'action' => 'delete-menu-item', 'menu-item' => $item_id, ), admin_url( 'nav-menus.php' ) ), 'delete-menu_item_' . $item_id ); ?>"><?php esc_html_e( 'Remove', 'cinerama' ); ?></a>
					<span class="meta-sep hide-if-no-js"> | </span>
					<a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) ); ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e('Cancel', 'cinerama'); ?></a>
				</div>
				
				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		
		$output .= ob_get_clean();
	}
}
