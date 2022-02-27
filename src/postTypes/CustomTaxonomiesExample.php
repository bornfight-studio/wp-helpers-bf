<?php

namespace bornfight\wpHelpers\postTypes;

use bornfight\wpHelpers\services\Service;

class CustomTaxonomiesExample extends Service {
	public function get_namespace(): string {
		return __NAMESPACE__ . '\\customTaxonomies\\';
	}

	public function get_pattern(): string {
		return trailingslashit( get_stylesheet_directory() ) . 'app/postTypes/customTaxonomies';
	}
}