# Regrest
**Regr**ession T**est**ing Tool

## Rationale
Run tests which cover your current changes only. 
All other tests are almost _guaranteed_ to be green, just because you did not touch the code they test.

* Run just a few tests instead of the whole gigantic test suite without any downsides.
* Test framework, coverage format, platform agnostic.
* Ideal for massive refactoring.
* Checks if the coverage report is stale and throws a warning.
* Inspired by `--change-since` option of [JEST](https://jestjs.io/docs/en/cli#--changedsince).

## Installation
```bash
git clone https://github.com/ivastly/regrest
ln -s $(pwd)/regrest/bin/regrest /usr/bin/regrest
```

### Prerequisites
* git as VCS
* fresh coverage report in a machine-readable format


## Usage
```bash
# PHPUnit
regrest --tests-dir=/path/to/tests --changes-since=master --coverage-file=/path/to/coverage.json --command="vendor/bin/phpunit" --framework="phpunit"

# Codeception (`test-all` target launches Codeception, @tests is replaced by the actual list of tests in the `--command` option)
regrest --tests-dir=/path/to/tests --changes-since=master --coverage-file=/path/to/coverage.json --command="make tests-all @tests" --framework="codeception"
```

## How it works in action
*TODO gif here*

## Supported coverage formats
Format | Support
--- | ---
coverage.json | yes

## Supported frameworks
Framework | Language | Support
--- | --- | ---
PHPUnit | PHP | yes
Codeception | PHP | yes
