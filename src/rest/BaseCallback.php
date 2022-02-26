<?php

namespace bornfight\wpHelpers\rest;

use WP_REST_Response;
use WP_REST_Request;

abstract class BaseCallback {
	/**
	 * Main Rest callback function
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	abstract public function rest_endpoint( WP_REST_Request $request ): WP_REST_Response;

	/**
	 * Parse and return requested params
	 *
	 * @param WP_REST_Request $request
	 * @param array $params
	 *
	 * @return array
	 */
	protected function get_request_params( WP_REST_Request $request, array $params ): array {
		$request_params = array();
		$query_params   = $request->get_query_params();

		foreach ( $params as $param ) {
			$request_params[ $param[0] ] = isset( $query_params[ $param[0] ] ) && '' !== $query_params[ $param[0] ] ? $query_params[ $param[0] ] : $param[1];
		}

		return $request_params;
	}

	/**
	 * Create url based on params
	 *
	 * @param array $query_params
	 *
	 * @return string
	 */
	protected function create_new_url( array $query_params ): string {
		if ( empty( $query_params['base_url'] ) || empty( $query_params['page'] ) ) {
			return '';
		}

		$base_url = urldecode( $query_params['base_url'] );
		$page     = (int) $query_params['page'];

		if ( $page > 1 ) {
			$base_url .= 'page/' . $page;
		}

		return $base_url;
	}
}