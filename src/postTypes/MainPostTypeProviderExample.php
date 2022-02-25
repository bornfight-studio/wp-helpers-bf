<?php

namespace bornfight\wpHelpers\postTypes;

use bornfight\wpHelpers\services\ServiceInterface;

class MainPostTypeProviderExample implements ServiceInterface {
	public function register(): void {
		$this->register_post_types();
		$this->register_post_type_taxonomies();
	}

	private function register_post_types(): void {
		$post_types = $this->get_classes( 'customPostTypes' );

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
		$taxonomies = $this->get_classes( 'customTaxonomies' );

		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $taxonomy ) {
				$taxonomy_object = new $taxonomy();

				if ( ! empty( $taxonomy_object ) ) {
					$taxonomy_object->register();
				}
			}
		}
	}

	private function get_classes( string $type ): array {
		$namespace = __NAMESPACE__ . '\\' . $type . '\\';
		$pattern   = trailingslashit( get_stylesheet_directory() ) . 'app/postTypes/' . $type;

		return array_map( function ( $class_path ) use ( $namespace ) {
			$class_name  = explode( '/', $class_path );
			$last_item   = end( $class_name );
			$removed_php = str_replace( '.php', '', $last_item );

			return $namespace . $removed_php;
		}, glob( $pattern . '/*.php' ) );
	}
}