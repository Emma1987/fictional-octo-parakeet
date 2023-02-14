# Testing webhooks locally

If your application relies on webhook calls from third-party services, you'll
find that those webhooks cannot reach your local development environments.

There are two ways to work around that issue:


## Mocking webhook calls from external services

There are two main approaches to this:
  - Create a command or script that calls your local webhook with a random or
    pre-determined datasets, and call it manually when you need it.
  - Create a small utility server that generates random or pre-determined data
    and that calls your local webhook at a certain interval.

When it's realistically possible, this approach should be prioritized because:
- It enables automated testing for webhook-dependent features and UIs.
- It removes the dependency on external services for development purposes.
- It reduces the risk of interacting with production data and services in 
  development environments.


## Use a tunneling service to expose your local environment on the internet

Using a service like [Telebit](https://telebit.cloud/) or [ngrok](https://ngrok.com/) 
allows can make your local development environment available from the internet.

⚠️ **If you do this, make sure you do not have any sensitive data or 
credentials in your local development environment, as it will be accessible
by just about anyone on the internet!** Additionnally, do consider the mocking
option above before jumping to this solution.

This approach is easier to set-up and manage up-front, but it makes your local
environment rely on external services and data (including production data, which
should be kept secure and should not be interacted in testing or development
environments). 

### Caddy configuration
When using an external tunneling service, you'll need to update your `SERVER_NAME`
environment variable to allow Caddy to serve the tunneling domains as well.

Ex.:
```yaml
SERVER_NAME="localhost, caddy:80, *.ngrok.io"
```
