<?php

namespace bornfight\wpHelpers\images;

class AttachmentHelper {
	public function get_attachment_alt_text( int $attachment_id ): string {
		$alt_text = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

		if ( empty( $alt_text ) ) {
			return sanitize_title( get_the_title( $attachment_id ) );
		}

		return $alt_text;
	}

	/**
	 * @param int|null $filesize (bytes)
	 *
	 * @return string
	 */
	public function get_file_size( ?int $filesize ): string {
		if ( empty( $filesize ) ) {
			return '';
		}

		$sizes    = array( 'b', 'kb', 'mb', 'gb' );
		$exponent = floor( log( $filesize ) / log( 1024 ) );

		return sprintf( '%.2f ' . $sizes[ $exponent ], ( $filesize / pow( 1024, floor( $exponent ) ) ) );
	}
}