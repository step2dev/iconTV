<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

/** @var modX $modx */
$connectorUrl = $modx->getOption('assets_url') . 'components/icontv/connector.php';
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
    $modx->getOption('core_path') . 'components/icontv/elements/tv/tpl/iconTVSVG.inputproperties.tpl'
);