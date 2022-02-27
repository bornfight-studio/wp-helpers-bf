<?php

namespace bornfight\wpHelpers\rest;

abstract class BaseRoute {
	public function register(): void {
		add_action( 'rest_api_init', array( $this, 'register_route' ) );
	}

	protected function register_route(): void {
		register_rest_route( $this->get_namespace(), $this->get_route_slug(), $this->get_args() );
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