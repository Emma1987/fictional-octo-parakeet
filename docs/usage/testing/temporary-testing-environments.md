# Temporary testing environments

This template comes with configuration for [WebApp.io](https://webapp.io/),
which enables the creation of ephemeral testing environments in each pull 
request.

Every time a pull request is created or updated, a temporary testing 
environment will be created and the link to that environment will be
automatically posted in a comment on the pull request.

This is configured by:
- The `Layerfile` configuration file at the root of the project;
  - This is what allows WebApp.io to create your temporary environments.
- The `webappio-deployment.yaml` workflow configuration file, located in the 
  `.github/workflows/` directory
	- This is what automatically comments the testing environment's URL in your
	  pull requests.

The default `Layerfile` configuration automatically generates database fixtures
(`bin/console doctrine:fixtures:load --append`) if your project has the 
`doctrine/doctrine-fixtures-bundle` package installed.
