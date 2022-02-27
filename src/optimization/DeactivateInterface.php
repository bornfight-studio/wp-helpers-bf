<?php

namespace bornfight\wpHelpers\optimization;

interface DeactivateInterface {
	public function deactivate( array $settings = array() ): void;
}