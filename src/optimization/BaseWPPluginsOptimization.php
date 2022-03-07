<?php

namespace bornfight\wpHelpers\optimization;

use bornfight\wpHelpers\optimization\wpPlugins\ACFEOptions;
use bornfight\wpHelpers\optimization\wpPlugins\CF7Options;

abstract class BaseWPPluginsOptimization {
	protected function deactivate_acfe_options( array $settings = array() ): void {
		$acfe_options = new ACFEOptions();
		$acfe_options->deactivate( $settings );
	}

	protected function deactivate_cf7_options( array $settings = array() ): void {
		$cf7_options = new CF7Options();
		$cf7_options->deactivate( $settings );
	}
}