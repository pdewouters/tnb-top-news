<?php
/**
 * Utility functions.
 *
 * @package TNB_Top_News\Utils
 **/

declare( strict_types=1 );

namespace TNB_Top_News\Utils;

/**
 * Get block wrapper attributes.
 *
 * @param string $country_code Country code.
 *
 * @return string
 */
function get_country_name( string $country_code ): string {
	$countries = [
		'gb' => 'United Kingdom',
		'us' => 'United States',
		'fr' => 'France',
		'in' => 'India',
		'au' => 'Australia',
	];

	return $countries[ $country_code ] ?? '';
}
