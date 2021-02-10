<?php

//error_reporting(E_ALL);
//ini_set('display_errors', true);

/** @var modX $modx */
/** @noinspection PhpUndefinedMethodInspection */
$assetUrl = $modx->getOption('assets_url') . 'components/icontv/';
/** @noinspection PhpUndefinedMethodInspection */
$corePath = $modx->getOption('core_path') . 'components/icontv/';
$connectorUrl = $assetUrl.'connector.php';
$inputProperties = $this->getInputProperties();
$path = $inputProperties['iconstvsvg'];
$preview = (bool)@$inputProperties['SVGpreview'];
$dir = realpath(MODX_BASE_PATH . $path);

if (!is_dir($dir)) {
    $path = $modx->getOption('assets_url') . 'components/icontv/svg/';
}
$modx->smarty->assign('connector', "'{$connectorUrl}'");
$modx->smarty->assign('default_path', "'{$path}'");
$modx->smarty->assign('SVGpreview', "'{$preview}'");

return $modx->smarty->fetch(
    $corePath.'/elements/tv/tpl/iconTVSVG.inputproperties.tpl'
);