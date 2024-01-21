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

$country_code = $attributes['countryCode'];

$articles       = API\get_articles( $country_code );
$country_name   = Utils\get_country_name( $country_code );
$handle         = \generate_block_asset_handle( 'tnb/top-news', 'viewScript' );
$inline_script  = '';
$inline_script .= 'if (typeof tnbTopNewsAppData === "undefined") { var tnbTopNewsAppData = {}; }' . PHP_EOL;
$inline_script .= 'tnbTopNewsAppData.' . $country_code . ' = ' . \wp_json_encode( ['articles' => $articles, 'countryName' => $country_name ] ) . ';' . PHP_EOL;

\wp_add_inline_script( $handle, $inline_script, 'before' );
