<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test file for Xconfig.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id:$
 * @since      	File available since v0.1
 */

//initialization
$dir = dirname(dirname(dirname(dirname(__FILE__))));
ini_set('include_path', '.'.PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9'
.PATH_SEPARATOR.$dir.'/Xconfig/php5');
require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';
require_once 'Ddth/Xconfig/ClassXconfig.php';

class XconfigTest extends PHPUnit_Framework_TestCase {
    public function testBasic() {
        $obj = new Ddth_Xconfig();
        $this->assertNotNull($obj, "Can not create Ddth::Xconfig object!");

        $this->assertEquals("", $obj->getXmlConfig(), "XML configuration string is not empty!");
    }

    public static function main() {
        PHPUnit_TextUI_TestRunner::run(XconfigTest::suite());
    }

    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit');
        $suite->addTest(XconfigTest::mySuite());
        return $suite;
    }

    public static function mySuite() {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit Framework');
        $suite->addTestSuite('XconfigTest');
        return $suite;
    }
}

if ( !defined('PHPUnit_MAIN_METHOD') ) {
    define('PHPUnit_MAIN_METHOD', 'XconfigTest::main');
}

XconfigTest::main();