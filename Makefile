.PHONY: debug run test-phpunit

XDEBUG_OPTIONS=-dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 -dxdebug.remote_host="host.docker.internal" -dxdebug.idekey=IDEKEY -dxdebug.remote_port=9008

debug:
	docker-compose run php php $(XDEBUG_OPTIONS) bin/regrest $(command)

run:
	docker-compose run php php  bin/regrest $(command)

PHPUNIT_ROOT=test/Fixtures/PhpProjectUsingPhpunit

test-phpunit:
	docker-compose run php php $(PHPUNIT_ROOT)/vendor/bin/phpunit --debug --colors=always --bootstrap $(PHPUNIT_ROOT)/vendor/autoload.php --coverage-filter=$(PHPUNIT_ROOT)/src --coverage-php=$(PHPUNIT_ROOT)/test/output/coverage.php --coverage-html=$(PHPUNIT_ROOT)/test/output/coverage.html $(PHPUNIT_ROOT)/test
