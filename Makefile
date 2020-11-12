.PHONY: debug run full-test-phpunit regression-test-phpunit

XDEBUG_OPTIONS=-dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 -dxdebug.remote_host="host.docker.internal" -dxdebug.idekey=IDEKEY -dxdebug.remote_port=9008

debug:
	docker-compose run php php $(XDEBUG_OPTIONS) bin/regrest $(command)

run:
	@docker-compose run php php  bin/regrest $(command)

PHPUNIT_ROOT=test/Fixtures/PhpProjectUsingPhpunit

# generates coverage report
full-test-phpunit:
	docker-compose run php php $(PHPUNIT_ROOT)/vendor/bin/phpunit --debug --colors=always --bootstrap $(PHPUNIT_ROOT)/vendor/autoload.php --coverage-filter=$(PHPUNIT_ROOT)/src --coverage-php=$(PHPUNIT_ROOT)/test/output/coverage.php --coverage-html=$(PHPUNIT_ROOT)/test/output/coverage.html $(PHPUNIT_ROOT)/test

# does not generate coverage
regression-test-phpunit: # one needs to pass output of regrest command to `options` argument
	docker-compose run php php $(PHPUNIT_ROOT)/vendor/bin/phpunit --debug --colors=always --bootstrap $(PHPUNIT_ROOT)/vendor/autoload.php --coverage-filter=$(PHPUNIT_ROOT)/src $(options) $(PHPUNIT_ROOT)/test

full-regrest-demo:
	$(eval FILTER := $(shell make run command="regrest --changed-since=master --coverage-file=test/Fixtures/PhpProjectUsingPhpunit/test/output/coverage.php --framework=phpunit"))
	@echo '.'
	make inception-echo argument="--filter option for PHPUnit: '$(FILTER)'"
	@echo '.'
	make regression-test-phpunit options="--filter '$(FILTER)'";


.PHONY: inseption-echo
inception-echo:
	echo $(argument)

#FILTER=`make run command="regrest --changed-since=master --coverage-file=test/Fixtures/PhpProjectUsingPhpunit/test/output/coverage.php --framework=phpunit"`;
#make regression-test-phpunit options="--filter '$FILTER'";
