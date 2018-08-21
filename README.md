# Content layer demo

### Local Installation

To install locally, use the following sequence. An additional runner.yml may be used in each site folder with local connection details. For installation using docker, see below.

```
composer install
./vendor/bin/run drupal:demo-composer-install
./vendor/bin/run drupal:demo-setup
./vendor/bin/run drupal:demo-install
```


When working on 3 concurrent builds, there are TaskRunner ParallelTasks available in `src\TaskRunner\Commands\ContentLayerCommands.php`

```
./vendor/bin/run drupal:parallel-composer-install
./vendor/bin/run drupal:parallel-sites-setup
./vendor/bin/run drupal:parallel-sites-install
```

### Installation Using Docker Compose

Alternatively you can build a test site using Docker and Docker-compose with the provided configuration.

Requirements:

- [Docker](https://www.docker.com/get-docker)
- [Docker-compose](https://docs.docker.com/compose/)

Copy `docker-compose.yml.dist` into `docker-compose.yml`.

You can make any alterations you need for your local Docker setup. However, the defaults should be enough to set the project up.
Note that there are mac specific settings available in the docker-compose.yml.dist.

Run:

```
$ docker-compose up -d
docker-compose exec web composer install
docker-compose exec web ./vendor/bin/run drupal:demo-composer-install
docker-compose exec web ./vendor/bin/run drupal:demo-setup
docker-compose exec web ./vendor/bin/run drupal:demo-install
```

### Development

This repo will build 3 separate sites, with minimal extra files. To update this repo with a site with additional config (Site B in this instance), use the following process:

Install with default profile
```
composer create-project openeuropa/drupal-site-template --stability=dev Site B

rm site-b/.drone.yml
rm site-b/.editorconfig
rm site-b/LICENCE.txt
rm site-b/docker-compose.yml
rm site-b/behat.*
```
Export configuration
```
docker-compose exec web ./site-b/vendor/bin/drush cex
```
Disable cache JS and CSS
```
docker-compose exec web ./site-b/vendor/bin/drush -y config-set system.performance js.preprocess 0
docker-compose exec web ./site-b/vendor/bin/drush -y config-set system.performance css.preprocess 0
```
Export configuration
Add drupal/config_installer to site composer.json
composer update
```
docker-compose exec web composer update
``` 
Change profile to config_installer in line 11 of site-b/runeer.yml.dist
Re-install to test with:

```
docker-compose exec web ./vendor/bin/run --working-dir=/var/www/html/site-b drupal:site-install
```