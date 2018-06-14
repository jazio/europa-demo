# Europa demo site

[![Build Status](https://drone.fpfis.eu/api/badges/ec-europa/europa-demo/status.svg?branch=master)](https://drone.fpfis.eu/ec-europa/europa-demo)

Europa demo site, based on [OpenEuropa][4] components.

## Installation

The recommended way of installing the Europa demo site is via a [Composer-based workflow][1].

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

The setup procedure described above can be sensitively simplified by using Docker Compose.

Requirements:

- [Docker][2]
- [Docker-compose][3]

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

[1]: https://www.drupal.org/docs/develop/using-composer/using-composer-to-manage-drupal-site-dependencies#managing-contributed
[2]: https://www.docker.com/get-docker
[3]: https://docs.docker.com/compose
[4]: https://github.com/openeuropa/openeuropa
