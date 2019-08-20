<?php
/**
 * IconTV classfile
 *
 * Copyright 2019 by Yurij Finiv <yura.finiv@gmail.com>
 *
 * @package icontv
 * @subpackage classfile
 */

class iconTv
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
    public $version = '1.1.0';

    /**
     * The class options
     * @var array $options
     */
    public $options = array();

    /**
     * IconTv constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    public function __construct(modX &$modx, $options = array())
    {
        $this->modx =& $modx;
        $this->namespace = $this->getOption('namespace', $options, $this->namespace);

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path') . 'components/' . $this->namespace . '/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path') . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url') . 'components/' . $this->namespace . '/');

        // Load some default paths for easier management
        $this->options = array_merge(array(
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
        ), $options);

        // Set default options
        $this->options = array_merge($this->options, array());

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
            }
            elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            }
            elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
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

        $this->modx->controller->addHtml('<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- styles -->
        <!-- base | always include -->
        <link rel="stylesheet" type="text/css"
            href="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/css/base/jquery.fonticonpicker.min.css">
        <!-- default grey-theme -->
        <link rel="stylesheet" type="text/css"
            href="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/css/themes/grey-theme/jquery.fonticonpicker.grey.min.css">
        <script type="text/javascript"
            src="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/js/jquery.fonticonpicker.min.js"></script>   
        ');


        //$config_file = $config_path . htmlspecialchars($params['icons']) . '.json';

        if ($this->getOption('debug') && $assetsUrl != MODX_ASSETS_URL . 'components/icontv/') {
            $this->modx->controller->addJavascript($jsSourceUrl . 'icontv.js?v=v' . $this->version);
            $this->modx->controller->addCss($cssSourceUrl . 'icontv.css?v=v' . $this->version);
        }
        else {
            $this->modx->controller->addJavascript($jsUrl . 'icontv.js?v=v' . $this->version);
            $this->modx->controller->addCss($cssUrl . 'icontv.css?v=v' . $this->version);
        }
        //$this->modx->controller->addHtml('<script type="text/javascript">IconTV.config = ' . json_encode($this->options, JSON_PRETTY_PRINT) . ';</script>');
    }
}
