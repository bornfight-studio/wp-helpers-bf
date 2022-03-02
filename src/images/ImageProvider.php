<?php

namespace bornfight\wpHelpers\images;

class ImageProvider extends BFImagePluginProvider {
	/**
	 * @param int|null $image_id
	 * @param string|array $image_size
	 *
	 * @return array
	 */
	protected function get_image( ?int $image_id, $image_size ): array {
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

	/**
	 * @param int $post_id
	 * @param string|array $image_size
	 *
	 * @return array
	 */
	protected function get_featured_image( int $post_id, $image_size ): array {
		return $this->get_image( get_post_thumbnail_id( $post_id ), $image_size );
	}

	/**
	 * @param int $attachment_id
	 *
	 * @return string
	 */
	protected function get_attachment_alt_text( int $attachment_id ): string {
		$alt_text = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

		if ( empty( $alt_text ) ) {
			return sanitize_title( get_the_title( $attachment_id ) );
		}

		return $alt_text;
	}
}