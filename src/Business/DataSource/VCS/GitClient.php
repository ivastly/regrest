<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Business\DataSource\VCS;

use GitWrapper\GitWrapper;
use Ivastly\Regrest\Business\Contract\VCS\AbleToListChangedFiles;

class GitClient implements AbleToListChangedFiles
{
	private GitWrapper $git;

	private string $changedSince;

	public function __construct(string $changedSince)
	{
		$this->git          = new GitWrapper();
		$this->changedSince = $changedSince;
	}

	public function getChangedFilesPaths(): array
	{
		$relativePaths = array_filter(explode(PHP_EOL, $this->git->git("diff --name-only {$this->changedSince}")));

		foreach ($relativePaths as &$path) {
			$path = $_SERVER['PWD'] . "/$path";
		}

		return $relativePaths;
	}
}
