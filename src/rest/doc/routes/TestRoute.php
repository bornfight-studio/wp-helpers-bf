<?php

namespace bornfight\wpHelpers\rest\doc\routes;

use bornfight\wpHelpers\rest\BaseRoute;
use bornfight\wpHelpers\rest\doc\callback\TestCallback;

class TestRoute extends BaseRoute {
	public const ROUTE = 'test-route';

	public function get_route_slug(): string {
		return self::ROUTE;
	}

	public function get_namespace(): string {
		return 'bornfight/v1';
	}

	public function get_args(): array {
		return array(
			'methods'             => array( 'GET' ),
			'callback'            => array(
				new TestCallback(),
				'rest_endpoint'
			),
			'permission_callback' => '__return_true',
		);
	}
}