.PHONY: debug run test-phpunit

XDEBUG_OPTIONS=-dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 -dxdebug.remote_host="host.docker.internal" -dxdebug.idekey=IDEKEY -dxdebug.remote_port=9008

debug:
	docker-compose run php php ${XDEBUG_OPTIONS} bin/regrest

run:
	docker-compose run php php  bin/regrest

test-phpunit:
	docker-compose run php php test/Fixtures/PhpProjectUsingPhpunit/vendor/bin/phpunit --colors=always --bootstrap test/Fixtures/PhpProjectUsingPhpunit/vendor/autoload.php test/Fixtures/PhpProjectUsingPhpunit/test/AClassTest.php
