<?php

namespace bornfight\wpHelpers\providers;

class ImageProvider {
	public function get_image( ?int $image_id, array|string $image_size ): array {
		if ( empty( $image_id ) ) {
			return array();
		}

		if ( is_array( $image_size ) ) {
			return array(
				'url' => $this->get_image_by_custom_size( $image_id, $image_size ),
				'alt' => $this->get_attachment_alt_text( $image_id ),
			);
		}

		return array(
			'url' => $this->get_image_by_size_name( $image_id, $image_size ),
			'alt' => $this->get_attachment_alt_text( $image_id ),
		);
	}

	public function get_featured_image( int $post_id, array|string $image_size ): array {
		return $this->get_image( get_post_thumbnail_id( $post_id ), $image_size );
	}

	public function get_attachment_alt_text( int $attachment_id ): string {
		$alt_text = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

		if ( empty( $alt_text ) ) {
			return sanitize_title( get_the_title( $attachment_id ) );
		}

		return $alt_text;
	}

	public function get_image_by_custom_size( int $image_id, array $sizes ): string {
		if ( function_exists( 'bfai_get_image_by_custom_size' ) ) {
			return bfai_get_image_by_custom_size( $image_id, $sizes );
		}

		return wp_get_attachment_url( $image_id );
	}

	public function get_image_by_size_name( int $image_id, string $size_name ): string {
		if ( function_exists( 'bfai_get_image_by_size_name' ) ) {
			return bfai_get_image_by_size_name( $image_id, $size_name );
		}

		return wp_get_attachment_url( $image_id );
	}
}