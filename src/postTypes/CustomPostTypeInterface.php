<?php

namespace bornfight\wpHelpers\postTypes;

interface CustomPostTypeInterface extends CustomPostTypeSettingsInterface {
	public function get_post_type_slug(): string;
}