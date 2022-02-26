<?php

namespace bornfight\wpHelpers\rest;

abstract class BaseRoute {
	protected function register(): void {
		register_rest_route( $this->get_namespace(), $this->get_route_slug() );
	}

	abstract public function get_namespace(): string;

	abstract public function get_route_slug(): string;

	protected function get_args(): array {
		return array(
			'methods'             => array( 'GET', 'POST' ),
			'callback'            => function () {
				return 'Callback';
			},
			'permission_callback' => '__return_true',
		);
	}
}