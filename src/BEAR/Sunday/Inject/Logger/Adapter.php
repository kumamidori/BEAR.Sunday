<?php
/**
 * This file is part of the BEAR.Sunday package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace BEAR\Sunday\Inject\Logger;

use BEAR\Sunday\Inject\LogInject;
use Ray\Aop\Bind;
use Ray\Di\LoggerInterface;

/**
 * Log adapter
 */
class Adapter implements LoggerInterface
{
    use LogInject;

    /**
     * Log
     *
     * @param string $class
     * @param array  $params
     * @param array  $setter
     * @param object $object
     * @param Bind   $bind
     *
     * @return void
     */
    public function log($class, array $params, array $setter, $object, Bind $bind)
    {
        unset($object);
        $log = "DI class={$class}"
            . ' params=' . $this->getString((array)$params)
            . ' setter=' . $this->getString((array)$setter)
            . ' bind=' . $this->getString((array)$bind);
        // $this->getString((array) $bind);
        $this->log->log($log);
    }

    /**
     * Return log message string
     *
     * @param array $params
     *
     * @return string
     */
    private function getString(array $params)
    {
        $paramInfo = [];
        foreach ($params as $num => $param) {
            if (is_object($param)) {
                $paramInfo[] = "{$num}:" .get_class($param);
                continue;
            } elseif (is_array($param)) {
                $interceptorsName = [];
                $interceptors = array_values($param);
                foreach ($interceptors as &$interceptor) {
                    $interceptorsName[] = get_class($interceptor);
                }
                $paramInfo[] = "{$num}:" . implode(',', $interceptorsName);
                continue;
            }
            $paramInfo[] = "{$num}:" . json_encode($param);
        }

        $paramStr = implode(',', $paramInfo);

        return $paramStr;
    }
}