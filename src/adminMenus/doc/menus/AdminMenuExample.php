<?php

namespace bornfight\wpHelpers\adminMenus\doc\menus;

use bornfight\wpHelpers\adminMenus\BaseAdminMenu;

class AdminMenuExample extends BaseAdminMenu {
	public const MENU_CAPABILITY = 'manage_options';
	public const MENU_SLUG = 'bornfight-menu-slug';
	public const MENU_POSITION = 100;

	protected function get_page_title(): string {
		return esc_html__( 'Bornfigt Options Page', 'wp-helpers-bf' );
	}

	protected function get_menu_title(): string {
		return esc_html__( 'Bornfigt Options', 'wp-helpers-bf' );
	}

	protected function get_capability(): string {
		return self::MENU_CAPABILITY;
	}

	protected function get_menu_slug(): string {
		return self::MENU_SLUG;
	}

	protected function get_output(): string {
		return esc_html( 'Hello World' );
	}

	protected function get_position(): ?int {
		return self::MENU_POSITION;
	}
}