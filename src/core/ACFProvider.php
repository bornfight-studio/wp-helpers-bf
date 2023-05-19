<?php

namespace bornfight\wpHelpers\core;

class ACFProvider {
	const OPTION = 'option';

	private static ?ACFProvider $instance = null;

	private array $fields = [];

	private function __construct() {}

	public static function get_instance(): ?ACFProvider {
		if ( self::$instance === null ) {
			self::$instance = new ACFProvider();
		}

		return self::$instance;
	}

	/**
	 * @param string $name
	 *
	 * @return bool|mixed|null
	 */
	public function get_option_field( string $name ): mixed {
		return $this->get_field( $name, self::OPTION );
	}

	/**
	 * @param string $name
	 * @param int|string $post_id
	 *
	 * @return bool|mixed|null
	 */
	public function get_field( string $name, int|string $post_id = '' ): mixed {
		$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();
		$key     = $name;

		$cache_key        = 'field_' . $key . '_' . $post_id;
		$fields_cache_key = 'fields_' . $post_id;

		if ( isset( $this->fields[ $cache_key ] ) ) {
			return $this->fields[ $cache_key ];
		} elseif ( isset( $this->fields[ $fields_cache_key ] ) && isset( $this->fields[ $fields_cache_key ][ $key ] ) ) {
			return $this->fields[ $fields_cache_key ][ $key ];
		}

		$this->fields[ $cache_key ] = get_field( $key, $post_id );

		return $this->fields[ $cache_key ];
	}

	/**
	 * @param int|string $post_id
	 *
	 * @return array|bool
	 */
	public function get_fields( int|string $post_id = '' ): bool|array {
		$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();
		$key     = 'fields_' . $post_id;
		if ( isset( $this->fields[ $key ] ) ) {
			return $this->fields[ $key ];
		}
		$this->fields[ $key ] = get_fields( $post_id );

		return $this->fields[ $key ];
	}

	/**
	 * @param string $name
	 * @param null $user_id
	 *
	 * @return bool|mixed|string|null
	 */
	public function get_user_field( string $name, $user_id = null ): mixed {
		if ( $user_id === null && is_single() ) {
			$user_id = get_the_author_meta( 'ID' );
		}

		if ( $user_id ) {
			return $this->get_field( $name, 'user_' . $user_id );
		}

		return '';
	}

	public function get_archive_field( string $name, string $post_type ): mixed {
		if ( empty( $post_type ) ) {
			return '';
		}

		return $this->get_field( $name, $post_type . '_archive' );
	}
}
