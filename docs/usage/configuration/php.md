# PHP configurations

The PHP configuration for each environment can be configured in the 
`docker/php/conf.d/symfony.*.ini` files, where `*` is the environment name as 
defined in `APP_ENV`.

When changing PHP configurations your local development environment, you'll 
have to re-build your local image for the changes to take effect.


## PHP FPM

PHP FPM can be configured in the `docker/php/php-fpm.d/zz-docker.conf` file.

Just like with the PHP configurations, you'll have to re-build your local image 
for any changes to take effect.


## PHP extensions

To install and configure PHP extensions, take a look at [PHP's base image docs](https://hub.docker.com/_/php) 
to learn more about `docker-php-ext-configure`, `docker-php-ext-install` and `docker-php-ext-enable`.
