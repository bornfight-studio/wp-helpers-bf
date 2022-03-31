<?php

namespace bornfight\wpHelpers\acf;

abstract class ACFDefaultsBase {
	public function add_thumbnails_to_module( array $modules ): void {
		if ( ! empty( $modules ) ) {
			foreach ( $modules as $module_name ) {
				add_filter( 'acfe/flexible/thumbnail/layout=' . $module_name, function () use ( $module_name ) {
					return bu( "module-thumbnails/$module_name.png" );
				}, 10, 3 );
			}
		}
	}

	public function get_modules(string $modules_path): array {
		return array_map(
			function ( string $module_path ) {
				$exploded_module = explode( '/', $module_path );

				return str_replace( '.php', '', end( $exploded_module ) );
			},
			(array) glob( "{$modules_path}/*.php" )
		);
	}
}