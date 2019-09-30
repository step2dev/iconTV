<?php
/**
 * IconTv Runtime Hooks
 *
 * Registers custom TV input & output types and includes javascripts on document
 * edit pages so that the TV can be used from within other extras (i.e. MIGX,
 * Collections)
 *
 * @package icontv
 * @subpackage plugin
 *
 *
 * @event OnManagerPageBeforeRender
 * @event OnTVInputRenderList
 * @event OnTVOutputRenderList
 * @event OnTVInputPropertiesList
 * @event OnTVOutputRenderPropertiesList
 * @event OnDocFormRender
 *
 * @var modX $modx
 */
$corePath = $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/icontv/';
/** @var IconTv $icontv */
$icontv = $modx->getService('icontv', 'IconTv', $corePath . 'model/icontv/', array(
    'core_path' => $corePath
));

switch ($modx->event->name) {
    case 'OnManagerPageBeforeRender':
        $modx->controller->addLexiconTopic('icontv:default');
        $icontv->includeScriptAssets();
        break;
    case 'OnTVInputRenderList':
        $modx->event->output($corePath . 'elements/tv/input/');
        break;
    case 'OnTVOutputRenderList':
        $modx->event->output($corePath . 'elements/tv/output/');
        break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($corePath . 'elements/tv/inputoptions/');
        break;
    case 'OnTVOutputRenderPropertiesList':
        $modx->event->output($corePath . 'elements/tv/properties/');
        break;
    case 'OnDocFormRender':
        $icontv->includeScriptAssets();
        break;
    case 'OnTempFormRender':
        $icontv->includeScriptAssets();
        $icontv->includeInTemplate();
        break;
}