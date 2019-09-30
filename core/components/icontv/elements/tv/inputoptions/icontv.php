<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
$connector_url = $modx->getOption('assets_url') . 'components/icontv/connector.php';
$modx->smarty->assign('connector', "'{$connector_url}'");
$input_properties = $this->getInputProperties();
$modx->smarty->assign('default_icons', "'" . $input_properties['icons'] . "'");
$modx->smarty->assign('default_noSearch', "'" . isset($input_properties['noSearch']) . "'");

return $modx->smarty->fetch($modx->getOption('core_path') . 'components/icontv/elements/tv/tpl/iconTV.inputproperties.tpl');