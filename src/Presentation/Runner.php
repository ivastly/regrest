<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Presentation;

use InvalidArgumentException;
use Ivastly\Regrest\Business\DataSource\TestFramework\PhpUnit\PhpUnitNativeFileParser;
use Ivastly\Regrest\Business\DataSource\VCS\GitClient;
use Ivastly\Regrest\Business\Service\Regrest;
use Ivastly\Regrest\Command\RegrestCommand;
use Symfony\Component\Console\Output\OutputInterface;

class Runner
{
	public function run(
		string $changedSince,
		string $coverageReportPath,
		string $framework,
		OutputInterface $output
	) {
		switch ($framework) {
			case RegrestCommand::PHPUNIT_FRAMEWORK:

				$vcsClient    = new GitClient($changedSince);
				$coverageInfo = new PhpUnitNativeFileParser($coverageReportPath);
				$regrest      = new Regrest($coverageInfo, $vcsClient);

				$testsToRun = $regrest->getListOfTestsToRun();

				if ($testsToRun) {
					$phpUnitFilterOption = '"' . implode('|', $testsToRun) . '"';
				} else {
					$phpUnitFilterOption = 'NOTHING_TO_RUN';
				}

				$output->writeln($phpUnitFilterOption);

				break;

			default:
				throw new InvalidArgumentException('Unsupported framework: ' . $framework);
		}
	}
}
