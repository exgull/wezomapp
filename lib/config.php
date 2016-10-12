<?php

namespace App;

/**
 * Created by PhpStorm.
 * User: gull
 * Date: 07.10.16
 * Time: 20:20
 */
defined('BR') ? null : define('BR', '<br>', true);
defined('HR') ? null : define('HR', '<hr>', true);
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR, true);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'var'.DS.'www'.DS.'html'.DS.'wezom'.DS);

// Database Constants
defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER')   ? null : define("DB_USER", "wezom");
defined('DB_PASS')   ? null : define("DB_PASS", "wezom");
defined('DB_NAME')   ? null : define("DB_NAME", "wezom");