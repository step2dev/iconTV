<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
$connector_url = $modx->getOption('assets_url') . 'components/icontv/connector.php';
$modx->smarty->assign('connector', "'{$connector_url}'");
$input_properties = $this->getInputProperties();
$path = $input_properties['iconstvsvg'];
if (!is_dir($path)){
    $path = $modx->getOption('assets_url') . 'components/icontv/svg/';
}
$modx->smarty->assign('default_path', "'{$path}'");

return $modx->smarty->fetch($modx->getOption('core_path') . 'components/icontv/elements/tv/tpl/iconTVSVG.inputproperties.tpl');