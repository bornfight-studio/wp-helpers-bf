<?php

namespace bornfight\wpHelpers\postTypes;

interface CustomPostTypeSettingsInterface {
	public function get_labels(): array;

	public function get_args(): array;
}