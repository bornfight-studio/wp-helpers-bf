<?php

namespace bornfight\wpHelpers\adminMenus\doc\menus;

use bornfight\wpHelpers\adminMenus\ACFBaseAdminMenu;

class ThemeOptionsExample extends ACFBaseAdminMenu {
	public const MENU_CAPABILITY = 'manage_options';
	public const MENU_SLUG = 'theme-options';
	public const MENU_POSITION = 100;

	protected function get_page_title(): string {
		return esc_html__( 'Theme Options', 'wp-helpers-bf' );
	}

	protected function get_menu_title(): string {
		return esc_html__( 'Theme Options', 'wp-helpers-bf' );
	}

	protected function get_capability(): string {
		return self::MENU_CAPABILITY;
	}

	protected function get_menu_slug(): string {
		return self::MENU_SLUG;
	}

	protected function get_position(): ?int {
		return self::MENU_POSITION;
	}

	protected function get_parent_slug(): null|string {
		return '';
	}

	protected function get_redirect(): bool {
		return false;
	}

	protected function get_autoload(): bool {
		return true;
	}
}