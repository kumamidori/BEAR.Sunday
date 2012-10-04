<?php
/**
 * This file is part of the BEAR.Framework package
 *
 * @package BEAR.Framework
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace BEAR\Framework\Framework;

use ArrayObject;
use BEAR\Resource\Exception\BadRequest;
use BEAR\Resource\Exception\MethodNotAllowed;

/**
 * Globals
 *
 * Emulates web $GLOBALS in CLI
 *
 * @package    BEAR.Framework
 * @subpackage Framework
 */
final class Globals extends ArrayObject
{
    /**
     * Constructor
     *
     * @param array $argv
     */
    public function __construct(array $argv)
    {
        if (count($argv) < 3) {
            throw new BadRequest('Usage: [get|post|put|delete] [uri]');
        }
        $isMethodAllowed = in_array($argv[1], ['get', 'post', 'put', 'delete', 'options']);
        if (! $isMethodAllowed) {
            throw new MethodNotAllowed($argv[1]);
        }
        $globals['_SERVER']['REQUEST_METHOD'] = $argv[1];
        $globals['_SERVER']['REQUEST_URI'] = parse_url($argv[2], PHP_URL_PATH);
        parse_str(parse_url($argv[2], PHP_URL_QUERY), $get);
        $globals['_GET'] = $get;
        parent::__construct($globals);
    }
}
