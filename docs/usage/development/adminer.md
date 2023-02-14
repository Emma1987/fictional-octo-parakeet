# Managing databases with Adminer

In development environments, [Adminer](https://www.adminer.org/) is provided
to help you navigate and manage your app's database.

To access it, just open [`localhost:8080`](https://localhost:8080) in your web
browser and log in with your database connection information:

- **System:** MySQL
- **Server:** value of `MYSQL_HOST` (should be `database`)
- **Username:** value of `MYSQL_USER` (should be `dbuser`)
- **Password:** value of `MYSQL_PASSWORD` (should be `pleasechangeme`)
- **Database:** value of `MYSQL_DATABASE` (default: `app`)

If you're used to PHPMyAdmin or other apps of the sort, Adminer may seem a bit
different, but rest assured: it offers all of the basic tools you need to 
browse and manage your development database. 
