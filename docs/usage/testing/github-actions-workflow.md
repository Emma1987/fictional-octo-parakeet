# Building & testing in GitHub Actions

Projects built with this template can run inside of a GitHub Actions workflow 
(or any other CI platform).

Here is an example configuration of a GitHub Actions workflow that initializes
and launches your project.

Not only will this make sure that your project builds successfully: it will
also allows you to run E2E and integration tests in a CI workflow.


```yaml
name: CI

on:
    push:
    pull_request:

jobs:
    build:
        name: Build and test
        runs-on: ubuntu-20.04
        steps:
            - name: Checkout
              uses: actions/checkout@v2
            - name: Setup PHP
              uses: shivammathur/setup-php@v2
              with:
                  php-version: '8.1'
                  ini-values: post_max_size=256M, max_execution_time=0
            - name: Use Node.js 15.x
              uses: actions/setup-node@v1
              with:
                node-version: 15.x
            - name: Pull images
              run: docker-compose pull
            - name: Start services
              run: docker-compose --env-file .env.test up --build -d
            - name: Wait for services to be ready
              run: |
                  APP_BOOT_TIMEOUT=`expr $(date +%s) + 600`
                  UNHEALTHY_ALLOWANCE_LEFT=20
                  while status="$(docker inspect --format="{{if .Config.Healthcheck}}{{print .State.Health.Status}}{{end}}" "$(docker-compose ps -q php)")"; do
                    case $status in
                      starting)
                        if [ $APP_BOOT_TIMEOUT -lt $(date +%s) ]; then
                          echo "System boot timed out - 10 mins elapsed."
                          docker logs --since="10m" "$(docker-compose ps -q php)"
                          exit 1
                        fi
                        UNHEALTHY_ALLOWANCE_LEFT=20
                        sleep 1;;
                      healthy)
                        exit 0;;
                      unhealthy)
                        if [ $UNHEALTHY_ALLOWANCE_LEFT -eq 0 ]; then
                          docker logs --since="10m" "$(docker-compose ps -q php)"
                          exit 1
                        else
                          UNHEALTHY_ALLOWANCE_LEFT=$((UNHEALTHY_ALLOWANCE_LEFT - 1))
                          sleep 3
                        fi;;
                    esac
                  done
                  exit 1
            - name: Check HTTP reachability
              run: curl http://localhost
            - name: Check HTTPS reachability
              run: curl -k https://localhost
            # =======================================================================
            # === Starting here is where you might want to customize the workflow ===
            # === At this point, your project/app is up and running on localhost. ===
            # =======================================================================
            # If you do not use Playwright, remove this step.
            - name: Install Playwright dependencies
              run: npx playwright@1.20 install-deps
            # If you do not have JS dependencies to install, remove this step.
            - name: Install JS testing dependencies
              run: npm ci
            # If you do not use Webpack Encore, remove this step.
            - name: Build JS assets with Webpack Encore
              run: NODE_ENV=test npm run encore prod
            # If you do not use Playwright, remove this step.
            - name: Install Playwright browsers
              run: npx playwright install
            # Customize these step to run your own tests. 
            - name: Run PHPUnit tests
              run: docker-compose exec -T php ./bin/phpunit
            - name: Run E2E tests with Playwright
              run: npx playwright test --workers 1
            - name: Run JS unit tests with Web Test Runner
              run: npx wtr
            # The steps below allow you to keep files after your CI ends.
            - name: Save log artifacts
              if: always()
              uses: actions/upload-artifact@v3
              with:
                name: logs
                path: var/log
            # If you do not record videos of failed tests with Playwright, remove this step.
            - name: Save testing artifacts
              if: always()
              uses: actions/upload-artifact@v3
              with:
                name: test-results
                path: test-results
```
