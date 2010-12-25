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
 * @version     $Id$
 * @since       File available since v0.1
 */

/**
 */
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
