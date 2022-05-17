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

To be precise, **Regrest detects all test-detectable software defects introduced by changes of "green" code from test coverage report**.
If the defect is introduced by some other changes (e.g. you messed up Dockerfile of some dependency), this tool cannot detect that.


### Prerequisites.
* git as VCS
* fresh coverage report in a machine-readable format


## Usage.

## PHPUnit.
* Make sure coverage report in PHP format `/path/to/coverage.php` is up-to-date.
* Apply your changes to .php files in your project, as usual...
* Pass `regrest` output to PHPUnit's `--filter` option, so only **covering current changes** tests will be run, not all of them.

```bash
phpunit test ..your own phpunit options.. --filter=`docker run ivastly/regrest --changes-since=origin/master --coverage-file=/path/to/coverage.php --framework="phpunit"`
```

## Codeception.
```bash
# TODO
```

## How it works in action.
*TODO gif here*

## Supported test frameworks and coverage formats
Framework | Coverage Format | Language | Support
--- | --- | ---
PHPUnit | PHPUnit .php | PHP | 🟢
Codeception | PHPUnit .php | PHP | 🟡 

## Contributing.
Contributions are welcome.

## License.
see [LICENSE](/LICENSE)
