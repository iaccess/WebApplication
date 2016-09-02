<?php

use Zend\Expressive\ConfigManager\ConfigManager;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

/**
 * Configuration files are loaded in a specific order. First ``global.php``, then ``*.global.php``.
 * then ``local.php`` and finally ``*.local.php``. This way local settings overwrite global settings.
 *
 * The configuration can be cached. This can be done by setting ``config_cache_enabled`` to ``true``.
 *
 * Obviously, if you use closures in your config you can't cache it.
 */

$cachedConfigFile = 'data/cache/app_config.php';

$config = [];
if (is_file($cachedConfigFile)) {
    // Try to load the cached config
    $config = include $cachedConfigFile;
} else {

    // Configuration from loaded modules (including vendor via zend-component-installer)
    $modules = require __DIR__ . '/modules.config.php';
    $mergedModules = (new ConfigManager($modules))->getMergedConfig();
    $config = ArrayUtils::merge($config, $mergedModules);
    
    // Load configuration from autoload path
    foreach (Glob::glob('config/autoload/{{,*.}global,{,*.}local}.php', Glob::GLOB_BRACE) as $file) {
        $config = ArrayUtils::merge($config, include $file);
    }
    
    // Cache config if enabled
    if (isset($config['config_cache_enabled']) && $config['config_cache_enabled'] === true) {
        file_put_contents($cachedConfigFile, '<?php return ' . var_export($config, true) . ';');
    }
    
    // Development mode enabled
    if (file_exists(__DIR__ . '/../config/development.config.php')) {
        $config = ArrayUtils::merge($config, require __DIR__ . '/../config/development.config.php');
    }

    // when all else fails, kindly show me the bug :)
    if ($config['debug']) {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    }
}

// Return an ArrayObject so we can inject the config as a service in Aura.Di
// and still use array checks like ``is_array``.
return new ArrayObject($config, ArrayObject::ARRAY_AS_PROPS);
