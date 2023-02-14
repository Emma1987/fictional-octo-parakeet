# How this template works

This template comes with a Dockerfile and Docker Compose configuration that 
contains all of the basic components you need to create, develop, test and 
deploy your Symfony projects.

## Main application container

The main container for your application is defined in `docker-compose.yml`, and 
is based on the official [`php:x-fpm-alpine` Docker image](https://hub.docker.com/_/php).

Additional dependencies and services are then installed on top of that base image 
(via the `Dockerfile`).

In the end, this main image contains:

- [PHP FPM](https://www.php.net/manual/en/install.fpm.php)
- [Caddy](https://caddyserver.com/), a powerful web server with automatic HTTPS.
- [Coraza](https://coraza.io/), a powerful and performant web application firewall.
- [Supervisor](http://supervisord.org/), a popular process control system.
- A [Mercure](https://mercure.rocks/) hub (built into the Caddy web server).
- UNIX cron daemon.
- Optionally: the `chromium` browser, if it is required by the `eckinox/pdf-bundle` 

This template also comes with predefined configurations for each of these, so 
you don't have to do any sys-admin work to get started. It also contains 
configuration documentation on each of these, so you can refer to it if needed.


## Development containers

The [`docker-compose.override.yml`](/docker-compose.override.yml) file adds 
additional configurations to your main container for development purposes, but
it also adds some containers to make the development experience easier.

Here are the containers it adds:

- A MySQL database;
- [Adminer](https://www.adminer.org/), to manage your development database(s) (PHPMyAdmin alternative)
  - This will be accessible at: http://localhost:8080
- [MailCatcher](https://mailcatcher.me/), to send & view emails without configuring a mail server.
  - This will be accessible at: http://localhost:1080


## Production environment

A `docker-compose.prod.yml` is also present in this template.

It provides production-specific configuration presets, and is meant to be used
when deploying and running your application in a production environment.


## Configuration overview

There are many things you may want to configure when working on your project.

Here are the main configurations you'll likely need to change at some point:

- [Environment variables](/docs/usage/configuration/environment-variables.md) (`.env`, `.env.local` and `.env.test`)
- [Dockerfile](/docs/usage/configuration/server-dockerfile.md) (`Dockerfile`)
- [Docker Compose](/docs/usage/configuration/server-dockerfile.md) (`docker-compose.yml`, `docker-compose.*.yml`)
- [Caddy web server](/docs/usage/configuration/caddy.md) (`docker/caddy/Caddyfile`)
- [Coraza Firewall](/docs/usage/configuration/firewall.md)
- [PHP](/docs/usage/configuration/php.md) (`docker/php/conf.d/`)
- [PHP FPM](/docs/usage/configuration/php.md) (`docker/php/php-fpm.d/`)
- [Supervisor](/docs/usage/configuration/php.md) (`docker/php/supervisor/`)


