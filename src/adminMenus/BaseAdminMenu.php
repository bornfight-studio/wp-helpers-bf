<?php

namespace bornfight\wpHelpers\adminMenus;

abstract class BaseAdminMenu {
	public function register(): void {
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
	}

	public function register_menu(): void {
		add_menu_page(
			$this->get_page_title(),
			$this->get_menu_title(),
			$this->get_capability(),
			$this->get_menu_slug(),
			$this->get_output(),
			$this->get_icon_url(),
			$this->get_position()
		);
	}

	abstract protected function get_page_title(): string;

	abstract protected function get_menu_title(): string;

	abstract protected function get_capability(): string;

	abstract protected function get_menu_slug(): string;

	protected function get_output(): string|array {
		return 'Hello World';
	}

	protected function get_icon_url(): string {
		return 'dashicons-admin-generic';
	}

	abstract protected function get_position(): ?int;
}
