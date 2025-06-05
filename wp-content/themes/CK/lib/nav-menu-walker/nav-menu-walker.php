<?php
/*

Type: snippet

*/


/**
 *  Custom version of Walker_Nav_Menu_Edit used to generate Menu Structure items in Appearance -> Menus
 *  The walker class code is simply a copy of default walker from WordPress core,
 *  comments for default WP code are ommitted. Also the code formatting is left intact from the core version.
 *  Custom code/functionality is denoted by appropriate comments.
 *
 *  The walker supports customized display of nav menu archives, meta fields for nav menu hashes,
 *  and custom menu items snippet.
 */


/**
 *  Sets the class below to be used as walker for Menu Structure items in Appearance -> Menus
 */

if(!(class_exists('Walker_Nav_Menu_Edit_CCS_Custom'))){

add_filter('wp_edit_nav_menu_walker', 'custom_nav_edit_walker', 10, 2);

function custom_nav_edit_walker( $walker, $menu_id )
{
    return 'Walker_Nav_Menu_Edit_CCS_Custom';
}



class Walker_Nav_Menu_Edit_CCS_Custom extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {}


	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings <?php if( 'ccs_custom_menu_item' == $item->object ): ?>ccs-custom-menu-settings<?php endif; ?>" id="menu-item-settings-<?php echo $item_id; ?>">

				<?php
				/**
				 *  Custom menu items
				 */
				?>

				<?php if( 'ccs_custom_menu_item' == $item->object ): ?>
					<?php

					$item_edit_url = admin_url('post.php?post=' . $item->object_id . '&action=edit');

					?>
					<p class="ccs-custom-menu-settings-message">
						<?php _e('This is a customizable menu item.'); ?><br>
						<?php echo sprintf( wp_kses( __('You can edit it <a href="%s">here</a>.', 'themeName-admin' ), array( 'a' => array( 'href' => array() ) ) ), $item_edit_url ); ?>
					</p>


					<?php
					/**
					 *  The field with title is needed, even though it's not used in this menu item,
					 *  otherwise the menu item wont save
					 */
					?>

					<input type="hidden" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />



				<?php
				/**
				 *  If this is NOT the custom menu item
				 *  Default Wordpress menu edit interface
				 */
				?>

				<?php else: ?>

					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo $item_id; ?>">
								<?php _e( 'URL' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>


					<?php
					/**
					 *  Anchor links
					 *  Display additional field for inputting links hash value
					 *  Only if appropriate meta value is present
					 */
					?>

					<?php

					$hash = get_post_meta($item_id, 'ccs_url_hash', true);
					if( $hash ):

					?>
						<p class="description description-wide">
							<label for="ccs-nav-menu-hash-<?php echo $item_id; ?>">
								<?php _e('Hash'); ?>
								<input type="text" id="ccs-nav-menu-hash-<?php echo $item_id; ?>" class="widefat" name="ccs-nav-menu-hash-save[<?php echo $item_id; ?>]" value="<?php echo $hash; ?>">
							</label>
						</p>
					<?php endif; ?>

					<?php
					/**
					 *  End Anchor links
					 */
					?>


					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo $item_id; ?>">
							<?php _e( 'Navigation Label' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
							<?php _e( 'Title Attribute' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo $item_id; ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php _e( 'Open link in a new window/tab' ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
							<?php _e( 'CSS Classes (optional)' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
							<?php _e( 'Link Relationship (XFN)' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
							<?php _e( 'Description' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
						</label>
					</p>

				<?php endif; ?>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move' ); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one' ); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>

						<?php
						/**
						 *  Nav Menu Archives support.
						 *  If current item is CPT Archives link replace Original url with information
						 *  what CPT archive this is.
						 */
						?>

						<?php if( $item->type == 'custom_ccs_archive' ): ?>
							<p class="link-to-original">
								<?php

								$post_type = get_post_type_object($item->object);
								echo $post_type->labels->menu_name . ' ' . __('archive');

								?>
							</p>


						<?php
						/**
						 *  Default WP link to original
						 */
						?>

						<?php elseif( 'ccs_custom_menu_item' != $item->object ): ?>
							<p class="link-to-original">
								<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>

						<?php /* End Nav Menu Archives support */ ?>


					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

}

}


?>
