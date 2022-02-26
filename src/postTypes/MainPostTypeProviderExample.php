<?php

namespace bornfight\wpHelpers\postTypes;

use bornfight\wpHelpers\helpers\AutoloadHelper;
use bornfight\wpHelpers\services\ServiceInterface;

class MainPostTypeProviderExample implements ServiceInterface {
	protected AutoloadHelper $autoload_helper;

	public function __construct() {
		$this->autoload_helper = new AutoloadHelper();
	}

	public function register(): void {
		$this->register_post_types();
		$this->register_post_type_taxonomies();
	}

	private function register_post_types(): void {
		$namespace = __NAMESPACE__ . '\\customPostTypes\\';
		$pattern   = trailingslashit( get_stylesheet_directory() ) . 'app/postTypes/customPostTypes';

		$post_types = $this->autoload_helper->get_classes_by_namespace( $namespace, $pattern );

		if ( ! empty( $post_types ) ) {
			foreach ( $post_types as $post_type ) {
				$post_type_object = new $post_type();
				if ( ! empty( $post_type_object ) ) {
					$post_type_object->register();
				}
			}
		}
	}

	private function register_post_type_taxonomies(): void {
		$namespace = __NAMESPACE__ . '\\customTaxonomies\\';
		$pattern   = trailingslashit( get_stylesheet_directory() ) . 'app/postTypes/customTaxonomies';

		$taxonomies = $this->autoload_helper->get_classes_by_namespace( $namespace, $pattern );

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