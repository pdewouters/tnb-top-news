<?php
/**
 * Setup activation/deactivation hooks.
 *
 * @package TNB_Top_News\Activate_Deactivate
 **/

declare( strict_types=1 );

namespace TNB_Top_News\Activate_Deactivate;

use TNB_Top_News\API;
use TNB_Top_News\CRON;
use TNB_Top_News\Utils;
use const TNB_Top_News\FILE;

/**
 * Setup hooks.
 *
 * @return void
 */
function setup(): void {
	register_deactivation_hook( FILE, __NAMESPACE__ . '\\deactivate' );
}

/**
 * Deactivation callback.
 *
 * @return void
 */
function deactivate(): void {
	CRON\clear_scheduled_events();

	foreach ( Utils\COUNTRIES as $country ) {
		\delete_transient( API\TNB_TOP_NEWS_TRANSIENT_KEY . $country );
	}

	\delete_option( 'tnb_settings_api_key' );
	\delete_option( 'tnb_settings_cron_schedule' );
}
