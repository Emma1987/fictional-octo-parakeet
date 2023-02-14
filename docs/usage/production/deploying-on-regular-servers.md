# Deploying on a regular server

Although this template was built with the goal of being deployed in production
via a PaaS platform like Digital Ocean's App Platform, it can also be deployed
on a regular server with relative ease.

However, please note that this should only be done if you have a decent level 
of knowledge with Docker and server management. 

You should also be very aware of the security implications that doing this has, 
seeing as host system security is not tackled at all by this template (due to 
DO's App Platform being the primary deployment target).

## Setup

Setting up your project for deployment on a regular server will be very similar
to setting it up for local development, with the following changes:

- You will use the `docker-compose.prod.yml` configuration when running Docker Compose (`-f`).
  - Ex.: `docker-compose -f docker-compose.yml -f docker-compose.prod.yml --env-file .env.local up`
- You will have to ensure your database and session storage is persistent.

To make sure your database storage is persistent, you have two options:

- **Option A:** Run your MySQL and Redis databases as Docker Compose services 
  with persistent volumes.
	- Copy your `database` and `redis` services from your development Compose 
	  config (`docker-compose.override.yml`) to your production config (`docker-compose.prod.yml`).
	- Add a persistent volume for the `redis` service (like the database).
	- Make sure these local volumes are never deleted or moved accidentally.
- **Option B:** Run your MySQL and Redis databases outside of your Docker 
  environment (either directly on your server, or in the cloud with managed 
	databases).

## Deploying updates

To deploy updates, you can:

1. Pull the latest changes to your codebase
   ```bash
	 git pull
	 ```
2. Build the new version of the app
   ```bash
   docker-compose -f docker-compose.yml -f docker-compose.prod.yml --env-file .env.local build
	 ```
3. Launch the new version of the app 
	 ```bash
	 docker-compose -f docker-compose.yml -f docker-compose.prod.yml --env-file .env.local up
	 ```

If needed, this workflow can be automated via any means you like to enable
automated deployments (ex.: webhook, cronjob, etc).
