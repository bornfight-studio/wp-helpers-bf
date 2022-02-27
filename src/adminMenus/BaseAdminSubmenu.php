<?php

namespace bornfight\wpHelpers\adminMenus;

abstract class BaseAdminSubmenu extends BaseAdminMenu {
	public function register_menu(): void {
		add_submenu_page(
			$this->get_parent_slug(),
			$this->get_page_title(),
			$this->get_menu_title(),
			$this->get_capability(),
			$this->get_menu_slug(),
			$this->get_output(),
			$this->get_position(),
		);
	}

	abstract protected function get_parent_slug(): string;
}