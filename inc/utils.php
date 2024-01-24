<?php
/**
 * Utility functions.
 *
 * @package TNB_Top_News\Utils
 **/

declare( strict_types=1 );

namespace TNB_Top_News\Utils;

const COUNTRIES = [
	'gb' => 'United Kingdom',
	'us' => 'United States',
	'fr' => 'France',
	'in' => 'India',
	'au' => 'Australia',
];

/**
 * Get block wrapper attributes.
 *
 * @param string $country_code Country code.
 *
 * @return string
 */
function get_country_name( string $country_code ): string {
	return COUNTRIES[ $country_code ] ?? '';
}
