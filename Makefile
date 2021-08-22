XDEBUG_OPTIONS=-dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 -dxdebug.remote_host="host.docker.internal" -dxdebug.idekey=IDEKEY -dxdebug.remote_port=9008
PHP=docker-compose run php php
PHPUNIT_ROOT=test/Fixtures/PhpProjectUsingPhpunit

.PHONY: run
run:
	@${PHP}  bin/regrest $(command)

.PHONY: debug
debug:
	${PHP} $(XDEBUG_OPTIONS) bin/regrest $(command)

# test regrest <-> PHPUnit, step 1: generate coverage report in .php format
.PHONY: generate-coverage-report-phpunit
generate-coverage-report-phpunit:
	${PHP} $(PHPUNIT_ROOT)/vendor/bin/phpunit --debug --colors=always --bootstrap $(PHPUNIT_ROOT)/vendor/autoload.php --coverage-filter=$(PHPUNIT_ROOT)/src --coverage-php=$(PHPUNIT_ROOT)/test/output/coverage.php --coverage-html=$(PHPUNIT_ROOT)/test/output/coverage.html $(PHPUNIT_ROOT)/test

# change .php code under test/Fixtures/PhpProjectUsingPhpunit/src, otherwise regrest will report NOTHING_TO_RUN

# test regrest <-> PHPUnit, step 2: let regrest generate PHPUnit's `--filter` option to run "meaningful" tests only
.PHONY: run-regrest-phpunit
run-regrest-phpunit:
	@${MAKE} run command="regrest --changed-since=master --coverage-file=test/Fixtures/PhpProjectUsingPhpunit/test/output/coverage.php --framework=phpunit"

# test regrest <-> PHPUnit, step 3: run PHPUnit test suite with populated `--filter` option, so only the tiny portion of all tests is executed.
.PHONY: run-test-suite-with-regrest-phpunit
run-test-suite-with-regrest-phpunit:
	@echo "Run the following command:"
# fish shell
	@echo make regression-test-phpunit options=--filter=\"\(make run-regrest-phpunit\)\"

# Regular PHPUnit test suite run <-- this command relates to one from userland Makefile
.PHONY: regression-test-phpunit
regression-test-phpunit:
	${PHP} $(PHPUNIT_ROOT)/vendor/bin/phpunit --debug --colors=always --bootstrap $(PHPUNIT_ROOT)/vendor/autoload.php --coverage-filter=$(PHPUNIT_ROOT)/src $(options) $(PHPUNIT_ROOT)/test
