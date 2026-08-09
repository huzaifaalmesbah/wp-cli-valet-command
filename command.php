<?php

use WP_CLI_Valet\ValetCommand;

if (defined('WP_CLI') && WP_CLI) {
    // Illuminate Container 8.x emits implicitly-nullable deprecations on PHP 8.4+
    // at class-load time, and newer majors are incompatible with the psr/container
    // 1.0 bundled in the WP-CLI phar, so load it here with deprecations masked.
    $valetErrorLevel = error_reporting();
    error_reporting($valetErrorLevel & ~E_DEPRECATED);
    class_exists(\Illuminate\Container\Container::class);
    error_reporting($valetErrorLevel);
    unset($valetErrorLevel);

    if (class_exists(ValetCommand::class)) {
        ValetCommand::register();
    }
}
