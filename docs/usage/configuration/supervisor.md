# Supervisor

[Supervisor](http://supervisord.org/) is a program that allows us to manage
different processes in a single container and to ensure that these processes
are always up and running.

It is installed and used by default in this template to run Caddy, PHP FPM and 
Symfony's Messenger.

You can find and edit its configuration in the following file:
`docker/php/supervisor/supervisord.conf`.

To learn more about Supervisor, such as how it works and how to configure it,
check out [Supervisor's official documentation](http://supervisord.org/).
