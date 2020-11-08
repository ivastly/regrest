<?php

declare(strict_types=1);

use Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit\ClassOne;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit\ClassOne
 */
class ClassOneTest extends TestCase
{
	public function testClassOne(): void
	{
		$sut = new ClassOne();
		self::assertSame(1, $sut->f());
	}
}
