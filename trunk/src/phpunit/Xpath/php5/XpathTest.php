<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Xpath.
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

class XpathTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creation of Ddth_Xpath_Xpath objects.
     */
    public function testObjCreation() {
        $obj = new Ddth_Xpath_Xpath();
        $this->assertNotNull($obj, "Can not create Ddth_Xpath_Xpath object!");

        $this->assertEquals("", $obj->getXmlConfig(), "XML configuration string is not empty!");
    }
    
    /**
     * Tests function Ddth_Xpath_Xpath::setXmlConfig().
     */
    public function testSetXmlConfig() {        
        $obj = new Ddth_Xpath_Xpath();
        $this->assertNotNull($obj, "Can not create Ddth_Xpath_Xpath object!");
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?><author><name>NGUYEN, Ba Thanh</name></author>';
        $obj->setXmlConfig($xml);
        $this->assertEquals($xml, $obj->getXmlConfig());
        
        $xml = '<?xml version="1.0"';
        $obj->setXmlConfig($xml);
        $this->assertEquals(NULL, $obj->getXmlConfig());
    }
    
    /**
     * Tests function Ddth_Xpath_Xpath::getNodes().
     */
    public function testGetNodes() {
        $xml = Ddth_Commons_Loader::loadFileContent('test.xml');
        $obj = new Ddth_Xpath_Xpath($xml);
        $this->assertNotNull($obj);
        
        $nodes = $obj->getNodes('/action-mapping/*');
        $this->assertEquals(5, count($nodes));
        $nodes = $obj->getNodes('/action-mapping/handler');
        $this->assertEquals(3, count($nodes));
    }
}
?>