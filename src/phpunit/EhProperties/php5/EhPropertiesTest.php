<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Adodb.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @author		Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @version			$Id$
 * @since      	File available since v0.1
 */

//initialization
//defines package name and package php version
if ( !defined('PACKAGE') ) {
    define('PACKAGE', 'EhProperties');
}
if ( !defined('PACKAGE_PHP_VERSION') ) {
    define('PACKAGE_PHP_VERSION', 'php5');
}
$REQUIRED_PACKAGES = Array('Commons');

//setting up include path
$dir = dirname(dirname(dirname(dirname(__FILE__))));
$INCLUDE_PATH = '.';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.PACKAGE.'/'.PACKAGE_PHP_VERSION;
foreach ( $REQUIRED_PACKAGES as $package ) {
    $INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.$package.'/'.PACKAGE_PHP_VERSION;
}
ini_set('include_path', $INCLUDE_PATH);

require_once 'PHPUnit/Framework.php';

class EhPropertiesTest extends PHPUnit_Framework_TestCase {
    public function test1() {
        $obj = new Ddth_EhProperties_EhProperties();
        $this->assertNotNull($obj);
    }

    public function test2() {
        $obj = new Ddth_EhProperties_EhProperties();
        $this->assertNotNull($obj);
        $obj->load('test.properties');

        $value = $obj->getProperty('name');
        $this->assertEquals('Thanh', $value);
    }

    public function test3() {
        $obj = new Ddth_EhProperties_EhProperties();
        $this->assertNotNull($obj);
        $obj->load('test.properties');

        $value = $obj->getProperty('hello');
        $this->assertEquals('Hello Thanh! How are you Thanh?', $value);
    }

    public function test4() {
        $obj = new Ddth_EhProperties_EhProperties();
        $this->assertNotNull($obj);
        $obj->load('test.properties');

        $value = $obj->getProperty('hola');
        $this->assertEquals('Hola !', $value);
    }

    public function test5() {
        $obj = new Ddth_EhProperties_EhProperties();
        $this->assertNotNull($obj);
        $obj->load('test.properties');

        $value = $obj->getProperty('greeting');
        $this->assertEquals('Greeting! Hello Thanh! How are you Thanh?', $value);
    }
}
?>