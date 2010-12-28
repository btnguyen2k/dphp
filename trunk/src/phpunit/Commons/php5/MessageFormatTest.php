<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Ddth::Commons::MessageFormat.
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