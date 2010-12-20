<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Adodb.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: AdodbTest.php 211 2009-02-15 10:52:50Z btnguyen2k@gmail.com $
 * @since       File available since v0.1
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

class AdodbSqlStatementTest extends PHPUnit_Framework_TestCase {

    const CONFIG_FILE = 'dphp-adodb.statements.properties';

    protected function setup() {
        parent::setUp();
        $dir = '../../../tmp';
        if ( !is_dir($dir) ) {
            mkdir($dir);
        }
        copy('../../../firebirdembed/blankdb.gdb', '../../../tmp/adodbtest.gdb');
    }

    /**
     * Tests creation of Ddth::Adodb::AdodbSqlStatementFactory objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($obj1, "Can not create Ddth::Adodb::AdodbSqlStatementFactory object!");

        $obj2 = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertTrue($obj1===$obj2);
    }
}
?>
