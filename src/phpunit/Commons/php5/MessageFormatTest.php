<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Ddth::Commons::MessageFormat.
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
 * @version			$Id: MessageFormatTest.php 222 2010-11-21 07:25:10Z btnguyen2k@gmail.com $
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
require_once 'Ddth/Commons/ClassMessageFormat.php';

class MessageFormatTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creating a new MessageFormatTest object.
     */
    public function testCreateObject() {
        $mf = new Ddth_Commons_MessageFormat();
        $this->assertNotNull($mf);
        $this->assertNull($mf->getPattern());

        $mf = new Ddth_Commons_MessageFormat('pattern');
        $this->assertNotNull($mf);
        $this->assertEquals('pattern', $mf->getPattern());
    }

    /**
     * Tests stability
     */
    public function testStability() {
        $pattern = "Hello {name}, I am {me}!";
        $mf = new Ddth_Commons_MessageFormat($pattern);
        $this->assertNotNull($mf);

        $substitutes = NULL;
        $output = $mf->format($substitutes);
        $expected = "Hello {name}, I am {me}!";
        $this->assertEquals($expected, $output);

        $substitutes = 'NULL';
        $output = $mf->format($substitutes);
        $expected = "Hello {name}, I am {me}!";
        $this->assertEquals($expected, $output);

        $substitutes = Array();
        $output = $mf->format($substitutes);
        $expected = "Hello {name}, I am {me}!";
        $this->assertEquals($expected, $output);

        $substitutes = Array('not'=>'found');
        $output = $mf->format($substitutes);
        $expected = "Hello {name}, I am {me}!";
        $this->assertEquals($expected, $output);
    }

    /**
     * Basic and "easy" test.
     */
    public function testBasic() {
        $pattern = "Hello {name}, I am {me}!";
        $mf = new Ddth_Commons_MessageFormat($pattern);
        $this->assertNotNull($mf);

        $substitutes = Array('name'=>'Bob');
        $output = $mf->format($substitutes);
        $expected = "Hello Bob, I am {me}!";
        $this->assertEquals($expected, $output);

        $substitutes = Array('me'=>'Thanh');
        $output = $mf->format($substitutes);
        $expected = "Hello {name}, I am Thanh!";
        $this->assertEquals($expected, $output);

        $substitutes = Array('name'=>'Bob', 'me'=>'Thanh');
        $output = $mf->format($substitutes);
        $expected = "Hello Bob, I am Thanh!";
        $this->assertEquals($expected, $output);
    }
    
    /**
     * Tests with escape character
     */
    public function testEscape() {
        $pattern = 'Hello \{name\}, I am {me}!';
        $mf = new Ddth_Commons_MessageFormat($pattern);
        $this->assertNotNull($mf);

        $substitutes = Array('name'=>'Bob');
        $output = $mf->format($substitutes);
        $expected = "Hello {name}, I am {me}!";
        $this->assertEquals($expected, $output);
        
        $substitutes = Array('me'=>'Thanh');
        $output = $mf->format($substitutes);
        $expected = "Hello {name}, I am Thanh!";
        $this->assertEquals($expected, $output);
        
        $pattern = 'Hello {name}, I am \{me\}!\\';
        $mf = new Ddth_Commons_MessageFormat($pattern);
        $this->assertNotNull($mf);

        $substitutes = Array('name'=>'Bob');
        $output = $mf->format($substitutes);
        $expected = 'Hello Bob, I am {me}!\\';
        $this->assertEquals($expected, $output);
        
        $substitutes = Array('me'=>'Thanh');
        $output = $mf->format($substitutes);
        $expected = 'Hello {name}, I am {me}!\\';
        $this->assertEquals($expected, $output);
    }
    
    /**
     * Tests invalid tag.
     */
    public function testInvalidTag() {
        $pattern = 'Hello {name, I am {me!';
        $mf = new Ddth_Commons_MessageFormat($pattern);
        $this->assertNotNull($mf);
        
        $substitutes = Array();
        $output = $mf->format($substitutes);
        $expected = 'Hello {name, I am {me!';
        $this->assertEquals($expected, $output);
        
        $pattern = "Hello {na\nme}, I am {me!";
        $mf = new Ddth_Commons_MessageFormat($pattern);
        $this->assertNotNull($mf);
        
        $substitutes = Array("na\nme"=>'Bob');
        $output = $mf->format($substitutes);
        $expected = "Hello {na\nme}, I am {me!";
        $this->assertEquals($expected, $output);
    }
    
    /**
     * Tests substitution as an index array.
     */
    public function testIndexArray() {
        $pattern = "Hello {0}, I am {1}!";
        $mf = new Ddth_Commons_MessageFormat($pattern);
        $this->assertNotNull($mf);

        $substitutes = Array('Bob');
        $output = $mf->format($substitutes);
        $expected = "Hello Bob, I am {1}!";
        $this->assertEquals($expected, $output);
        
        $substitutes = Array('Bob', 'Thanh');
        $output = $mf->format($substitutes);
        $expected = "Hello Bob, I am Thanh!";
        $this->assertEquals($expected, $output);
    }
}
?>