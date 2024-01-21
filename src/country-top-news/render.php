<?php
/**
 * Top News block render callback.
 *
 * @package TNB_Top_News
 */

declare(strict_types=1);

namespace TNB_Top_News\Country_Top_News;

use TNB_Top_News\API;
use TNB_Top_News\Utils;

$country_code = /** @var string $attributes */ $attributes['countryCode'];
$articles     = API\get_articles( $country_code );
$country_name = Utils\get_country_name( $country_code );
?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<h3>
		<?php
		printf(
			/* translators: %s: Country name. */
			esc_html__( 'Top News from %s', 'tnb-top-news' ),
			esc_html( $country_name )
		);
		?>
	</h3>
	<?php if ( empty( $articles ) ) : ?>
		<p>
			<?php esc_html_e( 'No articles found.', 'tnb-top-news' ); ?>
		</p>
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
