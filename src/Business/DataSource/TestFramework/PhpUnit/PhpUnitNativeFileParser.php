<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Business\DataSource\TestFramework\PhpUnit;

use Ivastly\Regrest\Business\Contract\TestFramework\AbleToProvideCoverageInfo;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use Webmozart\Assert\Assert;

class PhpUnitNativeFileParser implements AbleToProvideCoverageInfo
{
	private string $coverageFilePath;

	public function __construct(string $coverageFilePath)
	{
		$this->coverageFilePath = $coverageFilePath;
	}

	public function getCoverageInfo(): array
	{
		/** @var CodeCoverage $coverage */
		$coverage = require $this->coverageFilePath;
		Assert::isInstanceOf($coverage, CodeCoverage::class, 'Coverage report file is invalid.');

		$coveredSourceFileToArrayOfTestsMap = [];
		foreach ($coverage->getData()->lineCoverage() as $file => $lineToTestsArrayMap) {
			$coveredSourceFileToArrayOfTestsMap[$file] = [];
			foreach ($lineToTestsArrayMap as $arrayOfTests) {
				if (is_array($arrayOfTests)) { //Sometimes it is `null` for unknown reason.
					$arrayOfTests                              = array_map(
						function (string $testFQCN)
						{
							return $this->escapeBackslashes($testFQCN);
						},
						$arrayOfTests
					);
					$coveredSourceFileToArrayOfTestsMap[$file] = array_unique(array_merge($coveredSourceFileToArrayOfTestsMap[$file], $arrayOfTests));
				}
			}
		}

		Assert::notEmpty($coveredSourceFileToArrayOfTestsMap, 'Nothing is covered, according to the report.');

		return $coveredSourceFileToArrayOfTestsMap;
	}

	private function escapeBackslashes(string $testFQCN): string
	{
		// Because of shell and double quotes, we always loose a layer of backslashes. That's why there so many.
		return str_replace('\\', '\\\\\\\\', $testFQCN);
	}
}
