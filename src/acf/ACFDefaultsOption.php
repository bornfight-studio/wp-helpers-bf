<?php

namespace bornfight\wpHelpers\acf;

class ACFDefaultsOption {
	public array $options;

	public function __construct( array $options ) {
		$this->options = $options;
	}

	public function populate_acf_fields_with_options( array $field ): array {
		$field['choices'] = $this->options;

		return $field;
	}
}