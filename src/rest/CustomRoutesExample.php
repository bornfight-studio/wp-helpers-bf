<?php

namespace bornfight\wpHelpers\rest;

class CustomRoutesExample extends RestApiCustomRoutes {
	public function get_namespace(): string {
		return __NAMESPACE__ . '\\routes\\';
	}

	public function get_pattern(): string {
		return trailingslashit( get_stylesheet_directory() ) . 'app/rest/routes';
	}
}