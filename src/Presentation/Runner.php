<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Presentation;

use InvalidArgumentException;
use Ivastly\Regrest\Business\DataSource\TestFramework\PhpUnit\PhpUnitNativeFileParser;
use Ivastly\Regrest\Business\DataSource\VCS\GitClient;
use Ivastly\Regrest\Business\Service\Regrest;
use Ivastly\Regrest\Command\RegrestCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class Runner
{
	public function run(
		string $changedSince,
		string $coverageReportPath,
		string $framework,
		string $testRunnerCommandWithPlaceholder,
		OutputInterface $output
	) {

		switch ($framework) {
			case RegrestCommand::PHPUNIT_FRAMEWORK:

				$vcsClient    = new GitClient($changedSince);
				$coverageInfo = new PhpUnitNativeFileParser($coverageReportPath);
				$regrest      = new Regrest($coverageInfo, $vcsClient);

				$testsToRun = $regrest->getListOfTestsToRun();

				$phpUnitFilterOption = implode('|', $testsToRun);

				$command = str_replace('@tests', $phpUnitFilterOption, $testRunnerCommandWithPlaceholder);
				$output->writeln("Running command:");
				$output->writeln($command);

				$process = new Process($command);
				$process->run(
					static function ($type, $buffer) use ($output)
					{
						$output->writeln($buffer);
					}
				);

				break;

			default:
				throw new InvalidArgumentException('Unsupported framework: ' . $framework);
		}
	}
}
