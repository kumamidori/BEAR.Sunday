<?php

namespace BEAR\Sunday\Module\Resource;

use BEAR\Sunday\Module\Resource\ResourceModule;
use Doctrine\Common\Annotations\AnnotationReader as Reader;
use Ray\Di\AbstractModule;
use Ray\Di\Injector;
use Ray\Di\Module\InjectorModule;

class ResourceModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BEAR\Resource\Resource
     */
    private $resource;

    protected function setUp()
    {
        $this->resource = Injector::create([new InjectorModule(new ResourceModule)])->getInstance('BEAR\Resource\ResourceInterface');
    }

    public function testGetInstance()
    {
        $this->assertInstanceOf('BEAR\Resource\ResourceInterface', $this->resource);
    }
}
