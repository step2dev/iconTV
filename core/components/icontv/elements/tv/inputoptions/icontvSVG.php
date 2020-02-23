<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
$connector_url = $modx->getOption('assets_url') . 'components/icontv/connector.php';
$input_properties = $this->getInputProperties();
$path = $input_properties['iconstvsvg'];
$preview = (bool)@$input_properties['SVGpreview'];
$dir = realpath(MODX_BASE_PATH . $path);

if (!is_dir($dir)) {
    $path = $modx->getOption('assets_url') . 'components/icontv/svg/';
}
$modx->smarty->assign('connector', "'{$connector_url}'");
$modx->smarty->assign('default_path', "'{$path}'");
$modx->smarty->assign('SVGpreview', "'{$preview}'");

return $modx->smarty->fetch(
    $modx->getOption('core_path') . 'components/icontv/elements/tv/tpl/iconTVSVG.inputproperties.tpl'
);