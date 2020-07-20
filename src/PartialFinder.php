<?php

namespace bornfight\wpHelpers;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use Exception;

class PartialFinder {
	/**
	 * @var null|PartialFinder
	 */
	private static $instance = null;

	private $partial_folder;
	private $template_directory_folder;

	private function __construct() {
	}

	/**
	 * @return PartialFinder|null
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new PartialFinder();
		}

		return self::$instance;
	}


	public function set_settings( string $partial_folder, string $template_directory_folder ) {
		$this->partial_folder            = $partial_folder;
		$this->template_directory_folder = $template_directory_folder;

		return $this;
	}

	/**
	 * @param string $partial
	 * @param string $folder
	 *
	 * @return string
	 * @throws Exception
	 */
	public function get_partial_path( string $partial, string $folder = '' ): string {
		if ( empty( $folder ) ) {
			$folder = $this->partial_folder;
		}

		$file_path = $this->template_directory_folder . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $partial . '.php';

		if ( ! file_exists( $file_path ) ) {
			throw new Exception( 'Partial file does not exists: ' . $file_path );
		}

		return $file_path;
	}

	/**
	 * @param string $partial
	 * @param array|null $data
	 * @param bool $return
	 *
	 * @throws Exception
	 */
	public function get_partial( string $partial, array $data = null, bool $return = false ) {
		$file_path = $this->get_partial_path( $partial );

		if ( true === $return ) {
			return $this->get_internal( $file_path, $data );
		}

		$this->render_internal( $file_path, $data );
	}

	// @codingStandardsIgnoreStart

	/**
	 * @param string $_view_file_
	 * @param array|null $_data_
	 */
	private function render_internal( string $_view_file_, array $_data_ = null ) {
		// we use special variable names here to avoid conflict when extracting data

		if ( $_data_ !== null ) {
			extract( $_data_, EXTR_OVERWRITE );
		}

		require $_view_file_;
	}

	/**
	 * @param $_view_file_
	 * @param array|null $_data_
	 *
	 * @return false|string
	 */
	private function get_internal( $_view_file_, array $_data_ = null ) {
		// we use special variable names here to avoid conflict when extracting data
		if ( $_data_ !== null ) {
			extract( $_data_, EXTR_OVERWRITE );
		}

		ob_start();
		ob_implicit_flush( 0 );
		require $_view_file_;

		return ob_get_clean();
	}
	// @codingStandardsIgnoreEnd
}
