<?php

namespace bornfight\wpHelpers\optimization\wpPlugins;

class CF7Options {
	public function deactivate( array $settings = array() ): void {
		if ( ! empty( $settings['remove_autop'] ) ) {
			add_filter( 'wpcf7_autop_or_not', '__return_false' );
		}

		if ( ! empty( $settings['remove_scripts_and_styles'] ) ) {
			add_filter( 'wpcf7_load_js', '__return_false' );
			add_filter( 'wpcf7_load_css', '__return_false' );
		}
	}
}