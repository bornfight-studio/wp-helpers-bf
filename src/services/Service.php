<?php

namespace bornfight\wpHelpers\services;

abstract class Service extends BaseService implements ServiceInterface {
	public function register(): void {
		$items = $this->get_classes_by_namespace( $this->get_namespace(), $this->get_pattern() );

		if ( ! empty( $items ) ) {
			foreach ( $items as $item ) {
				$item_object = new $item();
				if ( ! empty( $item_object ) ) {
					/**
					 * check if __register method exists
					 * __method is used to hide register as CLI command
					 */
					if ( method_exists( $item_object, '__register' ) ) {
						$item_object->__register();
						continue;
					}
					$item_object->register();
				}
			}
		}
	}

	abstract public function get_namespace(): string;

	abstract public function get_pattern(): string;
}