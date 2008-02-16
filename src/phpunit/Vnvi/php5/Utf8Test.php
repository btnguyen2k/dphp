<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Ddth::Vnvi::Utf8.
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

class LoaderTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests DefaultClassNameTranslator's functionality.
     */
    public function testDefaultClassNameTranslator() {
        require_once 'Ddth/Commons/ClassDefaultClassNameTranslator.php';
        $instance = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        $this->assertNotNull($instance, "Can not get instance of class Ddth_Commons_DefaultClassNameTranslator");
        
        $filename = $instance->translateClassNameToFileName("Ddth_Commons_DefaultClassNameTranslator");
        $this->assertEquals("Ddth/Commons/ClassDefaultClassNameTranslator.php", $filename, "Class name to file name translation failed!");
    }
}
?>