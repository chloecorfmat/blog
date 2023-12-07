<?php
// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

function chloecorfmat_enqueue_scripts() {
    wp_enqueue_script(
        'chloecorfmat',
        get_template_directory_uri() . '/assets/index.js',
        array(),
        '1.0',
        true
    );

    wp_enqueue_style(
        'chloecorfmat',
        get_template_directory_uri() . '/assets/index.css',
        array(),
        '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'chloecorfmat_enqueue_scripts' );

register_nav_menus( array(
    'main' => 'Menu Principal',
    'legal' => 'Menu Pages légales',
    'social' => 'Menu Réseaux sociaux',
    'references' => 'Menu Références'
) );

function chloecorfmat_register_post_types() {
    $labels = array(
        'name' => 'Portfolio',
        'all_items' => 'Tous les projets',  // affiché dans le sous menu
        'singular_name' => 'Projet',
        'add_new_item' => 'Ajouter un projet',
        'edit_item' => 'Modifier le projet',
        'menu_name' => 'Portfolio'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-customizer',
    );

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'chloecorfmat_register_post_types' );

function chloecorfmat_allowed_block( $allowed_block_types, $post ) {
    /**return [
        'chloecorfmat/articles-details',
    ];**/

	return true;
}
add_filter( 'allowed_block_types_all', 'chloecorfmat_allowed_block', 10, 2 );

/**
 * Add field for icon classes in menus
 * https://pressidium.com/blog/adding-custom-fields-to-wordpress-menu-items/#:~:text=Select%20'Menu%20Item'%20under%20the,Pretty%20easy!
 */
function chloecorfmat_menu_item_custom_fields( $item_id, $item ) {
    $menu_item_icon = get_post_meta( $item_id, '_menu_item_icon', true );
    ?>
    <div style="clear: both;">
        <span class="icon"><?php _e( "Classes de l'icône", 'chloecorfmat' ); ?></span><br />
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
        <div class="logged-input-holder">
            <input type="text" name="menu_item_icon[<?php echo $item_id ;?>]" id="menu-item-icon-<?php echo $item_id ;?>" value="<?php echo esc_attr( $menu_item_icon ); ?>" />
        </div>
    </div>
    <?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'chloecorfmat_menu_item_custom_fields', 10, 2 );

function chloecorfmat_save_menu_item_icon( $menu_id, $menu_item_db_id ) {
    if ( isset( $_POST['menu_item_icon'][$menu_item_db_id]  ) ) {
        $sanitized_data = sanitize_text_field( $_POST['menu_item_icon'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, '_menu_item_icon', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, '_menu_item_icon' );
    }
}
add_action( 'wp_update_nav_menu_item', 'chloecorfmat_save_menu_item_icon', 10, 2 );

function chloecorfmat_show_menu_item_icon( $title, $item ) {
    if( is_object( $item ) && isset( $item->ID ) ) {
        $menu_item_icon = get_post_meta( $item->ID, '_menu_item_icon', true );
        if ( ! empty( $menu_item_icon ) ) {
            $title .= '<i class="'. $menu_item_icon .'"></i>';
        }
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'chloecorfmat_show_menu_item_icon', 10, 2 );