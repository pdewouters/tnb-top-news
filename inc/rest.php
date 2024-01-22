<?php
/**
 * REST API endpoints.
 *
 * @package TNB_Top_News\REST
 **/

declare( strict_types=1 );

namespace TNB_Top_News\REST;

use TNB_Top_News\API;
use WP_REST_Request;
use WP_REST_Server;

/**
 * Setup hooks.
 *
 * @return void
 */
function setup(): void {
	add_action( 'rest_api_init', __NAMESPACE__ . '\register_rest_routes' );
}

/**
 * Register REST routes.
 *
 * @return void
 */
function register_rest_routes(): void {
	\register_rest_route(
		'tnb-top-news/v1',
		'/top-headlines/(?P<country>[a-z]{2})',
		[
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => __NAMESPACE__ . '\top_news_callback',
			'permission_callback' => '__return_true',
		]
	);
}

/**
 * Top news callback.
 *
 * @param WP_REST_Request $request Request object.
 *
 * @return array
 */
function top_news_callback( WP_REST_Request $request ): array {
	$country_code = $request->get_param( 'country' );
	$articles     = API\get_articles( $country_code );
	// Send success header, handle errors on frontend.
	\status_header( 200 );
	if ( empty( $articles ) ) {
		return [
			'data'    => [],
			'error'   => 'No articles found.',
			'success' => false,
		];
	}

	return [
		'data'    => $articles,
		'error'   => '',
		'success' => true,
	];
}
