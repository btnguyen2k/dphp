<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Mls.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.1
 */

/**
 */
class MlsTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creation of language factory
     */
    public function testObjCreation() {
        $obj1 = Ddth_Mls_BaseLanguageFactory::getInstance();
        $this->assertNotNull($obj1, "Can not create language factory!");

        $obj2 = Ddth_Mls_BaseLanguageFactory::getInstance();
        $this->assertNotNull($obj2, "Can not create language factory!");

        $this->assertTrue($obj1 === $obj2, "The two objects are expected to be equal!");
    }

    /**
     * Tests creation of language packs
     */
    public function testGetLanguage() {
        $obj = Ddth_Mls_BaseLanguageFactory::getInstance();
        $this->assertNotNull($obj, "Can not create language factory!");

        $lang = $obj->getLanguage('default');
        $this->assertNotNull($lang);
        $this->assertEquals('default', $lang->getName());
        $this->assertEquals('Default', $lang->getDisplayName());

        $lang = $obj->getLanguage('vn');
        $this->assertNotNull($lang);
        $this->assertEquals('vn', $lang->getName());
        $this->assertEquals('Vietnamese', $lang->getDisplayName());
    }

    /**
     * Tests default language pack
     */
    public function testLanguageDefault() {
        $obj = Ddth_Mls_BaseLanguageFactory::getInstance();
        $this->assertNotNull($obj, "Can not create language factory!");

        $lang = $obj->getLanguage('default');
        $this->assertNotNull($lang);
        $this->assertEquals('default', $lang->getName());
        $this->assertEquals('Default', $lang->getDisplayName());

        $this->assertEquals('Hello', $lang->getMessage('msg.hello'));
        $this->assertEquals('Error', $lang->getMessage('error.error'));
        $this->assertEquals('Hello {0}!', $lang->getMessage('msg.param1'));
        $this->assertEquals('Hello Bob!', $lang->getMessage('msg.param1', 'Bob'));
        $this->assertEquals('There are error A and B', $lang->getMessage('error.param2', 'A', 'B'));
        $this->assertEquals('There are error A and B', $lang->getMessage('error.param2', Array('A', 'B')));
    }

    /**
     * Tests vn language pack
     */
    public function _testLanguageVn() {
        $obj = Ddth_Mls_BaseLanguageFactory::getInstance();
        $this->assertNotNull($obj, "Can not create language factory!");

        $lang = $obj->getLanguage('vn');
        $this->assertNotNull($lang);
        $this->assertEquals('vn', $lang->getName());
        $this->assertEquals('Vietnamese', $lang->getDisplayName());

        $this->assertEquals('Xin chào!', $lang->getMessage('msg.hello'));
        $this->assertEquals('Có lỗi', $lang->getMessage('error.error'));
        $this->assertEquals('Xin chào {0}!', $lang->getMessage('msg.hello1'));
        $this->assertEquals('Xin chào Thành!', $lang->getMessage('msg.hello1', 'Thành'));
        $this->assertEquals('Xin chào Thành!', $lang->getMessage('msg.hello1', Array('Thành')));
    }
}
?>