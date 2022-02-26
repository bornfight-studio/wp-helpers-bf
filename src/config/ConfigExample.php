<?php

namespace bornfight\wpHelpers\config;

class ConfigExample implements ConfigInterface {
	public static function get_api_namespace(): string {
		return 'bornfight/v1';
	}
}