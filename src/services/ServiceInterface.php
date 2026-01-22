<?php

namespace bornfight\wpHelpers\services;

interface ServiceInterface {
	public function register(): void;
	public function __register(): void;
}