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
            $corepath = $this->modx->getOption('icontv.core.path', null, MODX_CORE_PATH . 'components/icontv/');
            if (!is_dir($corepath)) {
                $corepath = MODX_CORE_PATH . 'components/icontv/';
            }

            $iconsPerPage = $this->modx->getOption('icontv.icons.per.page', null, 20);
            $iconsAutoClose = (int)$this->modx->getOption('icontv.auto.close', null, true);
            $emptyIcon = (int)$this->modx->getOption('icontv.empty.icon', null, true);
            $destroy = (int)$this->modx->getOption('icontv.destroy.api', null, true);
            $config_path = $this->modx->getOption('icontv.path.config', '', $corepath . 'elements/config/');
            if (!is_dir($config_path)) {
                $config_path = $corepath . 'elements/config/';
            }

            $config_file = $config_path . htmlspecialchars($params['icons']) . '.json';
            $noSearch = isset($params['noSearch']) ? 0 : 1;
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
            $this->setPlaceholder('iconsPerPage', $iconsPerPage);
            $this->setPlaceholder('iconsAutoClose', $iconsAutoClose);
            $this->setPlaceholder('noSearch', $noSearch);
            $this->setPlaceholder('emptyIcon', $emptyIcon);
            $this->setPlaceholder('destroy', $destroy);
        }
    }
}
return 'iconTvInputRender';