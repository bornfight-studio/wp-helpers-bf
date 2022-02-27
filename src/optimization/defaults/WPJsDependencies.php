<?php

namespace bornfight\wpHelpers\optimization\defaults;

use bornfight\wpHelpers\optimization\DeactivateInterface;

class WPJsDependencies implements DeactivateInterface {
	public function deactivate( array $settings = array() ): void {
		if ( ! empty( $settings['remove_jquery_migrate'] ) ) {
			add_action( 'wp_default_scripts', [ $this, 'remove_jquery_migrate' ] );
		}

		if ( ! empty( $settings['remove_jquery_migrate_admin'] ) ) {
			add_action( 'wp_default_scripts', [ $this, 'remove_jquery_migrate_admin' ] );
		}

		if ( ! empty( $settings['remove_jquery_on_front'] ) ) {
			add_filter( 'wp_enqueue_scripts', [ $this, 'remove_jquery_on_front' ] );
		}
	}

	public function remove_jquery_on_front(): void {
		wp_dequeue_script( 'jquery' );
		wp_deregister_script( 'jquery' );
	}

	public function remove_jquery_migrate( $scripts ): void {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			if ( $script->deps ) {
				// Check whether the script has any dependencies

				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
		}
	}

	public function remove_jquery_migrate_admin( $scripts ): void {
		if ( is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			if ( $script->deps ) {
				// Check whether the script has any dependencies

				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
		}
	}
}