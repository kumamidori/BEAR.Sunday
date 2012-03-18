<?php
namespace demoworld\Resource\Page\template;

use BEAR\Resource\Object as ResourceObject,
    BEAR\Resource\AbstractObject as Page,
    BEAR\Resource\Resource,
    BEAR\Framework\Link\View\Php as PhpView;

class Php extends Page
{
    use PhpView;

    public function __construct()
    {
    }

    /**
     * @return self
     */
    public function onGet()
    {
        $this['greeting'] = 'Hello World';
        return $this;
    }
}