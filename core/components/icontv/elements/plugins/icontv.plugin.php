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
 * @var iconTV $iconTV
 * @var modX $modx
 */
try {
    $corePath = $modx->getOption('core_path', null, MODX_CORE_PATH).'components/icontv/';

    //$iconTV = $modx->loadClass('icontv.iconTV',$corePath . 'model/icontv/');

    $iconTV = $modx->getService(
        'icontv',
        'iconTV',
        $corePath . 'model/icontv/',
        [
            'core_path' => $corePath
        ]
    );


    switch ($modx->event->name) {
        case 'OnManagerPageBeforeRender':
            $modx->controller->addLexiconTopic('icontv:default');
            //$iconTV->includeScriptAssets();
            break;
        case 'OnTVInputRenderList':
            $modx->event->output($corePath.'elements/tv/input/');
            break;
        case 'OnTVOutputRenderList':
            $modx->event->output($corePath.'elements/tv/output/');
            break;
        case 'OnTVInputPropertiesList':
            $modx->event->output($corePath.'elements/tv/inputoptions/');
            break;
        case 'OnTVOutputRenderPropertiesList':
            $modx->event->output($corePath.'elements/tv/output/options/');
            break;
        case 'OnDocFormRender':
            $iconTV->includeScriptAssets();
            break;
        case 'OnTempFormRender':
            $iconTV->includeScriptAssets();
            $iconTV->includeInTemplate();
            break;
    }
} catch (\Exception $e) {
    $modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage());
}
