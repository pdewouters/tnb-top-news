<?php
/**
 * Schedule news import.
 *
 * @package TNB_Top_News\CRON
 **/

declare( strict_types=1 );

namespace TNB_Top_News\CRON;

use TNB_Top_News\API;
use TNB_Top_News\Utils;

/**
 * Setup cron.
 *
 * @return void
 */
function setup(): void {
	add_action( 'init', __NAMESPACE__ . '\\schedule_import' );
	add_action( 'import_news_hook', __NAMESPACE__ . '\\import_news' );
	// phpcs:ignore WordPress.WP.CronInterval
	add_filter( 'cron_schedules', __NAMESPACE__ . '\\add_cron_interval' );
	// see https://github.com/WordPress/WordPress-Coding-Standards/issues/1865.
}

/**
 * Add custom cron interval.
 *
 * @param array $schedules Cron schedules.
 *
 * @return array
 */
function add_cron_interval( array $schedules ): array {
	$schedules['every_two_minutes'] = [
		'interval' => 2 * MINUTE_IN_SECONDS,
		'display'  => esc_html__( 'Every Two Minutes', 'tnb-top-news-admin' ),
	];

	return $schedules;
}

/**
 * Schedule news import.
 *
 * @return void
 */
function schedule_import(): void {
	$api_key  = get_option( 'tnb_settings_api_key' );
	$schedule = \get_option( 'tnb_settings_cron_schedule' );
	if ( empty( $api_key ) ) {
		return;
	}
	if ( ! wp_next_scheduled( 'import_news_hook' ) ) {
		wp_schedule_event( time(), $schedule, 'import_news_hook' );
	}
}

/**
 * Import news articles.
 *
 * @return void
 */
function import_news(): void {
	foreach ( Utils\COUNTRIES as $country_code => $country_name ) {
		$articles = API\fetch_articles( $country_code );
		if ( empty( $articles ) ) {
			continue;
		}
		// Do not expire.
		set_transient( API\TNB_TOP_NEWS_TRANSIENT_KEY . $country_code, $articles );
	}
}

/**
 * Clear scheduled events.
 *
 * @return void
 */
function clear_scheduled_events(): void {
	wp_clear_scheduled_hook( 'import_news_hook' );
}
