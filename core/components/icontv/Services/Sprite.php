<?php


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
    public const SVG_NS = 'http://www.w3.org/2000/svg';
    /**
     * Fraction of icon size to pad icons with.
     *
     * @var float
     */
    public const PAD = .05;
    /**
     * The horizontal/vertical center-to-center distance between icons.
     *
     * @var integer
     */
    private int $grid = 100;
    /**
     * The nominal size of the icons.
     *
     * @var integer
     */
    private int $nominal = 64;
    /**
     * The SVG document we are creating.
     *
     * @var DOMDocument
     */
    private DOMDocument $out;
    /**
     * The height of the resulting sprite, extended as icons are added.
     *
     * @var integer
     */
    private int $maxheight = 0;
    /**
     * The width of the resulting sprite.
     *
     * @var integer
     */
    private $maxwidth;
    /**
     * The default state icon color
     *
     * @var string
     */
    private string $default = '#a49d95';
    /**
     * The selected state icon color
     *
     * @var string
     */
    private string $selected = '#6a635a';
    /**
     * The hover state icon color
     *
     * @var string
     */
    private string $hover = '#ed693b';
    /**
     * The active state icon color
     *
     * @var string
     */
    private string $active = '#eeeeee';

    /**
     * Construct an empty Sprite.
     *
     * @param integer $grid Size (height and width) of grid.
     */
    public function __construct()
    {
        $this->out = new DOMDocument();
        $this->out->formatOutput = true;
        $root = $this->out->createElementNS(self::SVG_NS, 'svg:svg');
        $this->out->appendChild($root);
        $root->setAttribute('xmlns', self::SVG_NS);
        $this->maxwidth = (4 * $this->grid);
    }

    /**
     * Load an SVG file, colorize all states, and place it at $row the sprite.
     *
     * @param string $filename File to load.
     * @param integer $row Row at which to locate icon in sprite.
     *
     * @return void
     */
    public function addAllStates($filename, $row)
    {
        $this->add($filename, $this->default, $row);
        $this->add($filename, $this->selected, $row, 1);
        $this->add($filename, $this->hover, $row, 2);
        $this->add($filename, $this->active, $row, 3);
    }

    /**
     * Load an SVG file and place it at $row, $col in the sprite.
     *
     * @param string $filename File to load.
     * @param mixed $fill Fill color (e.g., #FFFFFF) or false for none.
     * @param integer $row Row at which to locate icon in sprite.
     * @param integer $col Column at which to locate icon in sprite.
     *
     * @return void
     */
    public function add($filename, $fill, $row, $col = 0)
    {
        static $gensym = 0;
        $prefix = 'x'.($gensym++);
        $in = new DOMDocument();
        $in->load($filename);
        $src = $in->documentElement;
        $this->maxheight = max($this->maxheight, ($this->grid * ($row + 1)));
        // Make IDs unique.
        foreach (['svg', 'path', 'clipPath', 'g', 'image', 'mask'] as $tag) {
            foreach ($in->getElementsByTagName($tag) as $element) {
                $this->_prefixId($element, $prefix);
            }
        }
        // Fill all the paths.
        if ($fill) {
            foreach ($in->getElementsByTagName('path') as $element) {
                $style = $element->getAttribute('style');
                $style = preg_replace(
                    '/fill:#?[0-9A-Fa-f]+;/',
                    'fill:'.$fill.';',
                    $style
                );
                $style = preg_replace(
                    '/stroke:#?[0-9A-Fa-f]+;/',
                    'stroke:'.$fill.';',
                    $style
                );
                $element->setAttribute('style', $style);
            }
        }
        // Compute transformation to fit icon into sprite.
        $h = $src->getAttribute('height');
        $w = $src->getAttribute('width');
        $scale = (($this->nominal * (1 - (2 * self::PAD))) / $h);
        $x = (((($col + .5) * $this->grid) / $scale) - ($w / 2));
        $y = (((($row + .5) * $this->grid) / $scale) - ($h / 2));
        // Copy source <svg> element to output <g> element.
        $g = $this->out->createElementNS(self::SVG_NS, 'g');
        $this->out->documentElement->appendChild($g);
        $g->setAttribute('id', $src->getAttribute('id'));
        $g->setAttribute(
            'transform',
            'scale('.$scale.') translate('.$x.','.$y.')'
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
            $element->setAttribute('id', $prefix.$element->getAttribute('id'));
        }

        foreach (['clip-path', 'mask'] as $attr) {
            if ($element->hasAttribute($attr)) {
                $ref = $element->getAttribute($attr);
                $ref = str_replace('url(#', 'url(#'.$prefix, $ref);
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
        $root = $this->out->documentElement;
        $root->setAttribute('height', $this->maxheight.'px');
        $root->setAttribute('width', $this->maxwidth.'px');
        $root->setAttribute(
            'viewBox',
            '0 0 '.$this->maxwidth.' '.$this->maxheight
        );
        $this->out->normalizeDocument();
        echo $this->out->saveXML();
    }
}
