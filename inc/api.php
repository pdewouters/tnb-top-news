<?php
/**
 * API Proxy for Top News API.
 *
 * @package TNB_Top_News\API
 **/

declare( strict_types=1 );

namespace TNB_Top_News\API;

const TNB_TOP_NEWS_TRANSIENT_KEY = 'tnb_top_news_';

const BASE_URL                  = 'https://newsapi.org/v2/top-headlines';
const TNB_TOP_NEWS_MAX_ARTICLES = 5;

/**
 * Fetch top news from API.
 *
 * @param string $country_code Country code.
 *
 * @return array
 */
function fetch_articles( string $country_code ): array {
	$results = wp_remote_get(
		add_query_arg(
			[
				'country'  => $country_code,
				'pageSize' => TNB_TOP_NEWS_MAX_ARTICLES,
			],
			BASE_URL
		),
		[
			'headers' => [
				'X-Api-Key'  => get_option( 'newsapi_api_key' ),
				'User-Agent' => 'TNB Top News',
			],
		]
	);

	if ( is_wp_error( $results ) ) {
		return [];
	}
	$response_code = wp_remote_retrieve_response_code( $results );
	if ( 200 !== $response_code ) {
		return [];
	}
	$body = wp_remote_retrieve_body( $results );
	$body = json_decode( $body, true );
	if ( ! isset( $body['articles'] ) ) {
		return [];
	}

	return $body['articles'];
}

/**
 * Fetch articles from cache.
 *
 * @param string $country_code Country code.
 *
 * @return array
 */
function get_articles( string $country_code ): array {
	$articles = \get_transient( TNB_TOP_NEWS_TRANSIENT_KEY . $country_code );
	if ( $articles === false ) {
		return [];
	}

	return $articles;
}
