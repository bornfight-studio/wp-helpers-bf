<?php

namespace bornfight\wpHelpers\optimization\defaults;

class GutenbergScripts {
	public function deactivate( array $settings = array() ): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'remove_wp_block_library_css' ), 100 );
	}

	public function remove_wp_block_library_css(): void {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );
	}
}