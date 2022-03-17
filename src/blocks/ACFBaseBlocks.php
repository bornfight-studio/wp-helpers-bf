<?php

namespace bornfight\wpHelpers\blocks;

use bornfight\wpHelpers\core\PartialFinder;
use Exception;

abstract class ACFBaseBlocks extends BaseBlocks {
	protected array $post_types = array();

	/**
	 * @return string
	 */
	public function get_block_namespace(): string {
		return 'acf/';
	}

	public function get_block_mode(): string {
		return 'edit';
	}

	abstract public function get_blocks_thumbnail_path(): string;

	public function get_block_thumbnail_path( string $block_name ): string {
		return trailingslashit( $this->get_blocks_thumbnail_path() ) . $block_name . '.png';
	}

	/**
	 * @throws Exception
	 */
	public function register_blocks(): void {
		$this->blocks = $this->get_blocks_data();

		if ( ! empty( $this->blocks ) ) {
			foreach ( $this->blocks as $block ) {
				$block['post_type']       = $this->post_types;
				$block['mode']            = $this->get_block_mode();
				$block['render_callback'] = array( $this, 'render' );

				$this->register_block( $block );
			}
		}
	}

	/**
	 * @param array $block
	 */
	public function register_block( array $block ): void {
		if ( function_exists( 'acf_register_block_type' ) ) {
			acf_register_block_type( $block );
		}
	}

	public function render( array $block, string $content = '', bool $is_preview = false, $post_id = 0 ): bool {
		$slug = str_replace( $this->get_block_namespace(), '', $block['name'] );

		if ( $is_preview ) {
			echo $this->get_block_thumbnail( $slug );

			return true;
		}

		PartialFinder::get_instance()->get_partial( $slug . '/' . $slug, array( 'block' => $block ), false, 'app/blocks/acfBlocks' );

		return true;
	}

	public function get_block_thumbnail( string $block_name ): string {
		$path = $this->get_block_thumbnail_path( $block_name );

		return '<img src="' . $path . '" style="width:100%; height:auto;">';
	}

	public function get_blocks_path(): string {
		return get_stylesheet_directory() . '/app/blocks/acfBlocks';
	}
}