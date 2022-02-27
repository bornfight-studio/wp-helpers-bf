<?php

namespace bornfight\wpHelpers\adminMenus;

/**
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
abstract class BaseACFAdminMenu extends BaseAdminMenu {
	public function register_menu(): void {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( $this->get_settings() );
		}
	}

	public function get_settings(): array {
		return array(
			'page_title'      => $this->get_page_title(),
			'menu_title'      => $this->get_menu_title(),
			'menu_slug'       => $this->get_menu_slug(),
			'capability'      => $this->get_capability(),
			'position'        => $this->get_position(),
			'parent_slug'     => $this->get_parent_slug(),
			'icon_url'        => $this->get_icon_url(),
			'redirect'        => $this->get_redirect(),
			'post_id'         => $this->get_post_id(),
			'autoload'        => $this->get_autoload(),
			'update_button'   => $this->get_update_button_label(),
			'updated_message' => $this->get_update_button_message(),
		);
	}

	/**
	 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
	 * (string) The slug of another WP admin page. If set, this will become a child page of that parent.
	 *
	 * @return string
	 */
	abstract protected function get_parent_slug(): string;

	/**
	 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
	 * (bool) If set to true, this options page will redirect to the first child page (if a child page exists).
	 * If set to false, this parent page will appear alongside any child pages as its own page. Defaults to true.
	 *
	 * @return bool
	 *
	 */
	abstract protected function get_redirect(): bool;

	/**
	 * @link https://www.advancedcustomfields.com/resources/get_field/
	 * (int|string) The $post_id to save and load values from. Can be set to a numeric post ID (123),
	 * or a string (‘user_2’).
	 * Read more about the available post_id values. Defaults to ‘options’. Added in v5.2.7.
	 * @return int|string
	 */
	protected function get_post_id()  {
		return 'options';
	}

	/**
	 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
	 * (bool) Data saved in the wp_options table is given an "autoload" identifier.
	 * When set to true, WP will automatically load these values within a single SQL
	 * query which can improve page load performance. Defaults to false. Added in v5.2.8.
	 *
	 * @return bool
	 */
	abstract protected function get_autoload(): bool;

	/**
	 * (string) The text displayed on the options page submit button. Added in v5.3.7.
	 *
	 * @return string
	 *
	 */
	protected function get_update_button_label(): string {
		return __('Update', 'acf');
	}

	/**
	 * (string) The message shown above the form after updating the options page. Added in v5.6.0.
	 * @return string
	 */
	protected function get_update_button_message(): string {
		return __("Options Updated", 'acf');
	}
}