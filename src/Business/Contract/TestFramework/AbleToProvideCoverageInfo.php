<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Business\Contract\TestFramework;

interface AbleToProvideCoverageInfo
{
	/**
	 * @return array [<source file path> => <array of test file paths covering it>]
	 */
	public function getCoverageInfo(): array;
}
