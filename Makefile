.PHONY: debug run

XDEBUG_OPTIONS=-dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 -dxdebug.remote_host="host.docker.internal" -dxdebug.idekey=IDEKEY -dxdebug.remote_port=9008

debug:
	docker-compose run php php ${XDEBUG_OPTIONS} application.php

run:
	# TODO
