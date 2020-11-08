<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit;

class AClass
{
	public function f1(): int
	{
		$var1 = 1;
		$var2 = 2;

		return $var1 + $var2;
	}

	public function f2(): int
	{
		$result = 1;

		// This function is running very slow, unit test is same slow.
		sleep(1);

		return $result;
	}
}
