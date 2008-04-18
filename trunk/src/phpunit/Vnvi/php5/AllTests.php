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

//initialization
//defines package name and package php version
if ( !defined('PACKAGE') ) {
    define('PACKAGE', 'Vnvi');
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
require_once 'Ddth/Vnvi/ClassUtf8.php';
require_once 'Ddth/Vnvi/ClassConstants.php';
//require_once 'Ddth/Commons/ClassLoader.php';

class Utf8Test extends PHPUnit_Framework_TestCase {
    /**
     * Tests creating Ddth_Vnvi_Utf8 instance.
     */
    public function testCreateInstance() {
        $obj = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($obj instanceof Ddth_Vnvi_Utf8);
    }

    /**
     * Tests removeToneMarks() functionality.
     */
    public function testRemoveToneMarks() {
        $utf8 = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($utf8 instanceof Ddth_Vnvi_Utf8);

        $in = 'Nguyễn Bá Thành';
        $out = $utf8->removeToneMarks($in);
        $expected = 'Nguyên Ba Thanh';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'nGUYỄN bÁ tHÀNH';
        $out = $utf8->removeToneMarks($in);
        $expected = 'nGUYÊN bA tHANH';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'Diễn Đàn Tin Học';
        $out = $utf8->removeToneMarks($in);
        $expected = 'Diên Đan Tin Hoc';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'dIỄN đÀN tIN hỌC';
        $out = $utf8->removeToneMarks($in);
        $expected = 'dIÊN đAN tIN hOC';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
    }

    /**
     * Tests deVietnamese() functionality.
     */
    public function testDeVietnamese() {
        $utf8 = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($utf8 instanceof Ddth_Vnvi_Utf8);

        $in = 'Nguyễn Bá Thành';
        $out = $utf8->deVietnamese($in);
        $expected = 'Nguyen Ba Thanh';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'nGUYỄN bÁ tHÀNH';
        $out = $utf8->deVietnamese($in);
        $expected = 'nGUYEN bA tHANH';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'Diễn Đàn Tin Học';
        $out = $utf8->deVietnamese($in);
        $expected = 'Dien Dan Tin Hoc';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'dIỄN đÀN tIN hỌC';
        $out = $utf8->deVietnamese($in);
        $expected = 'dIEN dAN tIN hOC';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
    }

    /**
     * Tests toLower() functionality.
     */
    public function testToLower() {
        $utf8 = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($utf8 instanceof Ddth_Vnvi_Utf8);

        $in = 'Nguyễn Bá Thành';
        $out = $utf8->toLower($in);
        $expected = 'nguyễn bá thành';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'nGUYỄN bÁ tHÀNH';
        $out = $utf8->toLower($in);
        $expected = 'nguyễn bá thành';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'Diễn Đàn Tin Học';
        $out = $utf8->toLower($in);
        $expected = 'diễn đàn tin học';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'dIỄN đÀN tIN hỌC';
        $out = $utf8->toLower($in);
        $expected = 'diễn đàn tin học';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
    }

    /**
     * Tests toUpper() functionality.
     */
    public function testToUpper() {
        $utf8 = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($utf8 instanceof Ddth_Vnvi_Utf8);

        $in = 'Nguyễn Bá Thành';
        $out = $utf8->toUpper($in);
        $expected = 'NGUYỄN BÁ THÀNH';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'nGUYỄN bÁ tHÀNH';
        $out = $utf8->toUpper($in);
        $expected = 'NGUYỄN BÁ THÀNH';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'Diễn Đàn Tin Học';
        $out = $utf8->toUpper($in);
        $expected = 'DIỄN ĐÀN TIN HỌC';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");

        $in = 'dIỄN đÀN tIN hỌC';
        $out = $utf8->toUpper($in);
        $expected = 'DIỄN ĐÀN TIN HỌC';
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
    }
    
    /**
     * Tests getLetterToneMark() functionality. 
     */
    public function testGetLetterToneMark() {
        $utf8 = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($utf8 instanceof Ddth_Vnvi_Utf8);
        
        $in = 'ễ';
        $out = $utf8->getLetterToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_TILDE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'ê';
        $out = $utf8->getLetterToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_NONE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'Ễ';
        $out = $utf8->getLetterToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_TILDE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'Ê';
        $out = $utf8->getLetterToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_NONE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
    }
    
    /**
     * Tests getWordToneMark() functionality.
     */
    public function testGetWordToneMark() {
        $utf8 = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($utf8 instanceof Ddth_Vnvi_Utf8);
        
        $in = 'Diễn';
        $out = $utf8->getWordToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_TILDE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'Đàn';
        $out = $utf8->getWordToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_GRAVE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'Tin';
        $out = $utf8->getWordToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_NONE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'Học';
        $out = $utf8->getWordToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_DROP;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'Nguyễn';
        $out = $utf8->getWordToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_TILDE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'Bá';
        $out = $utf8->getWordToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_ACUTE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $in = 'Thành';
        $out = $utf8->getWordToneMark($in);
        $expected = Ddth_Vnvi_Constants::MARK_GRAVE;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
    }
    
    /**
     * Tests compareStrings() functionality.
     */
    public function testCompareStrings() {
        $utf8 = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($utf8 instanceof Ddth_Vnvi_Utf8);
        
        $str1 = 'Diền';
        $str2 = 'Diễn';        
        $out = $utf8->compareStrings($str1, $str2);
        $expected = -1;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $str1 = 'diền';
        $str2 = 'Diễn';        
        $out = $utf8->compareStrings($str1, $str2);
        $expected = 1;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $str1 = 'diền';
        $str2 = 'Diễn';        
        $out = $utf8->compareStrings($str1, $str2, true);
        $expected = -1;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
    }
    
/**
     * Tests compareWords() functionality.
     */
    public function testCompareWords() {
        $utf8 = Ddth_Vnvi_Utf8::getInstance();
        $this->assertTrue($utf8 instanceof Ddth_Vnvi_Utf8);
        
        $str1 = 'hòa';
        $str2 = 'hoà';        
        $out = $utf8->compareWords($str1, $str2);
        $expected = 0;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
        
        $str1 = ' Hòa ';
        $str2 = '   hoÀ';        
        $out = $utf8->compareWords($str1, $str2, true);
        $expected = 0;
        $this->assertEquals($expected, $out, "Expected '$expected' but received '$out'");
    }
}
?>