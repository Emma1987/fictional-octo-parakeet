# Troubleshooting SSL certificates

If you have a TLS trust issues when running the project on your local machine, 
you can copy the self-signed certificate from Caddy and add it to the trusted 
certificates by running the command for your OS below from within your project
directory. 

You may have to restart your browser after running the command for this change 
to take effect.

#### Mac
```bash
docker cp $(docker compose ps -q php):/data/caddy/pki/authorities/local/root.crt /tmp/root.crt && sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain /tmp/root.crt
```

#### Linux
```bash
docker cp $(docker compose ps -q php):/data/caddy/pki/authorities/local/root.crt /usr/local/share/ca-certificates/root.crt && sudo update-ca-certificates
```

#### Windows
```bash
docker compose cp php:/data/caddy/pki/authorities/local/root.crt %TEMP%/root.crt && certutil -addstore -f "ROOT" %TEMP%/root.crt
```
