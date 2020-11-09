<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Business\Contract\VCS;

interface AbleToListChangedFiles
{
	public function getChangedFilesPaths(): array;
}
