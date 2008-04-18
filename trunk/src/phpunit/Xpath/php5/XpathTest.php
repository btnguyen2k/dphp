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
     * Tests creation of Ddth::Xpath::Xpath objects.
     */
    public function testObjCreation() {
        $obj = new Ddth_Xpath_Xpath();
        $this->assertNotNull($obj, "Can not create Ddth::Xpath::Xpath object!");

        $this->assertEquals("", $obj->getXmlConfig(), "XML configuration string is not empty!");
    }
    
    /**
     * Sets function Ddth_Xpath::setXmlConfig().
     */
    public function testSetXmlConfig() {        
        $obj = new Ddth_Xpath_Xpath();
        $this->assertNotNull($obj, "Can not create Ddth::Xpath::Xpath object!");
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?><author><name>NGUYEN, Ba Thanh</name></author>';
        $obj->setXmlConfig($xml);
        $this->assertEquals($xml, $obj->getXmlConfig(), "XML configuration string does not match!");
        
        $xml = '<?xml version="1.0"';
        $obj->setXmlConfig($xml);
        $this->assertEquals(NULL, $obj->getXmlConfig(), "XML configuration string does not match!");
    }
}
?>