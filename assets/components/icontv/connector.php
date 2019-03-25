<?php
if (file_exists(dirname(dirname(dirname(__DIR__))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(__DIR__))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var icontv $icontv */
$icontv = $modx->getService('icontv', 'icontv', MODX_CORE_PATH . 'components/icontv/model/');
$modx->lexicon->load('icontv:default');

// handle request
$corePath = $modx->getOption('icontv_core_path', null, $modx->getOption('core_path') . 'components/icontv/');
$path = $modx->getOption('processorsPath', $icontv->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);