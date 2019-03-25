<?php
error_reporting(E_ALL);
ini_set('display_errors',true);
$connector_url = $modx->getOption('assets_url') . 'components/icontv/connector.php';
$modx->smarty->assign('connector',"'{$connector_url}'");
$input_properties = $this->getInputProperties();
$modx->smarty->assign('tv_input_properties',"'".$input_properties['icons']."'");

return $modx->smarty->fetch($modx->getOption('core_path') .'components/icontv/elements/tv/tpl/iconTV.inputproperties.tpl');