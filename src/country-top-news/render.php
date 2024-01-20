<?php
$country_code = $attributes['countryCode'];
$articles     = TNB_Top_News\API\get_articles( $country_code );
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php if ( empty( $articles ) ) : ?>
		<p><?php esc_html_e( 'No articles found.', 'tnb-top-news' ); ?></p>
	<?php else : ?>
		<ul>
			<?php foreach ( $articles as $article ) : ?>
				<li>
					<a href="<?php echo esc_url( $article['url'] ); ?>">
						<?php echo esc_html( $article['title'] ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>
