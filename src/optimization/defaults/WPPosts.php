<?php

namespace bornfight\wpHelpers\optimization\defaults;

class WPPosts {
	public function deactivate( array $settings = array() ): void {
		add_action( 'admin_menu', array( $this, 'remove_default_post_type' ) );
		add_action( 'admin_bar_menu', array( $this, 'remove_default_post_type_menu_bar' ), 999 );

		// Disable Posts REST API Endpoint
		add_filter( 'rest_endpoints', array( $this, 'filter_rest_endpoints' ) );
	}

	public function remove_default_post_type() {
		remove_menu_page( 'edit.php' );
	}

	public function remove_default_post_type_menu_bar( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'new-post' );
	}


	/**
	 * Remove the comments endpoint for the REST API
	 *
	 * @param $endpoints
	 *
	 * @return mixed
	 */
	public function filter_rest_endpoints( $endpoints ) {
		if ( ! empty( $endpoints ) ) {
			foreach ( $endpoints as $key => $endpoint ) {
				if ( strpos( $key, 'posts' ) ) {
					unset( $endpoints[ $key ] );
				}
			}
		}

		return $endpoints;
	}
}