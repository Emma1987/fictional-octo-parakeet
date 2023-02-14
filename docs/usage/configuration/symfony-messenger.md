# Symfony Messenger

This template comes with a Supervisor config for running the Symfony Messenger.

If you've created your project with the `symfony/website-skeleton`, you should
already have the Messenger bundle installed. If not, install it with Composer:

```bash
composer require symfony/messenger
```

The `[program:messenger]` section in your Supervisor config (`docker/php/supervisor/supervisord.conf`)
is where your server-side Messenger configuration lies.

With the default configuration, Supervisor will run 3 instances of the 
Messenger in the background at all times, and these will consume the `async`
transport.

For more information on how to use the Messenger, refer to the [official 
Symfony documentation](https://symfony.com/doc/current/messenger.html).
