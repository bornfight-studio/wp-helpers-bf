<?php

namespace bornfight\wpHelpers\postTypes;

use bornfight\wpHelpers\services\ServiceInterface;

abstract class BasePostType implements ServiceInterface {

	public function register(): void {
		register_post_type( $this->get_post_type_slug(), $this->get_args() );
	}

	abstract protected function get_args(): array;

	abstract protected function get_post_type_slug(): string;

	protected function get_default_labels( string $label, string $label_plural, string $domain = 'wp-helpers-bf' ): array {
		return array(
			'name'                  => sprintf( __( '%s', $domain ), $label_plural ),
			'singular_name'         => sprintf( __( '%s', $domain ), $label ),
			'all_items'             => sprintf( __( 'All %s', $domain ), $label_plural ),
			'menu_name'             => sprintf( _x( '%s', 'Admin menu name', $domain ), $label_plural ),
			'add_new'               => __( 'Add New', $domain ),
			'add_new_item'          => sprintf( __( 'Add new %s', $domain ), $label ),
			'edit'                  => __( 'Edit', $domain ),
			'edit_item'             => sprintf( __( 'Edit %s', $domain ), $label ),
			'new_item'              => sprintf( __( 'New %s', $domain ), $label ),
			'view_item'             => sprintf( __( 'View %s', $domain ), $label ),
			'view_items'            => sprintf( __( 'View %s', $domain ), $label_plural ),
			'search_items'          => sprintf( __( 'Search %s', $domain ), $label_plural ),
			'not_found'             => sprintf( __( 'No %s found', $domain ), $label_plural ),
			'not_found_in_trash'    => sprintf( __( 'No %s found in trash', $domain ), $label_plural ),
			'parent'                => sprintf( __( 'Parent %s', $domain ), $label ),
			'featured_image'        => sprintf( __( '%s image', $domain ), $label ),
			'set_featured_image'    => sprintf( __( 'Set %s image', $domain ), $label ),
			'remove_featured_image' => sprintf( __( 'Remove %s image', $domain ), $label ),
			'use_featured_image'    => sprintf( __( 'Use as %s image', $domain ), $label ),
			'insert_into_item'      => sprintf( __( 'Insert into %s', $domain ), $label ),
			'uploaded_to_this_item' => sprintf( __( 'Uploaded to this %s', $domain ), $label ),
			'filter_items_list'     => sprintf( __( 'Filter %s', $domain ), $label_plural ),
			'items_list_navigation' => sprintf( __( '%s navigation', $domain ), $label_plural ),
			'items_list'            => sprintf( __( '%s list', $domain ), $label_plural ),
		);
	}

	protected function get_default_args( array $labels ): array {
		return array(
			'labels'              => $labels,
			'description'         => '',
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'public'              => true,
			'show_ui'             => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => false, // Hierarchical causes memory issues - WP loads all records!
			'rewrite'             => array(
				'with_front' => false,
				'slug'       => $this->get_post_type_slug(),
			),
			'query_var'           => true,
			'has_archive'         => false,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'menu_icon'           => null,
			'acfe_admin_archive'  => false,
		);
	}
}