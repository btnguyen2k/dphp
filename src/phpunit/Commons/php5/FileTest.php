<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Ddth::Commons::File.
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
 * @version			$Id: FileTest.php 222 2010-11-21 07:25:10Z btnguyen2k@gmail.com $
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
require_once 'Ddth/Commons/ClassLoader.php';

class FileTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creation of Ddth_Commons_File object.
     */
    public function testObjCreation() {
        $file = new Ddth_Commons_File("C:\\Windows\\");
        $this->assertNotNull($file);
    }

    /**
     * Tests basic functionalities.
     */
    public function testBasic() {
        $file = new Ddth_Commons_File("C:\\Windows\\");
        $this->assertNotNull($file);
        $this->assertEquals('C:/Windows', $file->getPathname());

        $file = new Ddth_Commons_File("C:\\Windows\\\\notepad.exe");
        $this->assertNotNull($file);
        $this->assertEquals('C:/Windows/notepad.exe', $file->getPathname());

        $file = new Ddth_Commons_File("C:\\Windows\\\\System32///cmd.exe");
        $this->assertNotNull($file);
        $this->assertEquals('C:/Windows/System32/cmd.exe', $file->getPathname());
    }

    /**
     * Tests string parent.
     */
    public function testParentString() {
        $file = new Ddth_Commons_File('notepad.exe', "C:\\Windows\\");
        $this->assertNotNull($file);
        $this->assertEquals('C:/Windows/notepad.exe', $file->getPathname());

        $file = new Ddth_Commons_File('cmd.exe', "C:\\Windows\\System32");
        $this->assertNotNull($file);
        $this->assertEquals('C:/Windows/System32/cmd.exe', $file->getPathname());
    }

    /**
     * Tests file parent.
     */
    public function testParentFile() {
        $parent = new Ddth_Commons_File("C:\\\\Windows\\\\");
        $this->assertNotNull($parent);
        $file = new Ddth_Commons_File('notepad.exe', $parent);
        $this->assertNotNull($file);
        $this->assertEquals('C:/Windows/notepad.exe', $file->getPathname());

        $parent = new Ddth_Commons_File("C:\\\\Windows\\\\System32");
        $this->assertNotNull($parent);
        $file = new Ddth_Commons_File('//cmd.exe', $parent);
        $this->assertNotNull($file);
        $this->assertEquals('C:/Windows/System32/cmd.exe', $file->getPathname());
    }

    /**
     * Test method getBasename().
     */
    public function testBasename() {
        $file = new Ddth_Commons_File('/etc/passwd');
        $this->assertNotNull($file);
        $this->assertEquals('passwd', $file->getBasename());
    }

    /**
     * Test method getExtension().
     */
    public function testExtension() {
        $file = new Ddth_Commons_File('test.txt');
        $this->assertNotNull($file);
        $this->assertEquals('txt', $file->getExtension());

        $file = new Ddth_Commons_File('/etc/.htaccess');
        $this->assertNotNull($file);
        $this->assertEquals('htaccess', $file->getExtension());

        $file = new Ddth_Commons_File('/etc/noext');
        $this->assertNotNull($file);
        $this->assertEquals('', $file->getExtension());
    }

    /**
     * Test method getFilename().
     */
    public function testFilename() {
        $file = new Ddth_Commons_File('test.txt');
        $this->assertNotNull($file);
        $this->assertEquals('test', $file->getFilename());

        $file = new Ddth_Commons_File('/etc/.htaccess');
        $this->assertNotNull($file);
        $this->assertEquals('', $file->getFilename());

        $file = new Ddth_Commons_File('/etc/noext');
        $this->assertNotNull($file);
        $this->assertEquals('noext', $file->getFilename());
    }

    /**
     * Test directory-related functionalities.
     */
    public function testDirectory() {
        $file = new Ddth_Commons_File('/');
        $this->assertNotNull($file);
        $this->assertTrue($file->isDirectory());
    }

    /**
     * Test file-related functionalities.
     */
    public function testFile() {
        $file = new Ddth_Commons_File(__FILE__);
        $this->assertNotNull($file);
        $this->assertTrue($file->isFile());
    }
}
?>