<?php
/**
 * Get list processor for IconTv
 *
 * @package colorpicker
 * @subpackage processor
 */
class IconTvTVsGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'modTemplateVar';
    public $languageTopics = array('icontv:default');
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'modTemplateVar';
}

return 'IconTvTVsGetListProcessor';
