# Server configuration and dependencies

If you need to add any configuration or packages to the server, you'll have to
do so either via the `Dockerfile` or the `docker/php/docker-entrypoint.sh` file.

The Dockerfile is for all actions that should happen at build time and be 
cached by Docker. Think server configuration and package installation.

The Entrypoint is for all actions that should happen every time you start your
Docker container. Think starting daemons or waiting for services to be ready.


## Editing the Dockerfile: a few tips

Before you start toying around with the Dockerfile however, make sure you 
have a decent bit of knowledge about Docker and its dockerfiles. 

Here are a few things to keep in mind when adding instructions to your 
Dockerfile:

- Think about Docker's caching:
	- Each instruction in your Dockerfile will create a new layer.
  - The order of operations in the Dockerfile is very important, as it affects 
    Docker's ability to efficiently cache your build process.
- Keep things as static as possible.
  - You want your Docker image build to be the same, no matter which machine 
    you build it on. 
  - The more variables and dynamic variations you add, the more likely it is
    that your builds will vary from one machine to another, which drastically
    reduces the usefulness of Docker containers.


## Alpine Linux

To keep the size of Docker images as low as possible, Alpine Linux is often 
used instead of more common distributions (ex.: Ubuntu).

This does mean that certain packages and utilities have different names or 
are simply not available.

For example, installing new packages is done via `apk` instead of `apt`.  
Ex.:

```bash
apk add chrommium
```


## PHP extensions

To install and configure PHP extensions, take a look at [PHP's base image docs](https://hub.docker.com/_/php) 
to learn more about `docker-php-ext-configure`, `docker-php-ext-install` and `docker-php-ext-enable`.
