<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit\Test;

use Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit\ClassTwo;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit\ClassTwo
 */
class ClassTwoTest extends TestCase
{
	public function testClassTwo(): void
	{
		$sut = new ClassTwo();
		self::assertSame(1, $sut->f());
	}
}
