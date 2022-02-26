<?php

namespace bornfight\wpHelpers\images;

class ImageProvider extends BFImagePluginProvider {
	protected AttachmentHelper $attachment_helper;

	public function __construct() {
		$this->attachment_helper = new AttachmentHelper();
	}

	/**
	 * @param int|null $image_id
	 * @param string|array $image_size
	 *
	 * @return array
	 */
	public function get_image( ?int $image_id, $image_size ): array {
		if ( empty( $image_id ) ) {
			return array();
		}

		if ( is_array( $image_size ) ) {
			return array(
				'url' => $this->get_image_by_custom_size( $image_id, $image_size ),
				'alt' => $this->attachment_helper->get_attachment_alt_text( $image_id ),
			);
		}

		return array(
			'url' => $this->get_image_by_size_name( $image_id, $image_size ),
			'alt' => $this->attachment_helper->get_attachment_alt_text( $image_id ),
		);
	}

	/**
	 * @param int $post_id
	 * @param string|array $image_size
	 *
	 * @return array
	 */
	public function get_featured_image( int $post_id, $image_size ): array {
		return $this->get_image( get_post_thumbnail_id( $post_id ), $image_size );
	}
}