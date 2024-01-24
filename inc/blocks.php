<?php
/**
 * Block registration.
 *
 * @package TNB_Top_News\Blocks
 **/

declare( strict_types=1 );

namespace TNB_Top_News\Blocks;

use const TNB_Top_News\DIR;

/**
 * Setup hooks.
 *
 * @return void
 */
function setup(): void {
	add_action( 'init', __NAMESPACE__ . '\register_block_types' );
}

/**
 * Register block types.
 *
 * @return void
 */
function register_block_types(): void {
	register_block_type(
		DIR . '/build/top-news'
	);
}
