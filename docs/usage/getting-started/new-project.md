# Creating a new project

1. Clone this template into a new directory: 
   `git clone https://github.com/eckinox/symfony-docker-template.git .`
2. Remove the `.git` directory: `rm -rf .git`
3. Create your `.env.local` file from the `.env` template: 
   `cp .env .env.local`
4. [Create a GitHub access token](https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token) 
   for Composer, and define it in the `GITHUB_ACCESS_TOKEN` variable of your 
   `.env.local` file.
5. Run `docker compose --env-file .env.local build --pull --no-cache` to build fresh images.
6. Run `docker compose --env-file .env.local up` (the logs will be displayed in the current shell; 
   use the detached (`-d`) flag to run this in the background).
	 - You'll know the server is ready when the logs indicate that Supervisor is 
	   running. This log sould look a little like this: 
		 ```
		 php-1       | 2022-10-20 18:10:38,639 INFO supervisord started with pid 1
		 ```
7. Open [https://localhost](https://localhost) and [trust the auto-generated TLS 
   certificate](/docs/usage/troubleshooting/ssl-certificates.md)
	 - If you get an HTTP 502 error, wait a few seconds: it means the server is 
	   still booting up.

At that point, you've got a working Symfony project with the Docker setup! Yay!

You can now follow the [`app-bundle` installation steps](https://github.com/eckinox/app-bundle/blob/master/docs/installation.md),
with the following alterations:

- Skip the "create-project" and database configuration steps (which have 
  already been taken care of).
- Any `bin/console` commands should run inside the container.
  - You can do this with `docker-compose exec`, ex.: `docker-compose exec php bin/console eckinox:security:install`
