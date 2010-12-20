<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for AdodbHelper.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: AdodbTest.php 137 2008-02-28 00:27:48Z btnguyen2k@gmail.com $
 * @since       File available since v0.1.2
 */

//initialization
//defines package name and package php version
if ( !defined('PACKAGE') ) {
    define('PACKAGE', 'Adodb');
}
if ( !defined('PACKAGE_PHP_VERSION') ) {
    define('PACKAGE_PHP_VERSION', 'php5');
}
$REQUIRED_PACKAGES = Array('Commons');

//setting up include path
$dir = dirname(dirname(dirname(dirname(__FILE__))));
$INCLUDE_PATH = '.';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.PACKAGE.'/'.PACKAGE_PHP_VERSION;
foreach ( $REQUIRED_PACKAGES as $package ) {
    $INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.$package.'/'.PACKAGE_PHP_VERSION;
}
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/AdoDb5-5.0.4';
ini_set('include_path', $INCLUDE_PATH);

require_once 'PHPUnit/Framework.php';

class AdodbHelperTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests functionality of Ddth::Adodb::AdodbHelper::buildArrayParams().
     */
    public function testBuildArrayParams() {
        $expected = '?';
        $result = Ddth_Adodb_AdodbHelper::buildArrayParams();
        $this->assertEquals($expected, $result);

        $expected = '?,?,?';
        $result = Ddth_Adodb_AdodbHelper::buildArrayParams(3);
        $this->assertEquals($expected, $result);
    }
}
?>
