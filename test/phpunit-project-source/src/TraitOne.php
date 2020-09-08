<?php

trait TraitOne
{
	public function getClassName(): string
	{
		return get_class($this);
	}
}
