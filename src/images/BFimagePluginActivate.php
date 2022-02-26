<?php

namespace bornfight\wpHelpers\images;

abstract class BFimagePluginActivate {
	public function init(): void {
		add_action( 'init', array( $this, 'register_image_sizes' ) );
	}

	public function register_image_sizes(): void {
		if ( function_exists( 'bfai_register_image_sizes' ) ) {
			bfai_register_image_sizes( $this->get_image_sizes() );
		}
	}

	abstract public function get_image_sizes(): array;
}