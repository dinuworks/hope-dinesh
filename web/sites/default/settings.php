<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

/**
 * Include the Pantheon-specific settings file.
 *
 * n.b. The settings.pantheon.php file makes some changes
 *      that affect all environments that this site
 *      exists in.  Always include this file, even in
 *      a local development environment, to ensure that
 *      the site settings remain consistent.
 */
include __DIR__ . "/settings.pantheon.php";

/**
 * Place the config directory outside of the Drupal root.
 */
$config_directories = array(
  CONFIG_SYNC_DIRECTORY => dirname(DRUPAL_ROOT) . '/config/sync',
);

// Automatically enable the correct config_split based on the Pantheon environment.
if (!defined('PANTHEON_ENVIRONMENT')) {
  $config['config_split.config_split.dev']['status'] = TRUE;
}
// Pantheon Env Specific Config
if (isset($_ENV['PANTHEON_ENVIRONMENT'])) {
  switch ($_ENV['PANTHEON_ENVIRONMENT']) {
    case 'live':
      $config['config_split.config_split.prod']['status'] = TRUE;
      break;
    case 'test':
      $config['config_split.config_split.stage']['status'] = TRUE;
      break;
    case 'dev':
    case 'lando':
      $config['config_split.config_split.dev']['status'] = TRUE;
      break;
    default:
      $config['config_split.config_split.dev']['status'] = TRUE;
      break;
  }
 }

/**
 * If there is a local settings file, then include it
 */
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}

/**
 * Always install the 'standard' profile to stop the installer from
 * modifying settings.php.
 */
$settings['install_profile'] = 'apigee_devportal_kickstart';
