<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit;

class ClassOne
{
	public function f(): int
	{
		// This function is running very slow, unit test will be same slow.
		sleep(10);

		return 1;
	}
}
