<?php

namespace bornfight\wpHelpers\helpers;

class FileHelper {
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