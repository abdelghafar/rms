<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 14/04/15
 * Time: 11:18 ص
 */

require_once '../lib/stuff_roles.php';
require_once 'PHPUnit/Autoload.php';

class stuff_rolesTest extends PHPUnit_Framework_TestCase
{

    public function Test___1()
    {
        $stack = array();
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack) - 1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }
}
 