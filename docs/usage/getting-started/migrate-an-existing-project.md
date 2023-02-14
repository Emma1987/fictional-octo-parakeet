# Migrating an existing project

If you have an existing Symfony project that doesn't use Docker, you can 
update it to use this template.

Before you start, make sure your project is tracked with Git and that you
don't have any uncommited or unstashed changes.

Then, follow these steps:

1. Clone the template into a new directory outside of your project: 
   ```bash
   git clone https://github.com/eckinox/symfony-docker-template.git .
   ```
2. Remove the `.git` directory: 
   ```bash
   rm -rf .git
   ```
3. Copy all files from the template into your project's directory: 
   ```bash
   cp -R . /your/project/dir/
   ```
4. In your project, check all of the files that have been modified or deleted
   to ensure that none of your project's changes are being undone.
   - Use `git status` to view all files that have been added/changed/deleted;
   - Use `git diff` or your IDE's diff feature to see a file's changes.
5. Update your `.env.local` file to include the variables defined in the `.env`
   template. 
   - For more information, check out the [Environment Variables docs](/docs/usage/configuration/environment-variables.md).
   - Don't forget `GITHUB_ACCESS_TOKEN`!
6. Run `docker compose --env-file .env.local build --pull --no-cache` to build fresh images.
7. Run `docker compose --env-file .env.local up` (the logs will be displayed in the current shell; 
   use the detached (`-d`) flag to run this in the background).
	 - You'll know the server is ready when the logs indicate that Supervisor is 
	   running. This log sould look a little like this: 
		 ```
		 php-1       | 2022-10-20 18:10:38,639 INFO supervisord started with pid 1
		 ```
9. Open [https://localhost](https://localhost) and [trust the auto-generated TLS 
   certificate](/docs/usage/troubleshooting/ssl-certificates.md)
	 - If you get an HTTP 502 error, wait a few seconds: it means the server is 
	   still booting up. 
10. Test your project to ensure everything works as expected. 
    - You should review any changes in documentation to learn about breaking 
      changes that will require you to change something in your project.
11. Once everything works, stage everything (`git add --a`) and commit the 
    changes.


At that point, you've got a working Symfony project with the Docker setup! Yay!


## File storage

**If your project stored important files locally on your server** (instead of using
a remote file storage service like Amazon S3 or Digital Ocean's Spaces), you'll
have to update your codebase to use one of these and migrate your existing 
files to it before you can go any further. 

Docker containers are ephemereal, and so are the files they contain. This
should not be overlooked: doing so will certainly cause data loss for your 
users.


## Migrating your production environment

To migrate your production environment to this new setup, follow the steps 
below. 

Please note that this will cause downtimes, and that users should be warned not 
to use the platform until the migration is completed to avoid losing data.

1. Follow the appropriate documentation depending on where you'll be deploying:
   - ⚠️ ... but don't change your domain's DNS yet!
   - [How to deploy to Digital Ocean’s App Platform](/docs/usage/production/deploying-to-do-app-platform.md) (recommended)
   - [How to deploy to a regular server](/docs/usage/production/deploying-on-regular-servers.md)
2. Migrate your database's data to your new database. 
   - You can refer to Digital Ocean's [MySQL database migration](https://docs.digitalocean.com/products/databases/mysql/how-to/migrate/)
     article for information on how to do that if you use DO's App Platform.
     - Make sure to delete any unecessary databases before initiating the 
       migration, as all existing databases will be migrated to the DO database 
			 cluster.
     - SSL might have to be unchecked for the migration to work depending on your source database's configuration.
     - On most droplets, the firewall can be turned off for the port `3306` with the following command: `ufw allow 3306`.
       - Make sure to re-enable the firewall after the migration.
1. Configure and test your app using a temporary domain name.
   - If you use DO's App Platform, you can use your app's default hostname.
2. Test your application thouroughly.
3. Once everything is tested and works, configure your real domain (including
   the DNS change).
4. Test everything again on the real domain.

If you followed these steps and everything went according to plan, you now have 
a live production application running with the Docker template. Well done! 🎉
