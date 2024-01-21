<?php
/**
 * Plugin Name:       Tnb Top News
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       tnb-top-news
 * Domain Path:       /languages
 *
 * @package           TNB_Top_News
 */

declare(strict_types=1);

namespace TNB_Top_News;

const DIR = __DIR__;

require_once __DIR__ . '/inc/utils.php';
require_once __DIR__ . '/inc/blocks.php';
require_once __DIR__ . '/inc/rest.php';
require_once __DIR__ . '/inc/api.php';
require_once __DIR__ . '/inc/admin.php';
require_once __DIR__ . '/inc/namespace.php';

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

setup();
