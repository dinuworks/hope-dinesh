# Apigee Kickstart Drupal 8 Dev Portal

This site is built using Pantheon's [Example Drops 8](https://github.com/pantheon-systems/drops-8) composer build, with [Apigee Developer Portal Kickstart](https://www.drupal.org/project/apigee_devportal_kickstart) added in as the default profile. The default theme provided by the Apigee profile was copied and renamed to be used as the new default theme that can be customized as needed.


## Installation

### Prerequisites

Before running this site, make sure you have all of the prerequisites:

* [A Pantheon account](https://dashboard.pantheon.io/register)
* [Terminus, the Pantheon command line tool](https://pantheon.io/docs/terminus/install/)
* [The Terminus Build Tools Plugin](https://github.com/pantheon-systems/terminus-build-tools-plugin)
* [Docker CE](https://docs.docker.com/install/)
* [Lando, local LAMP stack](https://devwithlando.io)
* [Node v10.x+](https://nodejs.org)

### Setup

1. Clone the repo to your local and run `composer install` in the root folder.

2. In the *web/themes/custom/apigee_cn* folder, run `npm install` to install all the requirements for building the theme from its components.

3. To get your local LAMP stack up and running with Lando, run `lando start` from the root folder. This will download all the required docker containers and spin up your local stack. Take a look at .lando.yml if you need to customize anything in the docker setup.


## Important files and directories

### `/web`

Pantheon will serve the site from the `/web` subdirectory due to the configuration in `pantheon.yml`, facilitating a Composer based workflow. Having your website in this subdirectory also allows for tests, scripts, and other files related to your project to be stored in your repo without polluting your web document root.

#### `/config`

One of the directories moved to the git root is `/config`. This directory holds Drupal's `.yml` configuration files. In  a more traditional repo structure these files would live at `/sites/default/config/`. Thanks to [this line in `settings.php`](https://github.com/pantheon-systems/example-drops-8-composer/blob/54c84275cafa66c86992e5232b5e1019954e98f3/web/sites/default/settings.php#L19), the config is moved entirely outside of the web root.

We are using [Config Split](https://www.drupal.org/project/config_split) to manage config per environment. If you are not familiar with Config Split, you should think of it as a way to ENABLE modules and settings when required, instead of DISABLING things. This means that for anything that needs to be conditionally enabled on an environment, the default config (*/config/sync*) should have that thing disabled e.g. Devel module is disabled by default, and only enabled in the dev environment's split (*/config/splits/dev*). Another example is for css and js aggregation, which we want disabled in dev, but enabled for stage and prod. So the default state is disabled for those two settings, and then we only enable them in the stage and prod splits.

### `composer.json`

This site uses Composer to add modules, themes, and their dependencies. Currently, we are committing the downloaded dependencies (*/web/core*, */web/modules*, */web/themes*, */vendor*) as we do not currently have a build step or a CI setup. That may come at a later date.

### `settings.php & settings.pantheon.php`

Any custom settings should go in `settings.php` AFTER the include for the `settings.pantheon.php` file. Do not edit the Pantheon file as that could be updated at some point, wiping out your customizations.

We currently have the config_split switching mechanism here, as well as an import for `settings.local.php` where you can create your own local overrides e.g. database connection. **DO NOT COMMIT settings.local.php!**


## Updating your site

When using this repository to manage your Drupal site, you will no longer use the Pantheon dashboard to update your Drupal version. Instead, you will manage your updates using Composer. Ensure your site is in Git mode, clone it locally, and then run composer commands from there.  Commit and push your files back up to Pantheon as usual.


## Theming

Check the [README.md](web/themes/custom/apigee_cn/README.md) file in the theme folder for more information about modifying the theme.
