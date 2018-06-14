# Europa demo site

[![Build Status](https://drone.fpfis.eu/api/badges/ec-europa/europa-demo/status.svg?branch=master)](https://drone.fpfis.eu/ec-europa/europa-demo)

Europa demo site, based on [OpenEuropa][1] components.

## Installation

The Europa demo site can be set up using [Composer][2].

In the project root run:

```
$ composer install
```

Before setting up and installing the site make sure to customize default configuration values by copying `./runner.yml.dist`
to `./runner.yml` and override relevant properties.

To set up the site run:

```
$ ./vendor/bin/run drupal:site-setup
```

This will:

- Symlink the custom modules in `./build/modules`
- Symlink the custom themes in `./build/themes`
- Setup Drush and Drupal's setting files using values from `./runner.yml.dist` or `./runner.yml`
- Setup the Behat configuration file using values from `./runner.yml.dist` or `./runner.yml`

After a successful setup install the site by running:

```
$ ./vendor/bin/run drupal:site-install
```

This will install the site using the configuration exported in `./config/sync`.

### Using Docker Compose

The project offers a set of containers for software packages that are close to the versions that are in use on the
production servers. If you want to run the site on an environment that closely mimics production, you can follow these
steps to install it using Docker Compose.

Requirements:

- [Docker][3]
- [Docker-compose][4]

Run:

```
$ docker-compose up -d
```

Then:

```
$ docker-compose exec -u web web composer install
$ docker-compose exec -u web web ./vendor/bin/run drupal:site-install
```

The demo site will be available at [http://localhost:8080/build](http://localhost:8080/build).

### Tests

Run tests as follows:

```
./vendor/bin/behat
```

Or when using Docker Compose:

```
$ docker-compose exec -u web web ./vendor/bin/behat
```

[1]: https://github.com/openeuropa/openeuropa
[2]: https://getcomposer.org
[3]: https://www.docker.com/get-docker
[4]: https://docs.docker.com/compose
