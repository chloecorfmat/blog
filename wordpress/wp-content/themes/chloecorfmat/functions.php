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
        get_template_directory_uri() . '/assets/main.css',
        array(),
        '1.0'
    );

    wp_enqueue_style(
        'chloecorfmat',
        'https://unpkg.com/browse/highlightjs@9.16.2/styles/a11y-dark.css',
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
        'all_items' => 'Tous les projets',
        'singular_name' => 'Projet',
        'add_new_item' => 'Ajouter un projet',
        'edit_item' => 'Modifier le projet',
        'menu_name' => 'Portfolio'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => 'portfolio',
        'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-customizer',
        'rewrite' => [
            'slug' => (!empty(get_option('chloecorfmat_portfolio_slug'))) ? get_option('chloecorfmat_portfolio_slug') : '/portfolio',
            'with_front' => false
        ]
    );

    register_post_type( 'portfolio', $args );

    $labels_alternatives = array(
        'name' => 'Les alternatives accessibles à mes contenus',
        'all_items' => 'Toutes les alternatives',
        'singular_name' => 'Alternative',
        'add_new_item' => 'Ajouter une alternative',
        'edit_item' => 'Modifier l\'alternative',
        'menu_name' => 'Alternatives'
    );

    $args_alternatives = array(
        'labels' => $labels_alternatives,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => 'alternatives',
        'supports' => array( 'title'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-universal-access',
        'rewrite' => [
            'slug' => (!empty(get_option('chloecorfmat_alternatives_slug'))) ? get_option('chloecorfmat_alternatives_slug') : '/alternatives',
            'with_front' => false
        ]
    );

    register_post_type( 'alternatives', $args_alternatives );

    $labels = array(
        'name' => 'Thématiques principales',
        'new_item_name' => 'Nom de la nouvelle thématique principale'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => false,
        'rewrite' => [
            'slug' => '/thematiques'
        ]
    );

    register_taxonomy( 'post-main-thematic', 'post', $args );
}
add_action( 'init', 'chloecorfmat_register_post_types' );

add_action('admin_init', function() {
    add_settings_field('chloecorfmat_portfolio_slug', __('Portfolio', 'txtdomain'), 'chloecorfmat_portfolio_slug_output', 'permalink', 'optional');
    add_settings_field('chloecorfmat_alternatives_slug', __('Page des alternatives', 'txtdomain'), 'chloecorfmat_alternatives_slug_output', 'permalink', 'optional');
});

function chloecorfmat_portfolio_slug_output() {
    ?>
        <input name="chloecorfmat_portfolio_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('chloecorfmat_portfolio_slug')); ?>" />
    <?php
}

function chloecorfmat_alternatives_slug_output() {
    ?>
    <input name="chloecorfmat_alternatives_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('chloecorfmat_alternatives_slug')); ?>" />
    <?php
}

add_action('admin_init', function() {
    if (isset($_POST['permalink_structure'])) {
        update_option('chloecorfmat_portfolio_slug', trim($_POST['chloecorfmat_portfolio_slug']));
        update_option('chloecorfmat_alternatives_slug', trim($_POST['chloecorfmat_alternatives_slug']));
    }
});

function chloecorfmat_allowed_block( $allowed_block_types, $post ) {
    //return true;

    return [
        'acf/block-chloecorfmat-text',
        'acf/block-chloecorfmat-image',
        'acf/block-chloecorfmat-code',
        'acf/block-chloecorfmat-callout',
    ];
}
add_filter( 'allowed_block_types_all', 'chloecorfmat_allowed_block', 10, 2 );


function chloecorfmat_nav_menu_objects($items, $args)
{
    foreach ($items as &$item) {
        $icon = get_field('menu_complex_icon', $item);


        if ($icon) {
            $item->icon = $icon;
        }
    }

    return $items;
}

add_filter('wp_nav_menu_objects', 'chloecorfmat_nav_menu_objects', 10, 2);

function add_custom_category($categories)
{
    $categories[] = [
        'slug' => 'chloecorfmat-articles',
        'title' => 'Blocs pour les articles Chloé Corfmat',
    ];

    return $categories;
}

add_filter('block_categories_all', 'add_custom_category');

function chloecorfmat_register_acf_block_types() {

    acf_register_block_type( array(
        'name'              => 'block_chloecorfmat_text',
        'title'             => 'Bloc texte',
        'description'       => "Écrire du contenu dans un WYSIWYG",
        'render_template'   => 'blocks/text.php',
        'category'          => 'chloecorfmat-articles',
        'icon'              => 'text',
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'chloecorfmat-blocks',
                get_template_directory_uri() . '/assets/main.css'
            );
        }
    ) );

    acf_register_block_type( array(
        'name'              => 'block_chloecorfmat_image',
        'title'             => 'Bloc image',
        'description'       => "Insérez une image full largeur",
        'render_template'   => 'blocks/image.php',
        'category'          => 'chloecorfmat-articles',
        'icon'              => 'format-image',
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'chloecorfmat-blocks',
                get_template_directory_uri() . '/assets/main.css'
            );
        }
    ) );

    acf_register_block_type( array(
        'name'              => 'block_chloecorfmat_code',
        'title'             => 'Bloc code',
        'description'       => "Afficher du code",
        'render_template'   => 'blocks/code.php',
        'category'          => 'chloecorfmat-articles',
        'icon'              => 'editor-code',
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'chloecorfmat-blocks',
                get_template_directory_uri() . '/assets/main.css'
            );
        }
    ) );

    acf_register_block_type( array(
        'name'              => 'block_chloecorfmat_callout',
        'title'             => 'Bloc callout',
        'description'       => "Afficher une information importante",
        'render_template'   => 'blocks/callout.php',
        'category'          => 'chloecorfmat-articles',
        'icon'              => 'editor-code',
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'chloecorfmat-blocks',
                get_template_directory_uri() . '/assets/main.css'
            );
        }
    ) );
}

add_action( 'acf/init', 'chloecorfmat_register_acf_block_types' );

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn btn--primary pagination__btn"';
}

/**function add_rewrite_rules( $wp_rewrite )
{
    $new_rules = array(
        'blog/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(1),
    );

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules');**/

// include_once ('acf-2024-04-13.php');


