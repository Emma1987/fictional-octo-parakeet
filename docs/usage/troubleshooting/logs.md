# Logs

The main logs for Caddy, PHP FPM, Symfony's Messenger, MySQL, MailCatcher,
Adminer and Mercure can be found in your regular Docker logs.

Symfony logs are in the `var/log/` directory as usual, but may only be 
accessed from within the Docker container. You can always use `docker-compose exec php tail -n 100 var/log/dev.log` 
to view them from outside the container.
