# Why we did that: potentially controversial decisions, and why they were made

This template contains a few very opinionated design decisions that could 
protentially be controversial. This article aims to point out these decisions 
and explain the thought process behind each of them.

Before you start undoing or changing one of the things that are mentioned in 
this article, make sure you have a very good understanding of:

- The design decision that was made;
- The technologies involved;
- The contexts in which this template is used;
- The contexts in which the projects based on this template are used.

## Production: Digital Ocean's App Platform 

The primary target for production deployments of this template is 
DigitalOcean's App Platform. 

The main reasons for that decision are that:

- Keeping servers up-to-date and secure is a difficult task at Eckinox.
  - There are no sys-admins or infrastructure folks on the team to manage the
    servers and deployment flows for our software projects.
  - Additionnally, the decision was made by Eckinox and its employees to not 
    invest into training the team to manage servers, as it's simply not of
		interest to most of the team, and it doesn't provide much value to clients
		compared to alternatives.
- Manual deployments are often slow and error-prone.
- Zero downtime deployments with fallbacks on older versions in case of errors
  is valuable to Eckinox's software clients.
- DigitalOcean is already used at Eckinox (droplets, file storage, etc.).
- The pricing of DigitalOcean's App Platform is similar to the pricing of the 
  Droplets that it will replace.


## Docker: running as root

Running as root within a Docker container is generally frowned upon. 

The main source of danger is escaping the container. An example of that would
be a bad actor discovering a vulnerability in Docker or in our specific image
which allows them to break out of the container and into the host's system. 
There's no way around it: this is indeed a scary thing to think about.

However, let's take a look at the contexts in which this template is built to 
be used in:

- In production, this is meant to be deployed on DigitalOcean's App Platform.
  - In this context, we are not responsible for the host system: DigitalOcean 
  	is. And as with any reputable PaaS provider, we can safely expect that DO
		is doing everything they can to keep their systems secure.
- In development, this container is meant to run locally.
  - In this context, the container is not exposed to the rest of the world: it
    is therefore safe from bad actors (unless the bad actors have access to 
		your machine, at which point this is a non-issue to begin with).

This design decision would have to be reconsidered if the target production 
hosting environment changed. 

### Other considerations

Of course, if running as a user with fewer privileges was not an issue, this is
what this template would do. 

However, some complexity around user privileges arise due to:

- Multiple processes running in the same container via Supervisor.
- Privileges of created/modified files being incorrect when acting as another 
  user (`su`) in some contexts.
	- More info on this: https://stackoverflow.com/questions/73408643/php-creates-files-with-the-wrong-user-group-when-run-with-su-c
- `setfacl` not being supported by DigitalOcean's App Platform.
