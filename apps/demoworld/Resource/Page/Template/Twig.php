<?php
namespace demoworld\Resource\Page\template;

use BEAR\Resource\Object as ResourceObject,
    BEAR\Resource\AbstractObject as Page,
    BEAR\Resource\Resource,
    BEAR\Framework\Link\View\Twig as TwigView;

class Twig extends Page
{
    use TwigView;

    public function __construct()
    {
    }

    /**
     * @return self
     */
    public function onGet()
    {
        $this['greeting'] = 'Hello Twig';
        return $this;
    }
}