<?php

/**
 * IconTV class file
 *
 * Copyright 2019 by Yurij Finiv <yura.finiv@gmail.com>
 *
 * @package icontv
 * @subpackage classfile
 */
class iconTV
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public $modx;

    /**
     * The namespace
     * @var string $namespace
     */
    public $namespace = 'icontv';

    /**
     * The version
     * @var string $version
     */
    public $version = '1.3.9';

    /**
     * The class options
     * @var array $options
     */
    public $options = [];

    /**
     * IconTv constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    public function __construct(modX &$modx, $options = [])
    {
        $this->modx =& $modx;
        $this->namespace = $this->getOption('namespace', $options, $this->namespace);

        $corePath = $this->getOption(
            'core_path',
            $options,
            $this->modx->getOption('core_path') . 'components/' .  strtolower($this->namespace) . '/'
        );
        $assetsPath = $this->getOption(
            'assets_path',
            $options,
            $this->modx->getOption('assets_path') . 'components/' . strtolower($this->namespace) . '/'
        );
        $assetsUrl = $this->getOption(
            'assets_url',
            $options,
            $this->modx->getOption('assets_url') . 'components/' .  strtolower($this->namespace) . '/'
        );

        // Load some default paths for easier management
        $this->options = array_merge(
            [
                'namespace' => $this->namespace,
                'version' => $this->version,
                'corePath' => $corePath,
                'modelPath' => $corePath . 'model/',
                'vendorPath' => $corePath . 'vendor/',
                'chunksPath' => $corePath . 'elements/chunks/',
                'pagesPath' => $corePath . 'elements/pages/',
                'snippetsPath' => $corePath . 'elements/snippets/',
                'pluginsPath' => $corePath . 'elements/plugins/',
                'controllersPath' => $corePath . 'controllers/',
                'processorsPath' => $corePath . 'processors/',
                'templatesPath' => $corePath . 'templates/',
                'assetsPath' => $assetsPath,
                'assetsUrl' => $assetsUrl,
                'jsUrl' => $assetsUrl . 'js/',
                'cssUrl' => $assetsUrl . 'css/',
                'imagesUrl' => $assetsUrl . 'images/',
                'connectorUrl' => $assetsUrl . 'connector.php'
            ],
            $options
        );

        $this->modx->lexicon->load($this->namespace . ':default');
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = array(), $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
            }
        }
        return $option;
    }

    /**
     * Register javascripts in the controller
     */
    public function includeScriptAssets()
    {
        $assetsUrl = $this->getOption('assetsUrl');
        $jsUrl = $this->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';
        $corePath = $this->getOption('corePath');

        $this->modx->controller->addHtml(
            '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <!-- base | always include -->
        <link rel="stylesheet" type="text/css" href="/assets/components/icontv/css/mgr/base/jquery.fonticonpicker.min.css">
         
        <!-- default grey-theme -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/grey-theme/jquery.fonticonpicker.grey.min.css">
        <script type="text/javascript" src="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/js/jquery.fonticonpicker.min.js"></script>  
        '
        );

        //<link rel="stylesheet" type="text/css" href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css">
        //<link rel="stylesheet" type="text/css" href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/dark-grey-theme/jquery.fonticonpicker.darkgrey.min.css">
        //<link rel="stylesheet" type="text/css" href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/inverted-theme/jquery.fonticonpicker.inverted.min.css">

        //$config_file = $config_path . htmlspecialchars($params['icons']) . '.json';

        if ($this->getOption('debug') && $assetsUrl != MODX_ASSETS_URL . 'components/icontv/') {
            $this->modx->controller->addJavascript($jsSourceUrl . 'icontv.js?v=' . $this->version);
            $this->modx->controller->addCss($cssSourceUrl . 'icontv.css?v=' . $this->version);
            $this->modx->controller->addLastJavascript($jsUrl . 'icontv.jquery.js?v=' . $this->version);
        } else {
            $this->modx->controller->addJavascript($jsUrl . 'icontv.js?v=' . $this->version);
            $this->modx->controller->addJavascript($jsUrl . 'icontvSVG.js?v=' . $this->version);
            $this->modx->controller->addLastJavascript($jsUrl . 'icontv.jquery.js?v=' . $this->version);
            $this->modx->controller->addCss($cssUrl . 'icontv.css?v=' . $this->version);
        }
        //$this->modx->controller->addHtml('<script type="text/javascript">IconTV.config = ' . json_encode($this->options, JSON_PRETTY_PRINT) . ';</script>');
    }

    public function includeInTemplate()
    {
        $template = (int)$this->modx->getOption('icontv.generate.template', null, true);
        if ($template) {
            $provider = $this->modx->cacheManager->getCacheProvider('default');
            $cacheKey = 'manager-icon';
            $BaseIcon = $provider->get($cacheKey);

            if (!$BaseIcon) {
                $baseCSS = MODX_MANAGER_PATH . '/templates/default/css/index.css';
                $regexPrefix = 'icon-';
                $outputPrefix = 'icon icon-';
                $BaseIcon = array();
                $regex = "/\." . $regexPrefix . "([\w-]*)/";
                //$regex = "/[^x\-btn\-icon\B]\." . $regexPrefix . "([\w-]*)/";

                $css = file_get_contents($baseCSS);
                $excludeClasses = $this->templateExclude();
                if (preg_match_all($regex, $css, $matches)) {
                    $icons = array_diff($matches[1], $excludeClasses);
                    foreach ($icons as $icon) {
                        $BaseIcon[] = $outputPrefix . $icon;
                    }
                }
                $BaseIcon = array_values(array_unique($BaseIcon));
                if ($BaseIcon) {
                    $BaseIcon = json_encode($BaseIcon, JSON_PRETTY_PRINT);
                    $provider->set($cacheKey, $BaseIcon, 0);
                } else {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, '[fontAwesomeInputOptions] could not get css source!');
                }
            }

            $iconsPerPage = $this->modx->getOption('icontv.icons.per.page', null, 20);
            $iconsAutoClose = (int)$this->modx->getOption('icontv.auto.close', null, true);
            $emptyIcon = (int)$this->modx->getOption('icontv.empty.icon', null, true);

            $this->modx->controller->addHtml(
                "<script>
                const iconTvTemplate = {};
                    iconTvTemplate.iconsPerPage = {$iconsPerPage};
                    iconTvTemplate.iconsAutoClose = {$iconsAutoClose};
                    iconTvTemplate.emptyIcon = {$emptyIcon};
                    iconTvTemplate.baseicon = {$BaseIcon};
                            
            </script>"
            );
        }
    }

    public function templateExclude()
    {
        return [
            'ul',
            'li',
            'lg',
            'large',
            '2x',
            '3x',
            '4x',
            '5x',
            'fw',
            'border',
            'pull-left',
            'pull-right',
            'spin',
            'pulse',
            'rotate-90',
            'rotate-180',
            'rotate-270',
            'flip-horizontal',
            'flip-vertical',
            'stack',
            'stack-1x',
            'stack-2x',
            'inverse',
            'page_white',
            'file_upload',
            'file_manager',
            'key2',
            'propertyset',
            'resourcegroup',
            'uninstall',
            'ob',
            'graph',
            'chart',
            'prefs',
            'ok',
            'defaults',
            'load',
            'working',
            'folder-add',
            'open',
            'open-self',
            'open-popup',
            'open-blank',
            'open-download',
            'email',
            'email-compose',
            'coins',
            'clock',
            'extension',
            'function',
            'bulb',
            'bulb-off',
            'db-gear',
            'zoom',
            'reconfigure',
            'cross',
            'cancel',
            'folder-component',
            'expand-all',
            'collapse-all',
            'tree-orgboard',
            'tree-area',
            'tree-post',
            'house',
            'trash-empty',
            'trash-closed',
            'disk',
            'disk-bullet',
            'loading',
            'db-refresh',
            'magnifier',
            'stat-list',
            'stat-portal',
            'group-add',
            'lock-go',
            'wrench-orange',
            'grid',
            'admin',
            'del-table',
            'add-table',
            'go-tab',
            'del-tab',
            'add-tab',
            'save-table',
            'del-col',
            'add-col',
            'rename',
            'stat-data',
            'check-on',
            'check-off',
            'view-tile',
        ];
    }
}
