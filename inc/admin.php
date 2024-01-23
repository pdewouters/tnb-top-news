<?php
/**
 * Admin settings.
 *
 * @package TNB_Top_News\Admin
 **/

declare( strict_types=1 );

namespace TNB_Top_News\Admin;

use TNB_Top_News\CRON;

/**
 * Setup hooks.
 *
 * @return void
 */
function setup(): void {
	add_action( 'admin_menu', __NAMESPACE__ . '\\top_news_menu_page' );
	add_action( 'admin_init', __NAMESPACE__ . '\\register_settings' );
	add_action( 'updated_option', __NAMESPACE__ . '\\handle_update_option', 10, 3 );
	add_action( 'admin_notices', __NAMESPACE__ . '\\check_api_key' );
}

/**
 * Plugin menu page.
 *
 * @return void
 */
function top_news_menu_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	add_submenu_page(
		'options-general.php',
		'Top News Settings',
		'Top News Settings',
		'manage_options',
		'top-news-submenu-page',
		__NAMESPACE__ . '\\top_news_submenu_page_callback'
	);
}

/**
 * Plugin submenu page callback.
 *
 * @return void
 */
function top_news_submenu_page_callback(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1>Top News Settings</h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'tnb_settings' );
			do_settings_sections( 'top-news-submenu-page' );
			submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}

/**
 * Register settings.
 *
 * @return void
 */
function register_settings(): void {
	register_setting(
		'tnb_settings',
		'tnb_settings_api_key',
		[
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		]
	);

	register_setting( 'tnb_settings', 'tnb_settings_cron_schedule' );

	add_settings_field(
		'tnb_cron_schedule_field',
		'Cron Schedule',
		__NAMESPACE__ . '\\cron_schedule_field_callback',
		'top-news-submenu-page',
		'tnb_settings_section'
	);

	add_settings_section(
		'tnb_settings_section',
		'',
		__NAMESPACE__ . '\\tnb_settings_section_callback',
		'top-news-submenu-page'
	);

	add_settings_field(
		'tnb_settings_api_key_field',
		'NewsAPI API Key',
		__NAMESPACE__ . '\\newsapi_api_key_field_html',
		'top-news-submenu-page',
		'tnb_settings_section'
	);
}

/**
 * Render settings section.
 *
 * @return void
 */
function tnb_settings_section_callback(): void {
	echo '<p></p>';
}

/**
 * Render API key field.
 *
 * @return void
 */
function newsapi_api_key_field_html(): void {
	$value = get_option( 'tnb_settings_api_key' );
	echo "<input required type='text' id='tnb_settings_api_key' name='tnb_settings_api_key' value='" . esc_attr( $value ) . "' />";
}

/**
 * Render cron schedule field.
 *
 * @return void
 */
function cron_schedule_field_callback(): void {
	$schedules     = wp_get_schedules();
	$current_value = get_option( 'tnb_settings_cron_schedule', 'twicedaily' );

	echo '<select name="tnb_settings_cron_schedule">';
	foreach ( $schedules as $schedule_slug => $schedule ) {
		echo '<option value="' . esc_attr( $schedule_slug ) . '"' . selected( $current_value, $schedule_slug, false ) . '>' . esc_html( $schedule['display'] ) . '</option>';
	}
	echo '</select>';
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
function handle_update_option( $option_name, $old_value, $value ): void {
	if ( $option_name === 'tnb_settings_api_key' && ! empty( $value ) ) {
		CRON\schedule_import();
	}
}

/**
 * Check API key and display admin notice if it's empty.
 *
 * @return void
 */
function check_api_key(): void {
	$api_key = get_option( 'tnb_settings_api_key' );
	if ( empty( $api_key ) ) {
		?>
		<div class="notice notice-error">
			<p>
				<?php esc_html_e( 'Please enter your NewsAPI API Key.', 'tnb-top-news-admin' ); ?>
			</p>
		</div>
		<?php
	}
}
