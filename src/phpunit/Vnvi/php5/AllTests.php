<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test suite bootstrap for package Vnvi.
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
if ( !defined('PHPUnit_MAIN_METHOD') ) {
    define('PHPUnit_MAIN_METHOD', 'AllTests::main');
}

//defines package name and package php version
define('PACKAGE', 'Vnvi');
define('PACKAGE_PHP_VERSION', 'php5');

//setting up include path
$dir = dirname(dirname(dirname(dirname(__FILE__))));
$INCLUDE_PATH = '.';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.PACKAGE.'/'.PACKAGE_PHP_VERSION;
ini_set('include_path', $INCLUDE_PATH);

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

class AllTests {
    public static function main() {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit');
        if ( $handle = opendir('.') ) {
            while ( false !== ($file = readdir($handle)) ) {
                if ( preg_match("/^([\\w]+Test)\\.php$/", $file, $matches) ) {
                    include_once $file;
                    $suite->addTestSuite($matches[1]);                    
                }
            }
        }
        return $suite;
    }
}

if ( PHPUnit_MAIN_METHOD == 'AllTests::main' ) {
    AllTests::main();
}
?>