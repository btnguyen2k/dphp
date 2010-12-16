<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Xnode.
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
 * @version			$Id: XnodeTest.php 222 2010-11-21 07:25:10Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

class XnodeTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creation of xml parser.
     */
    public function testParserCreation() {
        $xmlParser = Ddth_Xpath_XmlParser::getInstance();
        $this->assertNotNull($xmlParser);
    }

    /**
     * Tests parsing.
     */
    public function testParsing1() {
        $xmlParser = Ddth_Xpath_XmlParser::getInstance();
        $this->assertNotNull($xmlParser);
        $xml = '<?xml version="1.0" encoding="UTF-8"?><author><name>NGUYEN, Ba Thanh</name></author>';
        $xnode = $xmlParser->parseXml($xml);
        $this->assertNotNull($xnode);
        $this->assertTrue($xnode instanceof Ddth_Xpath_IXnode);

        $children = $xnode->xpath('/author');
        $this->assertTrue(is_array($children));
        $this->assertEquals(1, count($children));

        $child = $children[0];
        $this->assertTrue($child instanceof Ddth_Xpath_IXnode);
        $this->assertEquals('author', $child->getName());
    }

    /**
     * Tests parsing.
     */
    public function testParsing2() {
        $xmlParser = Ddth_Xpath_XmlParser::getInstance();
        $this->assertNotNull($xmlParser);
        $xml = '<?xml version="1.0" encoding="UTF-8"?><author><name>NGUYEN, Ba Thanh</name></author>';
        $xnode = $xmlParser->parseXml($xml);
        $this->assertNotNull($xnode);
        $this->assertTrue($xnode instanceof Ddth_Xpath_IXnode);

        $children = $xnode->xpath('/author/name');
        $this->assertTrue(is_array($children));
        $this->assertEquals(1, count($children));

        $child = $children[0];
        $this->assertTrue($child instanceof Ddth_Xpath_IXnode);
        $this->assertEquals('name', $child->getName());
        $this->assertEquals('NGUYEN, Ba Thanh', $child->getValue());
    }

    /**
     * Tests parsing.
     */
    public function testParsing3() {
        $xml = Ddth_Commons_Loader::loadFileContent('test.xml');
        $this->assertNotNull($xml);      
          
        $xmlParser = Ddth_Xpath_XmlParser::getInstance();
        $this->assertNotNull($xmlParser);

        $xnode = $xmlParser->parseXml($xml);
        $this->assertNotNull($xnode);
        $this->assertTrue($xnode instanceof Ddth_Xpath_IXnode);

        $children = $xnode->xpath('/action-mapping/default-handler');
        $this->assertTrue(is_array($children));
        $this->assertEquals(1, count($children));
        $child = $children[0];
        $this->assertTrue($child instanceof Ddth_Xpath_IXnode);
        $this->assertEquals('default-handler', $child->getName());
        $this->assertEquals('Ddth_Dzit_ReturnHomeHandler', $child->getAttribute('class'));
        
        $children = $xnode->xpath('/action-mapping/default-view');
        $this->assertTrue(is_array($children));
        $this->assertEquals(1, count($children));
        $child = $children[0];
        $this->assertTrue($child instanceof Ddth_Xpath_IXnode);
        $this->assertEquals('default-view', $child->getName());
        $this->assertEquals('Ddth_Dzit_DefaultViewRenderer', $child->getAttribute('class'));
        
        $children = $xnode->xpath('/action-mapping/handler[@action="index"]');
        $this->assertTrue(is_array($children));
        $this->assertEquals(1, count($children));
        $child = $children[0];
        $this->assertTrue($child instanceof Ddth_Xpath_IXnode);
        $this->assertEquals('handler', $child->getName());
        $this->assertEquals('index', $child->getAttribute('action'));
        $this->assertEquals('Ddth_Dzit_IndexHandler', $child->getAttribute('class'));
    }
    
    public function testFail() {
        $this->assertTrue(1==2);
    }
}
?>