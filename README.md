# Regrest.
**Regr**ession T**est**ing Tool

## Rationale.
Run tests which cover your current changes only. 
All other tests are almost _guaranteed_ to be green, just because you did not touch the code they test.

* Run just a few tests instead of the whole gigantic test suite without any downsides.
* Test framework, coverage format, platform agnostic.
* Ideal for massive refactoring.
* Checks if the coverage report is stale and throws a warning.
* Inspired by `--changed-since` option of [JEST](https://jestjs.io/docs/en/cli#--changedsince).

## How it works.
* Changed files/lines are extracted from git.
* Current test coverage report is provided via command line option.
* Finally, only relevant tests are run: those tests which cover the changed lines. 

# Use case.
Of course, this is tool **is not a replacement for classic full cycle of all tests during build time**.
Because there is an infinite amount of edge cases when this approach can lead to false positive results:
* configuration changes
* test environment changes
* fixture changes
* usage of `eval`, `rand`, network, etc.

In short, **Regrest detects all software defects introduced by changes of "green" code from test coverage report**.
If the defect is introduced by some other changes (e.g. you messed up Dockerfile of some dependency), this tool cannot detect that.

## Installation.
```bash
git clone https://github.com/ivastly/regrest
ln -s $(pwd)/regrest/bin/regrest /usr/bin/regrest
```

### Prerequisites.
* git as VCS
* fresh coverage report in a machine-readable format


## Usage.
```bash
# PHPUnit
regrest --changes-since=master --coverage-file=/path/to/coverage.json --command="vendor/bin/phpunit" --framework="phpunit"

# Codeception (`test-all` target launches Codeception, @tests placeholder is replaced on-the-fly by the actual list of tests to run)
regrest --changes-since=master --coverage-file=/path/to/coverage.json --command="make tests-all @tests" --framework="codeception"
```

## How it works in action.
*TODO gif here*

## Supported coverage formats.
Format | Support
--- | ---
coverage.json | yes

## Supported frameworks.
Framework | Language | Support
--- | --- | ---
PHPUnit | PHP | yes
Codeception | PHP | yes

## Contributing.
Contributions are welcome.

## License.
see [LICENSE](/LICENSE)
