<?php
/**
* Plugin Name:  Project Plugin
* Description:  Create and deploy custom shortcodes for your project.
* Version:      20180925
* Author:       Filippo Toso
* Author URI:   https://www.filippotoso.com/
* License:      MIT License
*/

// TODO: Rename the namespace
namespace AcmeInc\WordPress;

if (!defined('ABSPATH')) {
	exit;
}

require_once(__DIR__ . '/plugin/bootstrap.php');

// TODO: Rename the class
MyPlugin::start();
