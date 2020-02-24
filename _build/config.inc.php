<?php

if (!defined('MODX_CORE_PATH')) {
    $path = __DIR__;
    while (!file_exists($path . '/core/config/config.inc.php') && (strlen($path) > 1)) {
        $path = dirname($path);
    }
    define('MODX_CORE_PATH', $path . '/core/');
}

return [
    'name' => 'iconTV',
    'name_lower' => 'icontv',
    'version' => '1.3.3',
    'release' => 'beta1',
    // Install package to site right after build
    'install' => true,
    // Which elements should be updated on package upgrade
    'update' => [
        'chunks' => false,
        'menus' => false,
        'plugins' => true,
        'resources' => false,
        'settings' => false,
        'snippets' => false,
        'templates' => false,
        'widgets' => false,
    ],
    // Which elements should be static by default
    'static' => [
        'plugins' => false,
        'snippets' => false,
        'chunks' => false,
    ],
    // Log settings
    'log_level' => !empty($_REQUEST['download']) ? 0 : 3,
    'log_target' => php_sapi_name() == 'cli' ? 'ECHO' : 'HTML',
    // Download transport.zip after build
    'download' => !empty($_REQUEST['download']),
];