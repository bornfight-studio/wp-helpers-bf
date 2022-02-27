<?php

namespace bornfight\wpHelpers\optimization;

use bornfight\wpHelpers\optimization\defaults\GutenbergScripts;
use bornfight\wpHelpers\optimization\defaults\WPComments;
use bornfight\wpHelpers\optimization\defaults\WPEmbeds;
use bornfight\wpHelpers\optimization\defaults\WPEmoji;
use bornfight\wpHelpers\optimization\defaults\WPJsDependencies;
use bornfight\wpHelpers\optimization\defaults\WPPosts;

abstract class BaseWPDefaultsOptimization {
	public function deactivate_gutenberg_scripts( array $settings = array() ): void {
		$gutenberg_scripts = new GutenbergScripts();
		$gutenberg_scripts->deactivate( $settings );
	}

	public function deactivate_wp_comments( array $settings = array() ): void {
		$wp_comments = new WPComments();
		$wp_comments->deactivate( $settings );
	}

	public function deactivate_wp_embeds( array $settings = array() ): void {
		$wp_embeds = new WPEmbeds();
		$wp_embeds->deactivate( $settings );
	}

	public function deactivate_wp_emoji( array $settings = array() ): void {
		$wp_emoji = new WPEmoji();
		$wp_emoji->deactivate( $settings );
	}

	public function deactivate_wp_js_dependencies( array $settings = array() ): void {
		$wp_js_dependencies = new WPJsDependencies();
		$wp_js_dependencies->deactivate( $settings );
	}

	public function deactivate_wp_posts( array $settings = array() ): void {
		$wp_posts = new WPPosts();
		$wp_posts->deactivate( $settings );
	}

	public function add_jquery_cdn(): void {
		if ( is_admin() ) {
			return;
		}

		global $wp_scripts;
		if ( isset( $wp_scripts->registered['jquery']->ver ) ) {
			$ver = $wp_scripts->registered['jquery']->ver;
			$ver = str_replace( "-wp", "", $ver );
		} else {
			$ver = '1.12.4';
		}

		wp_register_script( 'google-jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver );
		wp_enqueue_script( 'google-jquery' );
	}
}