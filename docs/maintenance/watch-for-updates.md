# Watch for updates: what should be updated / maintained over time

## PHP
The main Docker image of this template is based on the [official PHP FPM Alpine image](https://hub.docker.com/_/php). 

The template provides an argument named `PHP_VERSION` which can be changed to 
update the version of PHP that the image is built with.

As PHP evolves and releases newer versions, the default version defined for
`PHP_VERSION` in the `Dockerfile` should be updated to ensure that new projects
run on the latest stable version.

[Learn more about PHP releases](https://www.php.net/supported-versions.php).


## Symfony

This template provides a `SYMFONY_VERSION` argument and environment variable 
that is used to set up new projects.

As newer Long Term Releases of Symfony are released, the default value of this 
variable should be updated to ensure that new projects use the latest stable 
version of Symfony.

[Learn more about Symfony releases](https://symfony.com/releases).


## Caddy
This template installs Caddy on its main container. This installation is done
within the `Dockerfile`.

To update Caddy, simply look at the caddy-docker Alpine Dockerfile and replace 
the relevant bits in the `Dockerfile`.

Here is an example for 2.6: 
https://github.com/caddyserver/caddy-docker/blob/7f509065562f208807c67e0fb8dd9d28788b0d33/2.6/alpine/Dockerfile

When updating Caddy, make sure to look at the change logs and to update any 
default configuration that needs to be updated in the provided `Caddyfile`.

When updating Caddy, the [eckinox/caddy-waf](https://github.com/eckinox/caddy-waf-docker-image/) 
image ([view on Docker Hub](https://hub.docker.com/r/eckinox/caddy-waf)) might 
also need to be updated.

[Learn more about Caddy releases](https://github.com/caddyserver/caddy/releases).


## OWASP Core Rule Set

This template automatically installs the OWASP Core Rule Set and configures 
them for the Coraza WAF Caddy module.

As new versions of the CRS are released, this template should be updated by 
changing the URL from which the CRS archive is downloaded in the `Dockerfile`.

When updating the CRS, you should also make sure to update any overwrite files
in the `docker/caddy/coreruleset-overwrites` directory. To do so, compare the 
changes between the original version's file and the overwrite file, and apply
these same changes to the new version's file.

[Learn more about OWASP CRS releases](https://github.com/coreruleset/coreruleset/releases).
