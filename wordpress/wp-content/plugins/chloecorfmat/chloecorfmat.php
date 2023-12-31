<?php
/**
 * Plugin Name:       Chloé Corfmat
 * Description:       All custom code for Chloé Corfmat's website
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Chloé Corfmat
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       chloecorfmat
 *
 * @package           chloecorfmat
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function chloecorfmat_block_init() {
	register_block_type( __DIR__ . '/build/1-block-articles-details' );
}
add_action( 'init', 'chloecorfmat_block_init' );


function add_custom_category($categories)
{
	$categories[] = [
		'slug' => 'chloecorfmat-articles',
		'title' => 'Blocs pour les articles Chloé Corfmat',
	];

	return $categories;
}

add_filter('block_categories_all', 'add_custom_category');
