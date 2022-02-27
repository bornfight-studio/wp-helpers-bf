<?php

namespace bornfight\wpHelpers\optimization\plugins;

use bornfight\wpHelpers\optimization\DeactivateInterface;

class ACFEOptions implements DeactivateInterface {
	public function deactivate( array $settings = array() ): void {
		if ( ! empty( $settings ) && function_exists( 'acf_update_setting' ) ) {
			foreach ( $settings as $option ) {
				add_action( 'acf/init', array( $this, $option ) );
			}
		}
	}

	public function remove_acfe_module_author(): void {
		acf_update_setting( 'acfe/modules/author', false );
	}

	public function remove_acfe_dynamic_block_types(): void {
		acf_update_setting( 'acfe/modules/dynamic_block_types', false );
	}

	public function remove_acfe_dynamic_dynamic_forms(): void {
		acf_update_setting( 'acfe/modules/dynamic_forms', false );
	}

	public function remove_acfe_dynamic_post_type(): void {
		acf_update_setting( 'acfe/modules/dynamic_post_types', false );
	}

	public function remove_acfe_dynamic_taxonomies(): void {
		acf_update_setting( 'acfe/modules/dynamic_taxonomies', false );
	}

	public function remove_acfe_dynamic_options_page(): void {
		acf_update_setting( 'acfe/modules/dynamic_options_pages', false );
	}

	public function remove_acfe_multi_language_support(): void {
		acf_update_setting( 'acfe/modules/multilang', false );
	}

	public function remove_acfe_module_options(): void {
		acf_update_setting( 'acfe/modules/options', false );
	}

	public function remove_acfe_module_taxonomies_enhancements(): void {
		acf_update_setting( 'acfe/modules/taxonomies', false );
	}
}