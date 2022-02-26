<?php

namespace bornfight\wpHelpers\providers;

abstract class TermsDataProvider {
	protected function get_post_terms( int $post_id, string $taxonomy ): array {
		$terms = get_the_terms( $post_id, $taxonomy );

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return array();
		}

		return $terms;
	}

	protected function get_terms( array $args ): array {
		$terms = get_terms( $args );

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return array();
		}

		return $terms;
	}

	protected function get_first_taxonomy( int $post_id, string $taxonomy ): ?object {
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( empty( $terms ) ) {
			return null;
		}

		return get_the_terms( $post_id, $taxonomy )[0];
	}
}