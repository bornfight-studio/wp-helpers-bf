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
		if ( function_exists( 'bfai_get_image_by_size_name' ) && $size_name !== 'original' ) {
			return bfai_get_image_by_size_name( $image_id, $size_name );
		}

		return wp_get_attachment_url( $image_id );
	}

	public function get_obj_by_size_name( int $image_id, string $size_name ): array {
		if ( function_exists( 'bfai_get_image_by_size_name' ) && $size_name !== 'original' ) {
			$url  = bfai_get_image_by_size_name( $image_id, $size_name );
			$meta = $this->get_local_image_size( $url );

			return [ $url, $meta[0], $meta[1] ];
		}

		// The attachment metadata already carries the original dimensions.
		// Never getimagesize() a URL here: PHP downloads the whole file, so
		// every render fires loopback HTTP requests for its own uploads.
		$image = wp_get_attachment_image_src( $image_id, 'full' );

		if ( ! empty( $image[0] ) ) {
			return [ $image[0], (int) ( $image[1] ?? 0 ), (int) ( $image[2] ?? 0 ) ];
		}

		return [ (string) wp_get_attachment_url( $image_id ), 0, 0 ];
	}

	/**
	 * Read image dimensions from the local uploads copy of a URL instead of
	 * re-downloading the file over HTTP.
	 *
	 * @return array{0: int, 1: int} width and height, zeros when unknown
	 */
	private function get_local_image_size( string $url ): array {
		$uploads = wp_get_upload_dir();

		if ( ! empty( $uploads['baseurl'] ) && str_starts_with( $url, $uploads['baseurl'] ) ) {
			$path = $uploads['basedir'] . substr( $url, strlen( $uploads['baseurl'] ) );

			if ( is_readable( $path ) ) {
				$meta = wp_getimagesize( $path );

				if ( ! empty( $meta[0] ) ) {
					return [ (int) $meta[0], (int) $meta[1] ];
				}
			}
		}

		return [ 0, 0 ];
	}
}
