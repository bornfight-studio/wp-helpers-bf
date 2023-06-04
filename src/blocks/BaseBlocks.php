<?php

namespace bornfight\wpHelpers\blocks;

use WP_Block_Editor_Context;

abstract class BaseBlocks {
	public function init(): void {
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_filter( 'allowed_block_types_all', array( $this, 'filter_allowed_blocked_types' ), 10, 2 );
		add_filter( 'block_categories_all', array( $this, 'filter_block_categories' ), 10, 2 );
	}

	abstract function get_blocks(): array;

	abstract function get_namespace(): string;

	public function register_blocks(): void {
		if ( function_exists( 'acf_register_block_type' ) ) {
			foreach ( $this->get_blocks() as $block ) {
				$class          = $this->get_namespace() . str_replace( '-', '', ucwords( $block, '-' ) );
				$class_instance = new $class();

				if ( method_exists( $class_instance, 'get_settings' ) ) {
					acf_register_block_type( $class_instance->get_settings() );
				}
			}
		}
	}

	/**
	 * @param bool|array $allowed_block_types
	 * @param WP_Block_Editor_Context $block_editor_context
	 *
	 * @return bool|array Boolean if you want to disable or enable all blocks, or a list of allowed blocks.
	 */
	public function filter_allowed_blocked_types( bool|array $allowed_block_types, WP_Block_Editor_Context $block_editor_context ): bool|array {
		$blocks = $this->get_default_blocks();

		foreach ( $this->get_blocks() as $block ) {
			$blocks[] = 'acf/' . $block;
		}

		return $blocks;
	}

	/**
	 * @param array $block_categories
	 * @param WP_Block_Editor_Context $block_editor_context
	 *
	 * @return array
	 */
	public function filter_block_categories( array $block_categories, WP_Block_Editor_Context $block_editor_context ): array {
		if ( ! empty( $block_editor_context->post ) ) {
			$block_categories[] = array(
				'slug'  => 'bornfight-blocks',
				'title' => 'Bornfight',
				'icon'  => null,
			);
		}

		return $block_categories;
	}
}