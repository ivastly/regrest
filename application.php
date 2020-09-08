<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Ivastly\Regrest\Command\RegressionTestCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new RegressionTestCommand());

$application->run();
