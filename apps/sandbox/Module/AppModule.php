<?php
/**
 * Module
 *
 * @package    sandbox
 * @subpackage Module
 */
namespace sandbox\Module;

use BEAR\Framework\Module\TemplateEngine\SmartyModule;

use Ray\Di\Scope;

use BEAR\Framework\Module\StandardModule,
    BEAR\Framework\Module,
    BEAR\Framework\Module\Extention,
    BEAR\Framework\Interceptor\DbInjector,
    BEAR\Framework\Interceptor\ViewAdapter,
    BEAR\Framework\Interceptor\ViewAdapter\SmartyBackend;
use Ray\Di\AbstractModule,
    Ray\Di\InjectorInterface,
    Ray\Di\Annotation,
    Ray\Di\Config,
    Ray\Di\Forge,
    Ray\Di\Container,
    Ray\Di\Injector as Di,
    Ray\Di\Definition,
    Ray\Di\Injector;
use Guzzle\Common\Cache\ZendCacheAdapter as CacheAdapter;;
use Zend\Cache\Backend\File as CacheBackEnd;
use Smarty;

/**
 * Application module
 *
 * @package    sandbox
 * @subpackage Module
 */
class AppModule extends AbstractModule
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Configure dependency binding
     *
     * @return void
     */
    protected function configure()
    {
        $this->install(new Module\TemplateEngine\SmartyModule);
        $this->install(new Module\Database\DoctrineDbalModule);
        $this->install(new Module\Schema\StandardSchemaModule);
        $this->install(new Module\Cqrs\CacheModule);
        $this->install(new Module\WebContext\AuraWebModule);

        $this->install(new Extension\ViewModule([new ViewAdapter(new SmartyBackEnd)]));

        $dbInjector = $this->requestInjection('\BEAR\Framework\Interceptor\DbInjector');
        $this->bindInterceptor(
                $this->matcher->annotatedWith('BEAR\Framework\Annotation\Db'),
                $this->matcher->any(),
                [$dbInjector]
        );
    }
}