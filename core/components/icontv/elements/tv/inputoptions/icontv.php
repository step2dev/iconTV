<?php

/** @var modX $modx */
$assetUrl = $modx->getOption('assets_url') . 'components/icontv/';
$corePath = $modx->getOption('core_path') . 'components/icontv/';
$connectorUrl = $assetUrl.'connector.php';
$modx->smarty->assign('connector', "'{$connectorUrl}'");
$inputProperties = $this->getInputProperties();
$icon = $inputProperties['icons'];
if (!$icon) {
    $icon = 'FontAwesomev5';
}

$modx->smarty->assign('default_icons', "'{$icon}'");
$modx->smarty->assign('default_noSearch', "'" . isset($inputProperties['noSearch']) . "'");

return $modx->smarty->fetch(
    $corePath.'elements/tv/tpl/iconTV.inputproperties.tpl'
);