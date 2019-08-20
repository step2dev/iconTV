<?php
/**
 * IconTv Input Render
 *
 * @package icontv
 * @subpackage input_render
 */
if (!class_exists('iconTvInputRender')) {
    class iconTvInputRender extends modTemplateVarInputRender
    {
        /**
         * Return the template path to load
         *
         * @return string
         */
        public function getTemplate()
        {
            return $this->modx->getOption('core_path') . 'components/icontv/elements/tv/tpl/icontv.tpl';
        }
        /**
         * Get lexicon topics
         *
         * @return array
         */
        public function getLexiconTopics()
        {
            return array('icontv:default');
        }

        /**
         * Process Input Render
         *
         * @param string $value
         * @param array $params
         * @return void
         */
        public function process($value, array $params = array())
        {
            echo '<pre>';
            print_r($params);
            echo '</pre>';
            die();

            $corepath = MODX_BASE_PATH . '/core/components/icontv/';
            $config_path = $corepath . 'elements/config/';
            $config_file = $config_path . htmlspecialchars($params['icons']) . '.json';
            $icons = '{}';
            $link = '';
            if (file_exists($config_file) && (filesize($config_file) > 0)) {
                $config = json_decode(file_get_contents($config_file));
                $link = '<link rel="stylesheet" href="' . $config->fonts->css . '" ';
                $link .= !empty($config->fonts->integrity) ? 'integrity="' . $config->fonts->integrity . '"' : '';
                $link .= !empty($config->fonts->crossorigin) ? 'crossorigin="' . $config->fonts->crossorigin . '"' : '';
                $link .= '>';
                $icons = (array)$config->keys;
                if (empty($config->fonts->catalog) || ($config->fonts->catalog === false)) {
                    $icons = array_values(array_unique($icons));
                    sort($icons);
                }
                $icons = json_encode($icons, JSON_PRETTY_PRINT);
            }

            $this->setPlaceholder('tv_value', $value);
            $this->setPlaceholder('icons', $icons);
            $this->setPlaceholder('font_css', $link);
        }
    }
}
return 'iconTvInputRender';