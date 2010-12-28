<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Ddth::Commons::File.
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