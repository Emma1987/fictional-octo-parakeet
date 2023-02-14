# Docker template for Eckinox's Symfony projects

This template is loosely based on [`dunglas/symfony-docker`](https://github.com/dunglas/symfony-docker), 
with lots of opinionated presets and configurations based on the common needs 
of Eckinox's client projects.

Although projects built with this template can run just about anywhere, this
template has been developed with the usage of Digital Ocean's App Platform in mind.

## Prerequisites

Before you begin, please note that this template makes use of Docker and Docker 
Compose. You will therefore need to have some rudimentary Docker knowledge.

If you are not familiar with Docker, please look into Docker training before 
going any further.

Here are some resources that can help you get started:

- [Official Docker documentation & guides](https://docs.docker.com/)
- Community Youtube tutorial: [Docker Tutorial for Beginners](https://www.youtube.com/watch?v=3c-iBn73dDE)

If you understand the basics and want to take your Docker skills to the next 
level, we recommend you check out [Vladislav Supalov's website](https://vsupalov.com/).


## Getting started

You'll find all of the documentation needed to use this template in the 
Documentation section below.

We recommend you get started by reading [How this template works](/docs/usage/getting-started/how-this-template-works.md),
and then either [create a new project](/docs/usage/getting-started/new-project.md) 
or [migrate an existing project](/docs/usage/getting-started/migrate-an-existing-project.md).

You can then refer to the documentation as you run into issues or need more 
information on how to accomplish specific things within your project.

## Documentation

### Usage documentation

Here's everything you need to know to use this template in your project(s).

- **Getting started**
  - [How this template works](/docs/usage/getting-started/how-this-template-works.md)
  - [Creating a new project](/docs/usage/getting-started/new-project.md)
  - [Migrating an existing project](/docs/usage/getting-started/migrate-an-existing-project.md)
- **Configurations**
  - [Environment variables](/docs/usage/configuration/environment-variables.md)
  - [GitHub authentication for Composer](/docs/usage/configuration/composer-github-authentication.md)
  - [Cron jobs](/docs/usage/configuration/cronjobs.md)
  - [Monolog](/docs/usage/configuration/monolog.md)
  - [Symfony Messenger](/docs/usage/configuration/symfony-messenger.md)
  - [Mercure](/docs/usage/configuration/mercure.md)
  - [PHP configurations](/docs/usage/configuration/php.md)
  - [PHP sessions with Redis](/docs/usage/configuration/sessions.md)
  - [Caddy](/docs/usage/configuration/caddy.md)
  - [Coraza Web Application Firewall (security)](/docs/usage/configuration/firewall.md)
  - [Supervisor](/docs/usage/configuration/supervisor.md)
  - [Server dependencies and configurations (Dockerfile)](/docs/usage/configuration/server-dockerfile.md)
- **Development**
  - [Pulling the template's newest changes in your project](/docs/usage/development/pulling-template-changes.md)
  - [Database management with adminer (PHPMyAdmin alternative)](/docs/usage/development/adminer.md)
- **Production environment**
  - [How to deploy to Digital Ocean’s App Platform](/docs/usage/production/deploying-to-do-app-platform.md)
  - [How to deploy to a regular server](/docs/usage/production/deploying-on-regular-servers.md)
- **Testing**
  - [Building & testing in GitHub Actions](/docs/usage/testing/github-actions-workflow.md)
  - [Temporary testing environments](/docs/usage/testing/temporary-testing-environments.md)
- **Troubleshooting**
  - [Logs](/docs/usage/troubleshooting/logs.md)
  - [How to “trust” self-signed SSL certificates](/docs/usage/troubleshooting/ssl-certificates.md)
  - [How to test webhooks locally](/docs/usage/troubleshooting/testing-webhooks-locally.md)
  - [Troubleshooting Mercure](/docs/usage/troubleshooting/mercure.md)
  - **Common problems**
    - [HTTP 403 Unauthorized (firewall blocks requests)](/docs/usage/troubleshooting/firewall.md)
    - [Absolute URLs use HTTP instead of HTTPS in production](/docs/usage/troubleshooting/absolute-url-http-trusted-proxies.md)
    - [Blank page when deployed on DO’s App Platform](/docs/usage/troubleshooting/blank-page.md)

### Maintenance documentation

Here's everything you need to know in order to keep this template up to date 
and to update it as the company's needs change.

- [Watch for updates: what should be updated / maintained over time](/docs/maintenance/watch-for-updates.md)
- [Why we did that: potentially controversial decisions, and why they were made](/docs/maintenance/why-we-did-that.md)
- [Useful resources](/docs/maintenance/resources.md)
