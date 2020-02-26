<?php
/**
 * IconTVSVG Output Render
 *
 * @package colorpicker
 * @subpackage output_render
 */

if (!class_exists(modTemplateVarOutputRender::class)) {
    class modTemplateVarOutputRender extends MODX\Revolution\modTemplateVarOutputRender
    {
    }
}

class IconTVSVGOutputRender extends modTemplateVarOutputRender
{
    /**
     * Process Output Render
     *
     * @param string $value
     * @param array $params
     * @return string
     */
    public function process($value, array $params = array())
    {
        $parseInput = $this->tv->parseInput($value);
        $input_property = unserialize($this->tv->input_properties);
        $file = file_get_contents(realpath(MODX_BASE_PATH.$input_property['iconstvsvg']) .'/'. $parseInput . '.svg');
        return $file;
    }
}

return 'IconTVSVGOutputRender';
