<?php

namespace bornfight\wpHelpers\acf;

class ACFDefaultsExample extends ACFDefaultsBase {
	public function init(): void {
		$this->add_thumbnails_to_module( array( 'test_modules' => 'Tes Module' ) );

		// Modules component
		add_filter( 'acf/load_field/key=field_61e88d15c0d2d', array(
			new ACFDefaultsOption( array( 'test_option' => 'Test Option' ) ),
			'populate_acf_fields_with_options'
		) );
	}
}