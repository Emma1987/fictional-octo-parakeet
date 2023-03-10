#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'php' ] || [ "$1" = 'bin/console' ] || [ "$1" = '/usr/bin/supervisord' ]; then
	mkdir -p var/cache var/log

	# The first time volumes are mounted, the project needs to be recreated
	if [ ! -f composer.json ]; then
		composer create-project "$SKELETON $SYMFONY_VERSION" tmp --stability="$STABILITY" --prefer-dist --no-progress --no-interaction --no-install

		cd tmp
		composer require "php:>=$PHP_VERSION"
		composer config --json extra.symfony.docker 'false'

		# Remove config files that are already provided by this template
		rm -f .env
		rm -f .env.test
		rm -f docker-compose.yml
		rm -f docker-compose.override.yml
		rm -f config/packages/framework.yaml
		rm -f config/packages/mailer.yaml
		rm -f bin/console
		rm -f public/index.php

		cp -Rp . ..
		cd -

		rm -Rf tmp/
	fi

	if [ "$APP_ENV" != 'prod' ]; then
		rm -f .env.local.php
		composer install --prefer-dist --no-progress --no-interaction
	fi

	if grep -q ^DATABASE_URL= .env; then
		echo "Waiting for db to be ready..."
		ATTEMPTS_LEFT_TO_REACH_DATABASE=60
		until [ $ATTEMPTS_LEFT_TO_REACH_DATABASE -eq 0 ] || DATABASE_ERROR=$(php bin/console dbal:run-sql "SELECT 1" 2>&1); do
			if [ $? -eq 255 ]; then
				# If the Doctrine command exits with 255, an unrecoverable error occurred
				ATTEMPTS_LEFT_TO_REACH_DATABASE=0
				break
			fi
			sleep 1
			ATTEMPTS_LEFT_TO_REACH_DATABASE=$((ATTEMPTS_LEFT_TO_REACH_DATABASE - 1))
			echo "Still waiting for db to be ready... Or maybe the db is not reachable. $ATTEMPTS_LEFT_TO_REACH_DATABASE attempts left"
		done

		if [ $ATTEMPTS_LEFT_TO_REACH_DATABASE -eq 0 ]; then
			echo "The database is not up or not reachable:"
			echo "$DATABASE_ERROR"
			exit 1
		else
			echo "The db is now ready and reachable"
		fi

		if [ "$( find ./migrations -iname '*.php' -print -quit )" ]; then
			php bin/console doctrine:migrations:migrate --no-interaction
		fi

		if [ -n "$GITHUB_JOB" ]; then
			php bin/console doctrine:fixtures:load -n
		fi
	fi

	echo "Setting up cronjobs"
	cat config/cronjobs > /etc/crontabs/root
	echo "" >> /etc/crontabs/root
	echo "Starting the cron deamon"
	crond -b -l 8 -L /proc/1/fd/1

	echo "Ensuring file permissions are adequate"
	chown -R www-data:www-data var public config
	chown www-data:www-data .
fi

exec docker-php-entrypoint "$@"
