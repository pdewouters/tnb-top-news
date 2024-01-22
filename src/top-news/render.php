<?php
/**
 * Top News block render callback.
 *
 * @package TNB_Top_News
 */

declare( strict_types=1 );
?>

<div id="tnb-top-news-app" <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<?php echo $content; // phpcs:ignore ?>
</div>
