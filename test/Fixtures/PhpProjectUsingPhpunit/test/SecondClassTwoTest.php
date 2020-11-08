<?php

declare(strict_types=1);

use Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit\ClassTwo;
use PHPUnit\Framework\TestCase;

class SecondClassTwoTest extends TestCase
{
	public function testClassTwoAgain(): void
	{
		$sut = new ClassTwo();
		self::assertSame(1, $sut->f());
	}
}
