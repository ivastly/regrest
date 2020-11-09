<?php

declare(strict_types=1);

namespace Ivastly\Regrest\Command;

use InvalidArgumentException;
use Ivastly\Regrest\Presentation\Runner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\Assert\Assert;

class RegrestCommand extends Command
{
	protected static $defaultName = 'regrest';

	private string $changedSince;

	private string $coverageFile;

	private string $command;

	private string $framework;

	public const  PHPUNIT_FRAMEWORK = 'phpunit';
	private const ALL_FRAMEWORKS    = [
		self::PHPUNIT_FRAMEWORK,
	];

	protected function configure(): void
	{
		$this->addOption(
			'changed-since',
			null,
			InputOption::VALUE_REQUIRED,
			'git branch name which is compared against current one.',
			'origin/master'
		);

		$this->addOption(
			'coverage-file',
			null,
			InputOption::VALUE_REQUIRED,
			'Path to file with test coverage information, e.g. /path/to/coverage.json'
		);

		$this->addOption(
			'command',
			null,
			InputOption::VALUE_REQUIRED,
			'CLI command which runs the test suite, e.g. `vendor/bin/phpunit`. This option must comply with `--framework` option.'
		);

		$this->addOption(
			'framework',
			null,
			InputOption::VALUE_REQUIRED,
			'Test Framework name, e.g. `phpunit`'
		);

		$this->setDescription("Run regression test suite.")
			->setHelp("Run tests which cover current changes only.");
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		try {
			$this->readOptions($input);
		}
		catch (InvalidArgumentException $exception) {
			$output->writeln($exception->getMessage());

			return self::FAILURE;
		}

		$runner = new Runner();

		$runner->run(
			$this->changedSince,
			$this->coverageFile,
			$this->framework,
			$this->command,
			$output
		);

		$output->writeln('Done.');

		return self::SUCCESS;
	}

	private function readOptions(InputInterface $input): void
	{
		$this->changedSince = (string)$input->getOption('changed-since');

		if (!$input->getOption('coverage-file')) {
			throw new InvalidArgumentException('--coverage-file option is required.');
		}

		$this->coverageFile = (string)$input->getOption('coverage-file');
		if (!file_exists($this->coverageFile)) {
			throw new InvalidArgumentException("Coverage file {$this->coverageFile} is not readable.");
		}

		if (!$input->getOption('command')) {
			throw new InvalidArgumentException('--command option is required.');
		}
		$this->command = (string)$input->getOption('command');

		if (!$input->getOption('framework')) {
			throw new InvalidArgumentException('framework option is required.');
		}

		$this->framework = (string)$input->getOption('framework');
		Assert::inArray($this->framework, self::ALL_FRAMEWORKS);
	}
}
