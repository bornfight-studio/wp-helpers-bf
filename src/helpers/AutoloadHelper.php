<?php

namespace bornfight\wpHelpers\helpers;

class AutoloadHelper {
	public function get_classes_by_namespace( string $namespace, string $pattern ): array {
		return array_map( function ( $class_path ) use ( $namespace ) {
			$class_name  = explode( '/', $class_path );
			$last_item   = end( $class_name );
			$removed_php = str_replace( '.php', '', $last_item );

			return $namespace . $removed_php;
		}, glob( $pattern . '/*.php' ) );
	}
}