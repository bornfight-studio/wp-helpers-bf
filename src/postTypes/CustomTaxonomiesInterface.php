<?php

namespace bornfight\wpHelpers\postTypes;

interface CustomTaxonomiesInterface extends CustomPostTypeSettingsInterface {
	public function get_post_types(): array;
}