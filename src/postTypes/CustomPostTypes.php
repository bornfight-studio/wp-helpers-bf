<?php

namespace bornfight\wpHelpers\postTypes;

class CustomPostTypes extends PostTypes {
	public function get_namespace(): string {
		return __NAMESPACE__ . '\\customPostTypes\\';
	}

	public function get_pattern(): string {
		return trailingslashit( get_stylesheet_directory() ) . 'app/postTypes/customPostTypes';
	}
}