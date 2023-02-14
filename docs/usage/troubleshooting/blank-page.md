# Blank page when deployed on DO’s App Platform

If your application shows up as a blank page in your browser, there's a good
chance that your `SERVER_NAME` environment variable is not configured properly.

## In production environments

As our [Deploying to DigitalOcean's App Platform](/docs/usage/production/deploying-to-do-app-platform.md) 
article states:

> The `SERVER_NAME` should specify port 80, to prevent Caddy from handling SSL generation.
> - For example: `app.domain.com:80`
> - DO's App Platform handles the SSL certificate in a layer above the app, 
>   so our service can run as HTTP under the hood.


## In development environments

For development, you shouldn't have to edit the default `SERVER_NAME` value
at all.


## Resources

- https://caddy.community/t/caddy-returns-blank-page-always/14020
