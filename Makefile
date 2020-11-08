.PHONY: debug run test-phpunit

XDEBUG_OPTIONS=-dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 -dxdebug.remote_host="host.docker.internal" -dxdebug.idekey=IDEKEY -dxdebug.remote_port=9008

debug:
	docker-compose run php php ${XDEBUG_OPTIONS} application.php regrest

run:
	docker run -it -v $(PWD):/app -w /app php:7.4-cli php  bin/regrest

test-phpunit:
	docker run -it -v $(PWD):/app -w /app php:7.4-cli php test/Fixtures/PhpProjectUsingPhpunit/vendor/bin/phpunit --colors=always --bootstrap test/Fixtures/PhpProjectUsingPhpunit/vendor/autoload.php test/Fixtures/PhpProjectUsingPhpunit/test/AClassTest.php
