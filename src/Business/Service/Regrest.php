<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Business\Service;

use Ivastly\Regrest\Business\Contract\TestFramework\AbleToProvideCoverageInfo;
use Ivastly\Regrest\Business\Contract\VCS\AbleToListChangedFiles;

class Regrest
{
	private AbleToProvideCoverageInfo $coverageInfo;

	private AbleToListChangedFiles $vcsClient;

	public function __construct(AbleToProvideCoverageInfo $coverageInfo, AbleToListChangedFiles $vcsClient)
	{
		$this->coverageInfo = $coverageInfo;
		$this->vcsClient    = $vcsClient;
	}

	public function getListOfTestsToRun(): array
	{
		$changedSourceFiles                = $this->vcsClient->getChangedFilesPaths();
		$sourceFilesToArrayOfCoveringTests = $this->coverageInfo->getCoverageInfo();

		$testsToRun = [];
		foreach ($changedSourceFiles as $changedFile) {
			if (isset($sourceFilesToArrayOfCoveringTests[$changedFile])) {
				$testsToRun = array_merge($testsToRun, $sourceFilesToArrayOfCoveringTests[$changedFile]);
			}
		}

		return $testsToRun;
	}
}
