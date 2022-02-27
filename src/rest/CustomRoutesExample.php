<?php

namespace bornfight\wpHelpers\rest;

use bornfight\wpHelpers\services\Service;

class CustomRoutesExample extends Service {
	public function get_namespace(): string {
		return __NAMESPACE__ . '\\routes\\';
	}

	public function get_pattern(): string {
		return trailingslashit( get_stylesheet_directory() ) . 'app/rest/routes';
	}
}