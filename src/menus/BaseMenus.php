<?php

namespace bornfight\wpHelpers\menus;

abstract class BaseMenus {
	abstract function get_menus(): array;

	public function register(): void {
		register_nav_menus( $this->get_menus() );
	}

	public function get_nav_menu_items_by_location( $location, $args = array() ): ?array {

		$locations = get_nav_menu_locations();

		$location = ! empty( $locations[ $location ] ) ? $locations[ $location ] : '';

		$object = wp_get_nav_menu_object( $location );

		if ( false === $object ) {
			return array();
		}

		$menu_items = wp_get_nav_menu_items( $object->name, $args );

		if ( false === $menu_items ) {
			return array();
		}

		return $menu_items;
	}

	public function menu_hierarchy_create( $location ): array {

		$menu_locations = get_nav_menu_locations();

		if ( empty( $menu_locations[ $location ] ) ) {
			return array();
		}

		$menu = wp_get_nav_menu_object( $menu_locations[ $location ] );

		$menu_items = wp_get_nav_menu_items( $menu->term_id );

		$new_menu_array = array();
		foreach ( (array) $menu_items as $key => $menu_item ) {
			$new_menu_array[ $menu_item->menu_item_parent ][] = $menu_item;
		}

		$new_menu_array1 = array();
		foreach ( (array) $menu_items as $key => $menu_item ) {
			if ( isset( $new_menu_array[ $menu_item->ID ] ) ) {
				$menu_item->sub = $new_menu_array[ $menu_item->ID ];
				if ( 0 === (int) $menu_item->menu_item_parent ) {
					$new_menu_array1[] = $menu_item;
				}
			}
		}

		return array_splice( $new_menu_array[0], 0, 15, $new_menu_array1 );
	}
}