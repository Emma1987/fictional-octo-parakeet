# Environment variables

Environment variable files are where the majority of your configuration work 
will take place. 

The values you define in these files will be used both at build time (if they
are referenced in the `docker-compose.*.yml` file(s)), and at runtime by 
Symfony (and potentially other services).

- `.env` is the default template for environment variables, and is meant to be 
  tracked with Git. It should not contain any sensitive information.
- `.env.local` that will contain all of the real values for your environment. 
  This file should never be tracked by Git, nor should it be made public. 
- `.env.test` can be used to define values for environments where you run 
	automated tests.


## Symfony secrets

Symfony secrets can be used to set and update sensitive environment variables
from one environment to another, especially for production environments.

However, only variables that aren't used in any of the following configurations
can be set through Symfony secrets:

- Dockerfile
- Docker Compose files (`docker-compose.yml`, `docker-compose.prod.yml`, `docker-compose.override.yml`)
- Docker entrypoint script (`docker/php/docker-entrypoint.sh`)
- Docker healthcheck script (`docker/php/docker-healthcheck.sh`)
- Caddyfile (`docker/caddy/Caddyfile`)

## Variables defined by this template

Here is an exhaustive list of the variables defined by this template.

You can check the `.env` file of this template to view the default values.

| Name                      | Purpose                             | How to set it up                                                                                |
|---------------------------|-------------------------------------|-------------------------------------------------------------------------------------------------|
| GITHUB_ACCESS_TOKEN       | Composer authentication             | See [GitHub authentication for Composer](/docs/usage/configuration/composer-github-authentication.md) |
| SERVER_NAME               | Caddy configuration                 | Domain configuration for the web server ([first line of Caddyfile](https://caddyserver.com/docs/quick-starts/https#caddyfile)). Defaults to `localhost`. |
| SYMFONY_VERSION           | Docker configuration                | Defines the version of Symfony to use on a fresh install (use the latest stable version)        |
| APP_ENV                   | Symfony configuration               | Usually `prod` or `dev` ([learn more on Symfony's documentation](https://symfony.com/doc/current/configuration.html#selecting-the-active-environment)) |
| APP_SECRET                | Symfony configuration               | Random hash used for CSRF token generation.                                                     |
| ROUTER_CONTEXT_HOST       | Symfony configuration               | Hostname used for Symfony's [`framework.router.default_uri`](https://symfony.com/doc/current/routing.html#generating-urls-in-commands) config. Used to generate URLs within commands and messenger processes. |
| ROUTER_CONTEXT_SCHEME     | Symfony configuration               | Scheme/protocol used for Symfony's [`framework.router.default_uri`](https://symfony.com/doc/current/routing.html#generating-urls-in-commands) config. Used to generate URLs within commands and messenger processes. |
| ROUTER_CONTEXT_BASE_URL   | Symfony configuration               | Base URL used for Symfony's [`framework.router.default_uri`](https://symfony.com/doc/current/routing.html#generating-urls-in-commands) config. Used to generate URLs within commands and messenger processes. |
| MAILER_DSN                | Symfony configuration               | https://symfony.com/doc/current/mailer.html#transport-setup                                     |
| MESSENGER_TRANSPORT_DSN   | Symfony configuration               | https://symfony.com/doc/current/messenger.html#transports-async-queued-messages                 |
| SYMFONY_DECRYPTION_SECRET | Symfony configuration               | https://symfony.com/doc/current/configuration/secrets.html#deploy-secrets-to-production         |
| DATABASE_URL              | Symfony configuration               | https://symfony.com/doc/current/doctrine.html#configuring-the-database                          |
| MYSQL_HOST                | Database configuration              | Hostname for the app's MySQL database.                                                          |
| MYSQL_USER                | Database configuration              | Username for the app's MySQL database.                                                          |
| MYSQL_PASSWORD            | Database configuration              | Password for the app's MySQL database.                                                          |
| MYSQL_DATABASE            | Database configuration              | Name of the database for the app.                                                               |
| MYSQL_PORT                | Database configuration              | Port for the app's MySQL database.                                                              |
| MYSQL_VERSION             | Database configuration              | Version of the app's MySQL database server.                                                     |
| REDIS_HOST                | PHP sessions                        | Hostname for the Redis database                                                                 |
| REDIS_PASSWORD            | PHP sessions                        | Redis password                                                                                  |
| REDIS_PORT                | PHP sessions                        | Redis port                                                                                      |
| MAILER_SENDER             | Email delivery                      | Email address to use as the FROM address for emails sent by the app.                            |
| MAILER_FROM               | Email delivery                      | Enter the complete FROM to use when sending emails (ex.: `"Your Project Name Here <noreply@eckidev.com>"`) |
| MERCURE_URL               | Real-time client-server updates     | https://symfony.com/doc/current/mercure.html#configuration                                      |
| MERCURE_PUBLIC_URL        | Real-time client-server updates     | https://symfony.com/doc/current/mercure.html#configuration                                      |
| MERCURE_JWT_SECRET        | Real-time client-server updates     | https://symfony.com/doc/current/mercure.html#configuration                                      |
| MERCURE_PUBLISHER_JWT_KEY | Real-time client-server updates     | This should match your `MERCURE_JWT_SECRET` variable. Only specify this in environments without Docker Compose (ex: DO's App Platform) |
| MERCURE_SUBSCRIBER_JWT_KEY | Real-time client-server updates    | This should match your `MERCURE_JWT_SECRET` variable. Only specify this in environments without Docker Compose (ex: DO's App Platform) |
