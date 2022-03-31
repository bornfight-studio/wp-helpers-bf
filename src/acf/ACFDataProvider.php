<?php

namespace bornfight\wpHelpers\acf;

/**
 * Class ACFDataProvider
 * @package app\helpers
 */
class ACFDataProvider {
	const OPTION = 'option';

	private static ?ACFDataProvider $instance = null;

	private string $prefix = '';

	private array $fields = [];

	private function __construct() {
	}

	public static function get_instance(): ?ACFDataProvider {
		if ( self::$instance === null ) {
			self::$instance = new ACFDataProvider();
		}

		return self::$instance;
	}


	/**
	 * @param string $name
	 * @param bool $prefixed
	 *
	 * @return bool|mixed|null
	 */
	public function get_option_field( string $name, bool $prefixed = true ) {
		return $this->get_field( $name, self::OPTION, $prefixed );
	}

	/**
	 * @param string $name
	 * @param int|string $post_id
	 * @param bool $prefixed
	 *
	 * @return bool|mixed|null
	 */
	public function get_field( string $name, $post_id = '', bool $prefixed = true ) {
		$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();
		$key     = ( $prefixed ? $this->prefix : '' ) . $name;

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
	 * @param string $prefix
	 *
	 * @return $this
	 */
	public function set_prefix( string $prefix ): ACFDataProvider {
		$this->prefix = $prefix;

		return $this;
	}

	/**
	 * @return $this
	 */
	public function clear_prefix(): ACFDataProvider {
		$this->prefix = '';

		return $this;
	}

	/**
	 * @param int|string $post_id
	 *
	 * @return array|bool
	 */
	public function get_fields( $post_id = '' ) {
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
	 * @param bool $prefixed
	 *
	 * @return bool|mixed|string|null
	 */
	public function get_user_field( string $name, $user_id = null, bool $prefixed = true ) {
		if ( $user_id === null && is_single() ) {
			$user_id = get_the_author_meta( 'ID' );
		}

		if ( $user_id ) {
			return $this->get_field( $name, 'user_' . $user_id, $prefixed );
		}

		return '';
	}

	public function get_archive_field( string $name, string $post_type, bool $prefixed = true ) {
		if ( empty( $post_type ) ) {
			return '';
		}

		return $this->get_field( $name, $post_type . '_archive', $prefixed );
	}
}
