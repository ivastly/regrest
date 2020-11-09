<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit;

class ClassTwo
{
	public function f(): int
	{
		// This function is fast (see ClassOne::f), unit test will be same fast.

		return 1;
	}
}
