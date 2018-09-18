# Content layer demo

The scope of this project is to demonstrate the European Commission content layer capabilities by setting up three sites
and having them share content.

The project provides the following setup:

- Site INFO: produces content
- Site INEA: produces and consumes content
- Site ENERGY: consumes content

Content will be saved in RDF triples in order to enhance interoperability with other semantic data sources provided by
the European Commission.

## Requirements

- Standard [Drupal 8 LAMP stack](https://www.drupal.org/docs/8/system-requirements)
- A triple REF storage such as [OpenLink Virtuoso](https://virtuoso.openlinksw.com)

Alternatively you can use Docker Compose, check the [dedicated section](#installation-using-docker-compose)
for more information.

## Local Installation

To install locally, use the following sequence. An additional `runner.yml` may be used in each site folder with local
connection details. For installation using docker, see below.

```
composer install
./vendor/bin/run sites:composer-install
./vendor/bin/run sites:setup
./vendor/bin/run sites:install
```

When working on 3 concurrent builds, there are Task Runner parallel tasks available in
`src\TaskRunner\Commands\ContentLayerCommands.php`:

```
./vendor/bin/run sites:parallel-composer-install
./vendor/bin/run sites:parallel-setup
./vendor/bin/run sites:parallel-install
```

## Installation Using Docker Compose

Alternatively you can build a test site using Docker and Docker Compose with the provided configuration.

Requirements:

- [Docker](https://www.docker.com/get-docker)
- [Docker-compose](https://docs.docker.com/compose/)

Copy `docker-compose.yml.dist` into `docker-compose.yml`.

You can make any alterations you need for your local Docker setup. However, the defaults should be enough to set the
project up. Note that there are mac specific settings available in the `docker-compose.yml.dist`.

Run:

```
$ docker-compose up -d
docker-compose exec web composer install
docker-compose exec web ./vendor/bin/run sites:composer-install
docker-compose exec web ./vendor/bin/run sites:setup
docker-compose exec web ./vendor/bin/run sites:install
```

The three site will then be available at the following URLs:

- Site INFO: http://localhost:8080/sites/info/web
- Site INEA: http://localhost:8080/sites/inea/web
- Site ENERGY: http://localhost:8080/sites/energy/web

## Development

This repo will build 3 separate sites, with minimal extra files. To update all sites run:

```
docker-compose exec web ./vendor/bin/run sites:composer-update
```

This will run `composer update` in all three sites.

To export configuration on one site, "Site INEA" in this instance, run:

```
docker-compose exec web ./sites/inea/vendor/bin/drush cex
```

To disable cache JS and CSS run:

```
docker-compose exec web ./sites/inea/vendor/bin/drush -y config-set system.performance js.preprocess 0
docker-compose exec web ./sites/inea/vendor/bin/drush -y config-set system.performance css.preprocess 0
```

To re-install run:

```
docker-compose exec web ./vendor/bin/run --working-dir=/var/www/html/sites/inea drupal:site-install
```

### Convenience commands

The projects provides a set of convenience commands that can run useful Drupal/Task Runner tasks on all three sites at
the same time, namely:

```
docker-compose exec web ./vendor/bin/run sites:cache-rebuild
docker-compose exec web ./vendor/bin/run sites:composer-drupal-scaffold
docker-compose exec web ./vendor/bin/run sites:composer-install
docker-compose exec web ./vendor/bin/run sites:composer-update
docker-compose exec web ./vendor/bin/run sites:config-export
docker-compose exec web ./vendor/bin/run sites:config-import
docker-compose exec web ./vendor/bin/run sites:import-interface-translations
docker-compose exec web ./vendor/bin/run sites:install
docker-compose exec web ./vendor/bin/run sites:parallel-composer-update
docker-compose exec web ./vendor/bin/run sites:parallel-sites-install
docker-compose exec web ./vendor/bin/run sites:parallel-sites-setup
docker-compose exec web ./vendor/bin/run sites:setup
docker-compose exec web ./vendor/bin/run sites:sql-drop
docker-compose exec web ./vendor/bin/run sites:sql-dump
docker-compose exec web ./vendor/bin/run sites:sql-restore
```

Also, after any change on the sites' `runner.yml.dist` run:

```
$ docker-compose exec web ./vendor/bin/run setup:runner
```

This will refresh site specific Task Runner configuration.

### Working with Behat tests

The Behat test suite is setup on the project root folder and it can run tests on each site separately and on all three
site simultaneously.

Since the Drupal Extension does not support more than one site per time we had to create three different Behat profiles,
one per site, each profile can use both Mink and Drupal drivers.

The default Behat profile runs only tests that involve interaction with the three sites at the same time and can only
use the Mink driver.

Run tests on three sites at the same time (no Drupal driver):

```
$ docker-compose exec web ./vendor/bin/behat
```

Run site specific tests (use both Mink and Drupal drivers):

```
$ docker-compose exec web ./vendor/bin/behat -p inea
$ docker-compose exec web ./vendor/bin/behat -p energy
$ docker-compose exec web ./vendor/bin/behat -p info
```

### Working with configuration

For an extensive guide about how to work with Drupal 8 site configuration refer to the
[Configuration management](https://www.drupal.org/docs/8/configuration-management) documentation page.

Newer version of the OpenEuropa components might also ship with new or updated configuration.

In order to import configuration changes perform the following steps:

**Via command line:**

Check for configuration changes in modules:

```
$ docker-compose exec web ./vendor/bin/drush --root=/var/www/html/sites/inea config-sync-list-updates
```

Import configuration changes:

```
$ docker-compose exec web ./vendor/bin/drush --root=/var/www/html/sites/inea config-distro-update
```

Export configuration:

```
$ docker-compose exec web ./vendor/bin/drush --root=/var/www/html/sites/inea config:export -y
```

Commit and push.

*Note*: due to an issue in Config Distro module the import configuration step might yield no results, if that's the case
use the UI method below.

**Via the UI:**

1. Visit `/admin/config/development/configuration/distro`
2. Review and import changes
3. Export configuration as described above.
4. Commit and push

