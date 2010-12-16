<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Ddth::Commons::Properties.
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
 * @version			$Id: PropertiesTest.php 222 2010-11-21 07:25:10Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

//initialization
//defines package name and package php version
if ( !defined('PACKAGE') ) {
    define('PACKAGE', 'Commons');
}
if ( !defined('PACKAGE_PHP_VERSION') ) {
    define('PACKAGE_PHP_VERSION', 'php5');
}

//setting up include path
$dir = dirname(dirname(dirname(dirname(__FILE__))));
$INCLUDE_PATH = '.';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.PACKAGE.'/'.PACKAGE_PHP_VERSION;
ini_set('include_path', $INCLUDE_PATH);

require_once 'PHPUnit/Framework.php';
require_once 'Ddth/Commons/ClassProperties.php';

class PropertiesTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creating a new Properties object.
     */
    public function testCreateObject() {
        $prop = new Ddth_Commons_Properties();
        $this->assertNotNull($prop);
    }
    
    /**
     * Tests basic getProperties() and setProperties operations.
     */
    public function testBasicGetSet() {
        $prop = new Ddth_Commons_Properties();
        $this->assertNotNull($prop);
        
        $this->assertNull($prop->setProperty("key1", "value1", "comment1"));
        $this->assertEquals("value1", $prop->getProperty("key1"));
        $this->assertEquals("comment1", $prop->getComment("key1"));
        $this->assertEquals(1, $prop->count());
        
        $this->assertEquals("value1", $prop->setProperty("key1", "value2"));
        $this->assertEquals("value2", $prop->getProperty("key1"));
        $this->assertNull($prop->getComment("key1"));
        $this->assertEquals(1, $prop->count());
    }
    
    /**
     * Tests export() operation.
     */
    public function testExport() {
        $prop1 = new Ddth_Commons_Properties();
        $this->assertNotNull($prop1);
        $prop2 = new Ddth_Commons_Properties();
        $this->assertNotNull($prop2);
        
        $content = file_get_contents('test.properties');
        $prop1->import($content);
        $this->assertEquals(3, $prop1->count());
        
        $content = $prop1->export();
        $prop2->import($content);
        $this->assertEquals(3, $prop2->count());
        
        foreach ( $prop1->keys() as $key ) {
            $value1 = $prop1->getProperty($key);
            $value2 = $prop2->getProperty($key);
            $comment1 = $prop1->getComment($key);
            $comment2 = $prop2->getComment($key);
            $this->assertEquals($value1, $value2);
            $this->assertEquals($comment1, $comment2);
        }
    }
    
	/**
     * Tests import() operation.
     */
    public function testImport() {
        $prop = new Ddth_Commons_Properties();
        $this->assertNotNull($prop);
        
        $content = file_get_contents('test.properties');
        $prop->import($content);
        $this->assertEquals(3, $prop->count());
    }
    
	/**
     * Tests load() operation.
     */
    public function testLoad() {
        $prop = new Ddth_Commons_Properties();
        $this->assertNotNull($prop);
        
        $prop->load('test.properties');
        $this->assertEquals(3, $prop->count());
    }
    
/**
     * Tests store() operation.
     */
    public function testStore() {
        $prop1 = new Ddth_Commons_Properties();
        $this->assertNotNull($prop1);
        $prop2 = new Ddth_Commons_Properties();
        $this->assertNotNull($prop2);
        
        $prop1->load('test.properties');        
        $this->assertEquals(3, $prop1->count());
        
        $r = rand(1, time());        
        $r = "$r.properties";
        $prop1->store($r);
        $prop2->load($r);
        $this->assertEquals(3, $prop2->count());
        unlink($r);
        foreach ( $prop1->keys() as $key ) {
            $value1 = $prop1->getProperty($key);
            $value2 = $prop2->getProperty($key);
            $comment1 = $prop1->getComment($key);
            $comment2 = $prop2->getComment($key);
            $this->assertEquals($value1, $value2);
            $this->assertEquals($comment1, $comment2);
        }
    }
}
?>