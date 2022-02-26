<?php

namespace bornfight\wpHelpers\acf;

abstract class ACFDefaultsBase {
	public function add_thumbnails_to_module( array $modules ): void {
		if ( ! empty( $modules ) ) {
			foreach ( $modules as $module_name => $module ) {
				add_filter( 'acfe/flexible/thumbnail/layout=' . $module_name, function () use ( $module_name ) {
					return bu( "module-thumbnails/$module_name.png" );
				}, 10, 3 );
			}
		}
	}
}