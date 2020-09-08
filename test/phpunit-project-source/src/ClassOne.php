<?php

declare(strict_types=1);

class ClassOne extends BaseClassOne implements InterfaceOne
{
	use TraitOne;

	private string $field;

	public function __construct(string $baseField, string $field)
	{
		parent::__construct($baseField);
		$this->field = $field;
	}

	public function getField(): string
	{
		return $this->field;
	}
}
