<?php
/**
 * Top News block render callback.
 *
 * @package TNB_Top_News
 */

declare( strict_types=1 );

namespace TNB_Top_News\Country_Top_News;

use TNB_Top_News\API;
use TNB_Top_News\Utils;

$tnb_country_code   = $attributes['countryCode'];
$tnb_articles       = API\get_articles( $tnb_country_code );
$tnb_country_name   = Utils\get_country_name( $tnb_country_code );
$tnb_handle         = generate_block_asset_handle( 'tnb/top-news', 'viewScript' );
$tnb_inline_script  = '';
$tnb_inline_script .= 'if (typeof tnbTopNewsAppData === "undefined") { var tnbTopNewsAppData = {}; }' . PHP_EOL;
$tnb_inline_script .= 'tnbTopNewsAppData.' . $tnb_country_code . ' = ' . \wp_json_encode(
	[
		'articles'    => $tnb_articles,
		'countryName' => $tnb_country_name,
	]
) . ';' . PHP_EOL;

wp_add_inline_script( $tnb_handle, $tnb_inline_script, 'before' );
