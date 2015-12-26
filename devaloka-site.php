<?php
/*
Plugin Name: Devaloka Site
Description: Provides Site-specific things
Version: 0.1.1
Author: Whizark
Author URI: http://whizark.com
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Network: true
*/

if (!defined('ABSPATH')) {
    exit;
}

use Devaloka\Plugin\Site\Provider\SiteProvider;

/** @var Devaloka\Devaloka $devaloka */
call_user_func(
    function () use ($devaloka) {
        $container = $devaloka->getContainer();

        /** @var Composer\Autoload\ClassLoader $loader */
        $loader = $container->get('loader');

        $loader->addPsr4('Devaloka\\Plugin\\Site\\', __DIR__ . '/src/', true);

        $devaloka->register(new SiteProvider(__FILE__));
    }
);

require 'includes/api.php';
