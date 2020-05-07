<?php


namespace bornfight\wpHelpers;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class PostDataProvider {
	public function get_post_data( string $post_type, int $posts_per_page = - 1 ): array {
		$args = [
			'post_type'      => $post_type,
			'posts_per_page' => $posts_per_page,
			'post_status'    => 'publish'
		];

		$query = new \WP_Query( $args );

		$response['max_pages'] = $query->max_num_pages;

		$response['posts'] = $query->get_posts();

		return $response;
	}

	public function get_taxonomy( string $taxonomy, bool $hide_empty = false ) {
		$terms = get_terms( [
			'taxonomy'   => $taxonomy,
			'hide_empty' => $hide_empty
		] );

		return $terms;
	}
}
