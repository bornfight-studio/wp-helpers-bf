<?php

namespace bornfight\wpHelpers\menus;

class MenusExample extends BaseMenus {
	const HEADER_MENU_LOCATION = 'header-menu';
	const FOOTER_MENU_LOCATION = 'footer-menu';

	public function get_menus(): array {
		return array(
			self::HEADER_MENU_LOCATION => __( 'Header Menu', 'wp-helpers-bf' ),
			self::FOOTER_MENU_LOCATION => __( 'Footer Menu', 'wp-helpers-bf' ),
		);
	}
}