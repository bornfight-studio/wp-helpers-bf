<?php

namespace bornfight\wpHelpers\images;

abstract class BFImagePluginProvider {
	public function get_image_by_custom_size( int $image_id, array $sizes ): string {
		if ( function_exists( 'bfai_get_image_by_custom_size' ) ) {
			return bfai_get_image_by_custom_size( $image_id, $sizes );
		}

		return $this->get_attachment_url( $image_id );
	}

	public function get_image_by_size_name( int $image_id, string $size_name ): string {
		if ( function_exists( 'bfai_get_image_by_size_name' ) ) {
			return bfai_get_image_by_size_name( $image_id, $size_name );
		}

		return $this->get_attachment_url( $image_id );
	}

	public function get_attachment_url( int $attachment_id ): string {
		return wp_get_attachment_url( $attachment_id );
	}
}