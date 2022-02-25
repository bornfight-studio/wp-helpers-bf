<?php

namespace bornfight\wpHelpers\blocks;

use bornfight\wpHelpers\helpers\JSONHelper;
use WP_Block_Editor_Context;

abstract class BaseBlocks {
	protected JSONHelper $json_helper;
	protected array $blocks;

	public function __construct() {
		$this->json_helper = new JSONHelper();
	}

	/**
	 * Get blocks absolute path
	 *
	 * @return string
	 */
	abstract protected function get_blocks_path(): string;

	/**
	 * @param array $block
	 * @param string $content
	 * @param bool $is_preview
	 * @param int|string $post_id
	 */
	abstract public function render( array $block, string $content = '', bool $is_preview = false, $post_id = 0 ): bool;

	abstract protected function register_blocks(): void;

	abstract protected function register_block( array $block ): void;

	abstract protected function get_default_blocks(): array;

	abstract protected function get_block_namespace(): string;


	/**
	 * Get blocks data
	 *
	 * @return array
	 */
	public function get_blocks_data(): array {
		return array_map(
			function ( string $block_path ) {
				$block = implode( ' ', (array) file( ( $block_path ) ) );
				$block = $this->json_helper->validate_json_string( $block );

				$block['full_name'] = $this->get_block_namespace() . $block['name'];

				return $block;
			},
			(array) glob( "{$this->get_blocks_path()}/*/manifest.json" )
		);
	}

	/**
	 * @param bool|array $allowed_block_types
	 * @param WP_Block_Editor_Context $block_editor_context
	 *
	 * @return bool|array Boolean if you want to disable or enable all blocks, or a list of allowed blocks.
	 */
	public function get_all_block_list( $allowed_block_types, WP_Block_Editor_Context $block_editor_context ) {
		if ( 'boolean' === gettype( $allowed_block_types ) ) {
			return $allowed_block_types;
		}

		$default_blocks = $this->get_default_blocks();
		$custom_blocks  = array_map(
			function ( $block ) {
				return $block['full_name'];
			},
			$this->blocks ?? array()
		);


		return array_merge( $default_blocks, $custom_blocks );
	}

	/**
	 * @param array $block_categories
	 * @param WP_Block_Editor_Context $block_editor_context
	 *
	 * @return array
	 */
	public function filter_block_categories( array $block_categories, WP_Block_Editor_Context $block_editor_context ): array {
		if ( ! empty( $block_editor_context->post ) ) {
			array_push( $block_categories, array(
				'slug'  => 'bornfight-blocks',
				'title' => __( 'Bornfight', 'wp-bornfight-helper' ),
				'icon'  => null,
			) );
		}

		return $block_categories;
	}
}