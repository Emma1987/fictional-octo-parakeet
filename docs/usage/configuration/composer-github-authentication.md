# GitHub authentication for Composer

If your project requires any private GitHub repositories via Composer, you 
must configure Composer to allow it to authenticate with GitHub.

This can be done by providing a personal access token in the `GITHUB_ACCESS_TOKEN` 
environment variable.

To learn more about how to create a personal access token on GitHub, check out
GitHub's [Creating a personal access token](https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token) article.


Please note that Composer does not need any special privilege, so be sure to 
create that access token with as few privileges as possible (read-only, repo 
access only).
