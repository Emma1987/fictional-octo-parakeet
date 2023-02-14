# Cron jobs

Cron jobs run automatically within your container via Unix's native cron daemon.

To define a new cron or to update an existing one:

1. Add the cron's configuration to the `config/cronjobs` file. 
2. Restart your container (no need to re-build).

## Cron logs

Logs for cron jobs are outputted directly in your Docker container's logs.

Monitor these logs to find out about how your crons are going.

### Muting cron output

As with any native crontabs, you may disable any output for a cron job's 
command by redirecting outputs with the `>/dev/null 2>&1` suffix.
