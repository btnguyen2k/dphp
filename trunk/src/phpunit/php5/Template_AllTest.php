<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Template for test suite bootstrap file.
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
 * @version			$Id$
 * @since      	File available since v0.1
 */

/*
 * Usage:
 *     define('PACKAGE', 'PackageName');
 *     $REQUIRED_PACKAGES = Array('Commons');
 *     include '../../php5/Template_AllTest.php';
 *
 * ===== Remember to define PACKAGE & $REQUIRED_PACKAGES *period to* including this file! =====
 */

define('PACKAGE_PHP_VERSION', 'php5');

//setting up include path
$dir = dirname(dirname(dirname(__FILE__)));
$INCLUDE_PATH = '.';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.PACKAGE.'/'.PACKAGE_PHP_VERSION;
if ( !isset($REQUIRED_PACKAGES) ) {
    $REQUIRED_PACKAGES = Array();
}
$REQUIRED_PACKAGES[] = 'Commons'; //the 'Commons' package is required by default
foreach ( $REQUIRED_PACKAGES as $package ) {
    $INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.$package.'/'.PACKAGE_PHP_VERSION;
}
if ( !isset($EXTRA_INCLUDE_PATHS) ) {
    $EXTRA_INCLUDE_PATHS = Array();
}
foreach ( $EXTRA_INCLUDE_PATHS as $path ) {
    $INCLUDE_PATH .= PATH_SEPARATOR.$dir.$path;
}
ini_set('include_path', $INCLUDE_PATH);

if ( !function_exists('__autoload') ) {
    /**
     * Automatically loads class source file when used.
     *
     * @param string
     * @ignore
     */
    function __autoload($className) {
        require_once 'Ddth/Commons/ClassDefaultClassNameTranslator.php';
        require_once 'Ddth/Commons/ClassLoader.php';
        $translator = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        if ( false === Ddth_Commons_Loader::loadClass($className, $translator) ) {
            trigger_error("Can not load class [$className]");
        }
    }
}

//the optional 1st command line argument is the name of the log file
if ( count($argv) > 1 ) {
    $logFile = $argv[1];
    @unlink($logFile);
    ini_set('error_log', $logFile);
}

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
                if ( $file != "AllTests.php" ) {
                    if ( preg_match("/^([\\w]+Test)\\.php$/", $file, $matches) ) {
                        include_once $file;
                        $suite->addTestSuite($matches[1]);
                    }
                }
            }
        }
        return $suite;
    }
}

AllTests::main();
?>
