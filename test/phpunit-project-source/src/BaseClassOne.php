<?php

declare(strict_types=1);

class BaseClassOne
{
	private string $baseField;

	protected const CONSTANT = 'constant-value';

	public function __construct(string $baseField)
	{
		$this->baseField = $baseField;
	}

	public function getBaseField(): string
	{
		return $this->baseField;
	}

	public function getConstant(): string
	{
		return self::CONSTANT;
	}
}
