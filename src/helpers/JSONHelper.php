<?php

namespace bornfight\wpHelpers\helpers;

use Exception;

class JSONHelper {
	/**
	 * @link https://stackoverflow.com/a/15198925/629127
	 *
	 * @param string $string
	 *
	 * @return array
	 * @throws Exception
	 */
	public function validate_json_string( string $string ): array {
		$result = json_decode( $string, true );

		switch ( json_last_error() ) {
			case JSON_ERROR_NONE:
				$error = '';
				break;
			case JSON_ERROR_DEPTH:
				$error = esc_html__( 'The maximum stack depth has been exceeded.', 'wp-helpers-bf' );
				break;
			case JSON_ERROR_STATE_MISMATCH:
				$error = esc_html__( 'Invalid or malformed JSON.', 'wp-helpers-bf' );
				break;
			case JSON_ERROR_CTRL_CHAR:
				$error = esc_html__( 'Control character error, possibly incorrectly encoded.', 'wp-helpers-bf' );
				break;
			case JSON_ERROR_SYNTAX:
				$error = esc_html__( 'Syntax error, malformed JSON.', 'wp-helpers-bf' );
				break;
			case JSON_ERROR_UTF8:
				$error = esc_html__( 'Malformed UTF-8 characters, possibly incorrectly encoded.', 'wp-helpers-bf' );
				break;
			case JSON_ERROR_RECURSION:
				$error = esc_html__( 'One or more recursive references in the value to be encoded.', 'wp-helpers-bf' );
				break;
			case JSON_ERROR_INF_OR_NAN:
				$error = esc_html__( 'One or more NAN or INF values in the value to be encoded.', 'wp-helpers-bf' );
				break;
			case JSON_ERROR_UNSUPPORTED_TYPE:
				$error = esc_html__( 'A value of a type that cannot be encoded was given.', 'wp-helpers-bf' );
				break;
			default:
				$error = esc_html__( 'Unknown JSON error occurred.', 'wp-helpers-bf' );
				break;
		}

		if ( $error ) {
			throw new Exception( $error );
		}

		return $result;
	}
}