.PHONY: debug run test-phpunit

XDEBUG_OPTIONS=-dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 -dxdebug.remote_host="host.docker.internal" -dxdebug.idekey=IDEKEY -dxdebug.remote_port=9008

debug:
	docker-compose run php php $(XDEBUG_OPTIONS) bin/regrest

run:
	docker-compose run php php  bin/regrest

PHPUNIT_ROOT=test/Fixtures/PhpProjectUsingPhpunit

test-phpunit:
	docker-compose run php php $(PHPUNIT_ROOT)/vendor/bin/phpunit --colors=always --bootstrap $(PHPUNIT_ROOT)/vendor/autoload.php --coverage-filter=$(PHPUNIT_ROOT)/src --coverage-clover=$(PHPUNIT_ROOT)/test/output/clover.xml --coverage-html=$(PHPUNIT_ROOT)/test/output/coverage.html $(PHPUNIT_ROOT)/test/AClassTest.php
