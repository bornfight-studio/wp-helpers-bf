<?php

namespace bornfight\wpHelpers\postTypes;

use bornfight\wpHelpers\helpers\AutoloadHelper;

abstract class Taxonomies {
	protected AutoloadHelper $autoload_helper;

	public function __construct() {
		$this->autoload_helper = new AutoloadHelper();
	}

	abstract public function get_namespace(): string;

	abstract public function get_pattern(): string;

	public function register(): void {
		$taxonomies = $this->autoload_helper->get_classes_by_namespace( $this->get_namespace(), $this->get_pattern() );

		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $taxonomy ) {
				$taxonomy_object = new $taxonomy();

				if ( ! empty( $taxonomy_object ) ) {
					$taxonomy_object->register();
				}
			}
		}
	}
}