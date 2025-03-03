<?php

namespace bornfight\wpHelpers\adminMenus\doc\submenus;
use bornfight\wpHelpers\adminMenus\BaseAdminSubmenu;

class AdminSubmenuExample extends BaseAdminSubmenu {
	public const MENU_CAPABILITY = 'manage_options';
	public const MENU_SLUG = 'bornfight-submenu-slug';
	public const MENU_ICON = 'dashicons-admin-generic';
	public const MENU_POSITION = 100;

	/**
	 * @link https://developer.wordpress.org/reference/functions/add_submenu_page/
	 * Dashboard: index.php
	 * Posts: edit.php
	 * Media: upload.php
	 * Pages: edit.php?post_type=page
	 * Comments: edit-comments.php
	 * Custom Post Types: edit.php?post_type=custom_post_type
	 * Appearance: themes.php
	 * Plugins: plugins.php
	 * Users: users.php
	 * Tools: tools.php
	 * Settings: options-general.php
	 * Network Settings: settings.php
	 *
	 * @return string
	 */
	protected function get_parent_slug(): null|string {
		return 'tools.php';
	}

	protected function get_page_title(): string {
		return esc_html__( 'Bornfigt Options SubPage', 'wp-helpers-bf' );
	}

	protected function get_menu_title(): string {
		return esc_html__( 'Bornfigt Sub Options', 'wp-helpers-bf' );
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

	protected function get_icon_url(): string {
		return self::MENU_ICON;
	}

	protected function get_position(): ?int {
		return self::MENU_POSITION;
	}
}