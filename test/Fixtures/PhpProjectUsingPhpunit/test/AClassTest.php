<?php

declare(strict_types=1);

use Ivastly\Regrest\Test\Fixtures\PhpProjectUsingPhpunit\AClass;
use PHPUnit\Framework\TestCase;

class AClassTest extends TestCase
{
	private AClass $sut;

	protected function setUp(): void
	{
		$this->sut = new AClass();
	}

	public function testF1(): void
	{
		self::assertSame(3, $this->sut->f1());
	}

	public function testF2(): void
	{
		self::assertSame(1, $this->sut->f2());
	}
}
