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
		'display'  => esc_html__( 'Every Two Minutes', 'tnb-top-news' ),
	];

	return $schedules;
}

/**
 * Schedule news import.
 *
 * @return void
 */
function schedule_import(): void {
	if ( ! wp_next_scheduled( 'import_news_hook' ) ) {
		wp_schedule_event( time(), 'every_two_minutes', 'import_news_hook' );
	}
}

/**
 * Import news articles.
 *
 * @return void
 */
function import_news(): void {
	$base_expiration  = 1 * HOUR_IN_SECONDS;
	$random_extension = wp_rand( 0, 1 * MINUTE_IN_SECONDS );
	$expiration       = $base_expiration + $random_extension;
	foreach ( Utils\COUNTRIES as $country_code => $country_name ) {
		$articles = API\fetch_articles( $country_code );
		if ( empty( $articles ) ) {
			continue;
		}
		set_transient( API\TNB_TOP_NEWS_TRANSIENT_KEY . $country_code, $articles, $expiration );
	}
}
