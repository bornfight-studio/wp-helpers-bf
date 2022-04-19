<?php

namespace bornfight\wpHelpers\blocks\doc;

use bornfight\wpHelpers\blocks\ACFBaseBlocks;
use WP_Block_Editor_Context;

class BlocksExample extends ACFBaseBlocks {
	public function __construct() {
		parent::__construct();

		$this->post_types = array(
			'post',
			'page'
		);
	}

	public function init(): void {
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_filter( 'allowed_block_types_all', array( $this, 'filter_allowed_blocked_types' ), 10, 2 );
		add_filter( 'block_categories_all', array( $this, 'filter_block_categories' ), 10, 2 );
	}

	/**
	 * @param bool|array $allowed_block_types
	 * @param WP_Block_Editor_Context $block_editor_context
	 *
	 * @return array
	 */
	public function filter_allowed_blocked_types( $allowed_block_types, \WP_Block_Editor_Context $block_editor_context ): array {
		return $this->get_all_block_list( array(), $block_editor_context );
	}

	public function get_blocks_thumbnail_path(): string {
		return trailingslashit( get_template_directory_uri() ) . 'block-thumbnails/';
	}

	public function get_blocks_partial( string $slug, array $block ): void {
//		get_partial($slug . '/' . $slug, array( 'block' => $block ), false, 'app/blocks/acfBlocks');
	}

	public function get_default_blocks(): array {
		return array(
			'core/heading',
			'core/paragraph',
			'core/list',
			'core/image',
			'core/shortcode',
		);
	}
}