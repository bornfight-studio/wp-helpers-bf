<?php

namespace bornfight\wpHelpers\rest;

use bornfight\wpHelpers\helpers\AutoloadHelper;

abstract class RestApiCustomRoutes {
	protected AutoloadHelper $autoload_helper;

	public function __construct() {
		$this->autoload_helper = new AutoloadHelper();
	}

	public function init(): void {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	abstract public function get_namespace(): string;

	abstract public function get_pattern(): string;

	public function register_rest_routes(): void {
		$routes = $this->autoload_helper->get_classes_by_namespace( $this->get_namespace(), $this->get_pattern() );

		if ( ! empty( $routes ) ) {
			foreach ( $routes as $route ) {
				$route_object = new $route();

				if ( ! empty( $route_object ) ) {
					$route_object->register();
				}
			}
		}
	}
}