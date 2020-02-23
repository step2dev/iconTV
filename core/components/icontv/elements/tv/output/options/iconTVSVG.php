<?php
/**
 * IconTVSVG Output Options Render
 *
 * @package colorpicker
 * @subpackage outputoptions_render
 *
 * @var modX $modx
 */

$corePath = $modx->getOption('icontv.core_path', null, $modx->getOption('core_path') . 'components/icontv/');

return $modx->smarty->fetch($corePath . 'elements/tv/output/tpl/icontvsvg.options.tpl');
