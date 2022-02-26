<?php

namespace bornfight\wpHelpers\postTypes;

use bornfight\wpHelpers\helpers\AutoloadHelper;

abstract class PostTypes {
	protected AutoloadHelper $autoload_helper;

	public function __construct() {
		$this->autoload_helper = new AutoloadHelper();
	}

	abstract public function get_namespace(): string;

	abstract public function get_pattern(): string;

	public function register(): void {
		$post_types = $this->autoload_helper->get_classes_by_namespace( $this->get_namespace(), $this->get_pattern() );

		if ( ! empty( $post_types ) ) {
			foreach ( $post_types as $post_type ) {
				$post_type_object = new $post_type();
				if ( ! empty( $post_type_object ) ) {
					$post_type_object->register();
				}
			}
		}
	}


}