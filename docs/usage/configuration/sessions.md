# User sessions with Redis

When running a PHP application in Docker, user sessions must be stored using
an external source to prevent them from being destroyed every time the Docker
container is recreated.

The easiest way to do so is to configure user sessions to be stored in a Redis
database.

Here's how to set that up:

1. Import the template-provided `config/sessions.yaml` configuration file at 
   the top of your `config/services.yaml` configuration, like so:
   ```yaml
   imports:
       - { resource: 'sessions.yaml' }
   ```
2. Configure your `REDIS_` environment variables (`REDIS_PASSWORD`, 
   `REDIS_HOST` and `REDIS_PORT`).
   - This template provides a built-in Redis container for development 
     environments. You can leave the default values to connect to that built-in
		 instance of Redis.
