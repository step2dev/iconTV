<?php

//error_reporting(E_ALL);
//ini_set('display_errors', true);
/**
 * IconTv Input Render
 *
 * @package icontv
 * @subpackage input_render
 */

/**
 * Create an SVG sprite as a DOMDocument.
 */
class Sprite
{
    /**
     * The URI for the SVG namespace.
     *
     * @var string
     */
    const SVG_NS = 'http://www.w3.org/2000/svg';
    /**
     * Fraction of icon size to pad icons with.
     *
     * @var float
     */
    const PAD = 0.05;
    /**
     * The horizontal/vertical center-to-center distance between icons.
     *
     * @var int
     */
    private $grid = 80;
    /**
     * The nominal size of the icons.
     *
     * @var int
     */
    private $nominal = 32;
    /**
     * The SVG document we are creating.
     *
     * @var DOMDocument
     */
    private $out;
    /**
     * The height of the resulting sprite, extended as icons are added.
     *
     * @var int
     */
    private $maxheight = 0;
    /**
     * The width of the resulting sprite.
     *
     * @var int
     */
    private $maxwidth;

    /**
     * Construct an empty Sprite.
     *
     * @param int $grid Size (height and width) of grid.
     */
    public function __construct()
    {
        $this->out = new DOMDocument();
        $this->out->formatOutput = true;
        $root = $this->out->createElementNS(self::SVG_NS, 'svg');
        $this->out->appendChild($root);
        $root->setAttribute('xmlns', self::SVG_NS);
    }

    /**
     * Load an SVG file and place it at $row, $col in the sprite.
     *
     * @param string $filename File to load.
     * @param mixed $fill Fill color (e.g., #FFFFFF) or false for none.
     * @param int $row Row at which to locate icon in sprite.
     * @param int $col Column at which to locate icon in sprite.
     *
     * @return void
     */
    public function add($fileName, $fill, $row, $col = 0)
    {
        $prefix = basename($fileName, '.svg');

        $in = new DOMDocument();
        $in->load($fileName);

        $src = $in->documentElement;

        // Make IDs unique.
        foreach (array('svg', 'path', 'clipPath', 'g', 'image', 'mask') as $tag) {
            foreach ($in->getElementsByTagName($tag) as $element) {
                $this->_prefixId($element, $prefix);
            }
        }

        $sizes = array_combine(['min-x', 'min-y', 'width', 'height'], explode(' ', $src->getAttribute('viewBox')));

        // Compute transformation to fit icon into sprite.
        $h = $sizes['height'] ?: '512';
        $w = $sizes['width'] ?: '512';
        $scale = 1;

        // Copy source <svg> element to output <g> element.
        $g = $this->out->createElementNS(self::SVG_NS, 'symbol');
        $this->out->documentElement->appendChild($g);
        $g->setAttribute(
            'viewBox',
            "0 0 {$w} {$h}"
        );
        $g->setAttribute('id', basename($fileName, '.svg'));//$src->getAttribute('id'));
        $g->setAttribute(
            'transform',
            'scale(' . $scale . ')'
        );

        foreach ($src->childNodes as $child) {
            if ($child->nodeType === XML_ELEMENT_NODE
                && $child->tagName !== 'metadata'
            ) {
                $g->appendChild($this->out->importNode($child, true));
            }
        }
    }

    /**
     * Make IDs unique by prefixing them.
     *
     * @param DOMElement $element Element whose attributes will be checked.
     * @param string $prefix Prefix to add.
     *
     * @return void
     */
    private function _prefixId(DOMElement $element, $prefix)
    {
        if ($element->hasAttribute('id')) {
            $element->setAttribute('id', $prefix . $element->getAttribute('id'));
        }
        //, 'defs', 'use'
        foreach (array('clip-path', 'mask') as $attr) {
            if ($element->hasAttribute($attr)) {
                $ref = $element->getAttribute($attr);
                $ref = str_replace('url(#', 'url(#' . $prefix, $ref);
                $element->setAttribute($attr, $ref);
            }
        }
    }

    /**
     * Echo the resulting Sprite.
     *
     * @return void
     */
    public function output()
    {
        $this->out->normalizeDocument();
        //$svg = $this->out->saveXML();
        return str_replace('<?xml version="1.0"? >', '', $this->out->saveXML());
    }
}

if (!class_exists(modTemplateVarInputRender::class)) {
    class modTemplateVarInputRender extends MODX\Revolution\modTemplateVarInputRender
    {
    }
}

class iconTVGetListSVGProcessor extends modProcessor
{
    public function process()
    {
    }
}

class SVGFilterIterator extends FilterIterator
{
    public function accept()
    {
        $item = $this->getInnerIterator()->current();
        return $item->isFile() && $item->getExtension() === 'svg';
    }
}

if (!class_exists('iconTvSVGInputRender')) {
    class iconTvSVGInputRender extends modTemplateVarInputRender
    {
        /**
         * Return the template path to load
         *
         * @return string
         */
        public function getTemplate()
        {
            return $this->modx->getOption('core_path') . 'components/icontv/elements/tv/tpl/icontvSVG.tpl';
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
            $destroy = (int)$this->modx->getOption('icontv.destroy.api', null, true);
            $path = realpath(MODX_BASE_PATH . $params['iconstvsvg']);
            if (!is_dir($path)) {
                $path = MODX_BASE_PATH . 'assets/components/icontv/svg/';
            }

            $files = new SVGFilterIterator(new FilesystemIterator($path));

            $path = str_replace(MODX_BASE_PATH, '/', $path);

            $sprite = new Sprite();

            $svgs = [];
            $i = 0;
            foreach ($files as $item) {
                $svgs[] = basename($item->getfileName(), '.svg');
                $sprite->add($item->getPathname(), '', $i);
                $i++;
            }

            if ($svgs) {
                $svgs = array_values($svgs);
                sort($svgs);
            }

            $sp = $sprite->output();

            $preview = (int)isset($params['SVGpreview']);
            $this->setPlaceholder('tv_value', $value);
            $this->setPlaceholder('svgs', json_encode($svgs));
            $this->setPlaceholder('iconsSVG', $path);
            $this->setPlaceholder('sprite', $sp);
            $this->setPlaceholder('destroy', $destroy);
            $this->setPlaceholder('preview', $preview);
        }
    }
}
return 'iconTvSVGInputRender';