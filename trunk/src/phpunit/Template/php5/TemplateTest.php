<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Mls.
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
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @id			$Id$
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

class TemplateTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creation of language factory
     */
    public function testObjCreation() {
        $obj1 = Ddth_Template_TemplateFactory::getInstance();
        $this->assertNotNull($obj1, "Can not create template factory!");

        $obj2 = Ddth_Template_TemplateFactory::getInstance();
        $this->assertNotNull($obj2, "Can not create language factory!");

        $this->assertTrue($obj1===$obj2);
    }
    
    /**
     * Gets retrieval of a template.
     */
    public function testGetTemplate() {
        $factory = Ddth_Template_TemplateFactory::getInstance();
        $this->assertNotNull($factory, "Can not create template factory!");
        
        $templateList = $factory->getTemplateNames();
        $this->assertEquals(2, count($templateList));
        $this->assertEquals('smarty', $templateList[0]);
        $this->assertEquals('php', $templateList[1]);
        
        $template = $factory->getTemplate($templateList[0]);
        $this->assertTrue($template instanceof Ddth_Template_Smarty_SmartyTemplate);
        
        $template = $factory->getTemplate($templateList[1]);
        $this->assertTrue($template instanceof Ddth_Template_Php_PhpTemplate);
    }

//    /**
//     * Tests creation of language packs
//     */
//    public function testGetLanguage() {
//        $obj = Ddth_Mls_LanguageFactory::getInstance();
//        $this->assertNotNull($obj, "Can not create language factory!");
//        
//        $lang = $obj->getLanguage('default');
//        $this->assertNotNull($lang);
//        $this->assertEquals('default', $lang->getName());
//        $this->assertEquals('Default', $lang->getDisplayName());
//
//        $lang = $obj->getLanguage('vn');
//        $this->assertNotNull($lang);
//        $this->assertEquals('vn', $lang->getName());
//        $this->assertEquals('Vietnamese', $lang->getDisplayName());
//    }
//
//    /**
//     * Tests default language pack
//     */
//    public function testLanguageDefault() {
//        $obj = Ddth_Mls_LanguageFactory::getInstance();
//        $this->assertNotNull($obj, "Can not create language factory!");
//        
//        $lang = $obj->getLanguage('default');
//        $this->assertNotNull($lang);
//        $this->assertEquals('default', $lang->getName());
//        $this->assertEquals('Default', $lang->getDisplayName());
//
//        $this->assertEquals('Hello', $lang->getMessage('msg.hello'));
//        $this->assertEquals('Error', $lang->getMessage('error.error'));
//        $this->assertEquals('Hello {0}!', $lang->getMessage('msg.param1'));
//        $this->assertEquals('Hello Bob!', $lang->getMessage('msg.param1', 'Bob'));
//        $this->assertEquals('There are error A and B', $lang->getMessage('error.param2', 'A', 'B'));
//        $this->assertEquals('There are error A and B', $lang->getMessage('error.param2', Array('A', 'B')));
//    }
//
//    /**
//     * Tests vn language pack
//     */
//    public function testLanguageVn() {
//        $obj = Ddth_Mls_LanguageFactory::getInstance();
//        $this->assertNotNull($obj, "Can not create language factory!");
//        
//        $lang = $obj->getLanguage('vn');
//        $this->assertNotNull($lang);
//        $this->assertEquals('vn', $lang->getName());
//        $this->assertEquals('Vietnamese', $lang->getDisplayName());
//
//        $this->assertEquals('Xin chào!', $lang->getMessage('msg.hello'));
//        $this->assertEquals('Có lỗi', $lang->getMessage('error.error'));
//        $this->assertEquals('Xin chào {0}!', $lang->getMessage('msg.hello1'));
//        $this->assertEquals('Xin chào Thành!', $lang->getMessage('msg.hello1', 'Thành'));
//        $this->assertEquals('Xin chào Thành!', $lang->getMessage('msg.hello1', Array('Thành')));
//    }
}
?>