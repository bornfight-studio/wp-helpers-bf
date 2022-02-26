<?php

namespace bornfight\wpHelpers\rest;

use bornfight\wpHelpers\helpers\AutoloadHelper;

class RestApiCustomRoutes {
	protected AutoloadHelper $autoload_helper;

	public function __construct() {
		$this->autoload_helper = new AutoloadHelper();
	}

	public function init(): void {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	public function register_rest_routes(): void {
		$namespace = __NAMESPACE__ . '\\routes\\';
		$pattern   = trailingslashit( get_stylesheet_directory() ) . 'app/rest/routes';

		$routes = $this->autoload_helper->get_classes_by_namespace( $namespace, $pattern );

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