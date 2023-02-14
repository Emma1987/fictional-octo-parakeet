# Mercure

This template comes with a Mercure Hub built-in.

This allows you to get started with Mercure's server-to-client messages much
more quickly.

## Setting up Mercure

First, install the Mercure bundle in your project:
```bash
composer require symfony/mercure-bundle
```

Then, update `config/packages/mercure.yaml` to use this basic configuration:
```yaml
mercure:
    hubs:
        default:
            url: '%env(MERCURE_URL)%'
            public_url: '%env(MERCURE_PUBLIC_URL)%'
            jwt:
                secret: '%env(MERCURE_JWT_SECRET)%'
                publish: '*'
```

The environment variables referenced in the configuration should already be 
present in your `.env` and `.env.local` files.

## Changing the Mercure secret

By default, the value of the Mercure secret (`MERCURE_JWT_SECRET`) is 
`!ChangeThisMercureHubJWTSecretKey!`.

This may be fine for your local development environment, but make sure to 
change it for a real random value of 32 characters or more for any staging or 
production environments.

## Troubleshooting

If you're running into issues when setting up Mercure, check out the 
[Troubleshooting Mercure](/docs/usage/troubleshooting/mercure.md) docs.


## References

- https://symfony.com/doc/current/mercure.html
