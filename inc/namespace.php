<?php
/**
 * TNB_Top_News namespace.
 *
 * @package TNB_Top_News
 **/

declare( strict_types=1 );

namespace TNB_Top_News;

/**
 * Init modules.
 *
 * @return void
 */
function setup(): void {
	Blocks\setup();
	REST\setup();
	CRON\setup();
	Activate_Deactivate\setup();

	if ( \is_admin() ) {
		Admin\setup();
	}
}
