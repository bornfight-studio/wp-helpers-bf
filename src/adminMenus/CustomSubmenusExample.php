<?php

namespace bornfight\wpHelpers\adminMenus;

use bornfight\wpHelpers\services\Service;

class CustomSubmenusExample extends Service {
	public function get_namespace(): string {
		return __NAMESPACE__ . '\\submenus\\';
	}

	public function get_pattern(): string {
		return trailingslashit( get_stylesheet_directory() ) . 'app/adminMenus/submenus';
	}
}