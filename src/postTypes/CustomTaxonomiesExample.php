<?php

namespace bornfight\wpHelpers\postTypes;

class CustomTaxonomiesExample extends Taxonomies {
	public function get_namespace(): string {
		return __NAMESPACE__ . '\\customTaxonomies\\';
	}

	public function get_pattern(): string {
		return trailingslashit( get_stylesheet_directory() ) . 'app/postTypes/customTaxonomies';
	}
}