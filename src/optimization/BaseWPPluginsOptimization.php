<?php

namespace bornfight\wpHelpers\optimization;

use bornfight\wpHelpers\optimization\plugins\ACFEOptions;
use bornfight\wpHelpers\optimization\plugins\CF7Options;

abstract class BaseWPPluginsOptimization {
	public function deactivate_acfe_options( array $settings = array() ): void {
		$acfe_options = new ACFEOptions();
		$acfe_options->deactivate( $settings );
	}

	public function deactivate_cf7_options( array $settings = array() ): void {
		$cf7_options = new CF7Options();
		$cf7_options->deactivate( $settings );
	}
}