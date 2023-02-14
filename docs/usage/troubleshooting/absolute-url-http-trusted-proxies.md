# Absolute URLs use HTTP instead of HTTPS in production

You are likely missing these lines in your `framework.yaml` configuration:

```yaml
when@prod:
    framework:
        # https://symfony.com/doc/latest/deployment/proxies.html
        trusted_proxies: '127.0.0.1,REMOTE_ADDR'
        trusted_headers: ['x-forwarded-proto', 'x-forwarded-for']
```

On DigitalOcean's App Platform, your app is behind a proxy, so it is essential
that you add these lines for Symfony to trust the information that the proxy
provides.

## Resources

- https://symfony.com/doc/latest/deployment/proxies.html
