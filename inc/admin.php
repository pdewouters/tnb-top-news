<?php
/**
 * Admin settings.
 *
 * @package TNB_Top_News\Admin
 **/

declare( strict_types=1 );

namespace TNB_Top_News\Admin;

/**
 * Setup hooks.
 *
 * @return void
 */
function setup(): void {
	\add_action( 'admin_init', __NAMESPACE__ . '\\register_settings' );
	add_action( 'updated_option', __NAMESPACE__ . '\\clear_transients', 10, 3 );
}

/**
 * Register settings.
 *
 * @return void
 */
function register_settings(): void {
	register_setting(
		'general',
		'newsapi_api_key',
		[
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		]
	);

	add_settings_field(
		'newsapi_api_key_field',
		'NewsAPI API Key',
		__NAMESPACE__ . '\\newsapi_api_key_field_html',
		'general'
	);
}

/**
 * Render API key field.
 *
 * @return void
 */
function newsapi_api_key_field_html(): void {
	$value = get_option( 'newsapi_api_key' );
	echo "<input type='text' id='newsapi_api_key' name='newsapi_api_key' value='" . esc_attr( $value ) . "' />";
}

/**
 * Clear cache.
 *
 * @param mixed $option_name Option name.
 * @param mixed $old_value Old value.
 * @param mixed $value New value.
 *
 * @return void
 */
function clear_transients( $option_name,  $old_value, $value ): void {
	if ( $option_name === 'newsapi_api_key' && ! empty( $value ) ) {
		foreach ( [ 'gb', 'us', 'fr', 'in', 'au' ] as $country_code ) {
			\delete_transient( 'tnb_top_news_' . $country_code );
		}
	}
}
