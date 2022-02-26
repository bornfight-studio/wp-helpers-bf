<?php

namespace bornfight\wpHelpers\acf;

use WP_Post;

abstract class ACFLinkHelper {
	public function get_link( ?array $link_options = array() ): array {
		if ( empty( $link_options['link_type'] ) ) {
			return array();
		}

		$link_data = array(
			'url'    => '',
			'label'  => ! empty( $link_options['link_label'] ) ? $link_options['link_label'] : '',
			'target' => ! empty( $link_options['new_tab'] ) ? 'target=_blank' : '',
		);

		switch ( $link_options['link_type'] ) {
			case 'internal':
				return $this->get_internal_link_data( $link_options['internal_link'], $link_data );
			case 'external':
				return $this->get_external_link_data( $link_options['external_link'], $link_data );
			case 'anchor':
				return $this->get_anchor_link_data( $link_options['anchor']['modules'] ?? '', $link_data );
		}

		return $link_data;
	}

	protected function get_anchor_link_data( string $anchor, array $link_data ): array {
		if ( empty( $anchor ) ) {
			return $link_data;
		}

		$link_data['url'] = '#' . $anchor;

		return $link_data;
	}

	protected function get_internal_link_data( ?WP_Post $post_data, array $link_data ): array {
		if ( empty( $post_data ) ) {
			return $link_data;
		}

		$link_data['url']   = get_permalink( $post_data );
		$link_data['label'] = ! empty( $link_data['label'] ) ? $link_data['label'] : get_the_title( $post_data );

		return $link_data;
	}

	protected function get_external_link_data( string $url, array $link_data ): array {
		if ( empty( $url ) ) {
			return $link_data;
		}

		$link_data['url'] = $url;

		return $link_data;
	}
}