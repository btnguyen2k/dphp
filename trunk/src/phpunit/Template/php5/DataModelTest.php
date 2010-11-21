<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Template-DataModel.
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
 * @version			$Id: TemplateTest.php 159 2008-04-07 19:54:58Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

if ( !function_exists('__autoload') ) {
    /**
     * Automatically loads class source file when used.
     *
     * @param string
     * @ignore
     */
    function __autoload($className) {
        require_once 'Ddth/Commons/ClassDefaultClassNameTranslator.php';
        require_once 'Ddth/Commons/ClassLoader.php';
        $translator = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        if ( false === Ddth_Commons_Loader::loadClass($className, $translator) ) {
            trigger_error("Can not load class [$className]");
        }
    }
}

//initialization
//defines package name and package php version
if ( !defined('PACKAGE') ) {
    define('PACKAGE', 'Mls');
}
if ( !defined('PACKAGE_PHP_VERSION') ) {
    define('PACKAGE_PHP_VERSION', 'php5');
}
$REQUIRED_PACKAGES = Array('Commons');

//setting up include path
$dir = dirname(dirname(dirname(dirname(__FILE__))));
$INCLUDE_PATH = '.';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/Smarty-2.6.19';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.PACKAGE.'/'.PACKAGE_PHP_VERSION;
foreach ( $REQUIRED_PACKAGES as $package ) {
    $INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.$package.'/'.PACKAGE_PHP_VERSION;
}
ini_set('include_path', $INCLUDE_PATH);

require_once 'PHPUnit/Framework.php';
require_once 'Ddth/Template/ClassTemplateFactory.php';

class DataModelTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests scalar data model.
     */
    public function testScalar() {
        $name = 'name';
        $value = 'value';
        $dm = new Ddth_Template_DataModel_Scalar($name, $value);
        $this->assertEquals($name, $dm->getName());
        $this->assertEquals($value, $dm->getValue());
        $this->assertTrue(is_scalar($dm->getValue()));
        $this->assertTrue(is_string($dm->getValue()));

        $name = 'name';
        $value = 1;
        $dm = new Ddth_Template_DataModel_Scalar($name, $value);
        $this->assertEquals($name, $dm->getName());
        $this->assertEquals($value, $dm->getValue());
        $this->assertTrue(is_scalar($dm->getValue()));
        $this->assertTrue(is_numeric($dm->getValue()));
    }

    /**
     * Tests bean data model.
     */
    public function testBean() {
        $name = 'name';
        $msg = 'Test Error Message';
        $value = new Exception($msg);
        $dm = new Ddth_Template_DataModel_Bean($name, $value);
        $this->assertEquals($name, $dm->getName());
        $this->assertTrue($dm->getValue() instanceof Exception);
        $this->assertEquals($value->getMessage(), $dm->getValue()->getMessage());
    }

    /**
     * Tests list data model.
     */
    public function testList() {
        $name = 'name';
        $dm = new Ddth_Template_DataModel_List($name);
        $dm->addChild('1');
        $dm->addChild(2);
        $msg = 'Test Error Message';
        $dm->addChild(new Exception($msg));
        $this->assertEquals($name, $dm->getName());
        $this->assertEquals(3, $dm->countChildren());

        $child = $dm->getChild(0);
        $this->assertTrue(is_string($child->getValue()));
        $this->assertEquals('1', $child->getValue());

        $child = $dm->getChild(1);
        $this->assertTrue(is_numeric($child->getValue()));
        $this->assertEquals(2, $child->getValue());

        $child = $dm->getChild(2);
        $this->assertTrue($child instanceof Ddth_Template_DataModel_Bean);
        $this->assertTrue($child->getValue() instanceof Exception);
        $this->assertEquals($msg, $child->getValue()->getMessage());
    }

    /**
     * Tests map data model.
     */
    public function testMap() {
        $name = 'name';
        $dm = new Ddth_Template_DataModel_Map($name);
        $dm->addChild('child1', '1');
        $dm->addChild('child2', 2);
        $msg = 'Test Error Message';
        $dm->addChild('child3', new Exception($msg));
        $this->assertEquals($name, $dm->getName());
        $this->assertEquals(3, $dm->countChildren());

        $child = $dm->getChild('child1');
        $this->assertEquals('child1', $child->getName());
        $this->assertTrue(is_string($child->getValue()));
        $this->assertEquals('1', $child->getValue());

        $child = $dm->getChild('child2');
        $this->assertEquals('child2', $child->getName());
        $this->assertTrue(is_numeric($child->getValue()));
        $this->assertEquals(2, $child->getValue());

        $child = $dm->getChild('child3');
        $this->assertEquals('child3', $child->getName());
        $this->assertTrue($child instanceof Ddth_Template_DataModel_Bean);
        $this->assertTrue($child->getValue() instanceof Exception);
        $this->assertEquals($msg, $child->getValue()->getMessage());
    }
}
?>