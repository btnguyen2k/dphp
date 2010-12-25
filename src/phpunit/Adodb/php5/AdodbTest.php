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
class AdodbTest extends PHPUnit_Framework_TestCase {
    protected function setup() {
        parent::setUp();
        $dir = '../../../tmp';
        if ( !is_dir($dir) ) {
            mkdir($dir);
        }
        @unlink('../../../tmp/adodbtest.db');
        //copy('../../../firebirdembed/blankdb.gdb', '../../../tmp/adodbtest.gdb');

        global $DPHP_ADODB_CONFIG;
        $DPHP_ADODB_CONFIG = Array(
            'adodb.driver'      => 'sqlite'
            ,
            'adodb.host'        => '../../../tmp/adodbtest.db'
            ,
            'adodb.user'        => ''
            ,
            'adodb.password'    => ''
            ,
            'adodb.database'    => 'adodbtest'
            ,
            #'adodb.url'         => 'mysql://test:test@localhost/test'
            #,
            #'adodb.setupSqls    => "SET NAMES 'utf8'"
            );
    }

    /**
     * Tests creation of Ddth::Adodb::AdodbFactory objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Adodb_AdodbFactory::getInstance();
        $this->assertNotNull($obj1, "Can not create Ddth::Adodb::AdodbFactory object!");

        $obj2 = Ddth_Adodb_AdodbFactory::getInstance();
        $this->assertTrue($obj1===$obj2);
    }

    /**
     * Tests creation of ADOConnection.
     */
    public function testConnCreation() {
        $obj = Ddth_Adodb_AdodbFactory::getInstance();
        $this->assertNotNull($obj, "Can not create Ddth::Adodb::AdodbFactory object!");

        /**
         * @var ADOConnection
         */
        $conn = $obj->getConnection();
        $this->assertNotNull($conn);
        $obj->closeConnection($conn);
    }

    /**
     * Tests Creating database table.
     */
    public function testCreateTable() {
        $obj = Ddth_Adodb_AdodbFactory::getInstance();
        $this->assertNotNull($obj, "Can not create Ddth::Adodb::AdodbFactory object!");

        /**
         * @var ADOConnection
         */
        $conn = $obj->getConnection();
        $this->assertNotNull($conn);
        $sql = 'CREATE TABLE tblPerson (LastName VARCHAR(32), FirstName VARCHAR(32), Address VARCHAR(64), City VARCHAR(32))';
        $conn->Execute($sql);
        $obj->closeConnection($conn);
    }

    /**
     * Tests Inserting some data.
     */
    public function testInsert() {
        $this->testCreateTable();

        $obj = Ddth_Adodb_AdodbFactory::getInstance();
        $this->assertNotNull($obj, "Can not create Ddth::Adodb::AdodbFactory object!");

        /**
         * @var ADOConnection
         */
        $conn = $obj->getConnection();
        $this->assertNotNull($conn);

        $sql = 'INSERT INTO tblPerson (LastName, FirstName, Address, City) VALUES (?, ?, ?, ?)';
        $conn->Execute($sql, Array('Hansen', 'Ola', 'Timoteivn 10', 'Sandnes'));
        $conn->Execute($sql, Array('Svendson', 'Tove', 'Borgvn 23', 'Sandnes'));
        $conn->Execute($sql, Array('Pettersen', 'Kari', 'Storgt 20', 'Stavanger'));

        $obj->closeConnection($conn);
    }

    /**
     * Tests Selecting some data from table.
     */
    public function testSelect() {
        $this->testInsert();

        $obj = Ddth_Adodb_AdodbFactory::getInstance();
        $this->assertNotNull($obj, "Can not create Ddth::Adodb::AdodbFactory object!");

        /**
         * @var ADOConnection
         */
        $conn = $obj->getConnection();
        $this->assertNotNull($conn);

        $sql = 'SELECT count(*) FROM tblPerson';
        $rs = $conn->Execute($sql);
        $this->assertTrue($rs !== false);
        $this->assertTrue($rs->fields[0] == 3); //$rs->fields[0] is a string, so do not use ===

        $sql = "SELECT count(*) FROM tblPerson WHERE LastName='Hansen'";
        $rs = $conn->Execute($sql);
        $this->assertTrue($rs !== false);
        $this->assertTrue($rs->fields[0] == 1); //$rs->fields[0] is a string, so do not use ===

        $sql = "SELECT count(*) FROM tblPerson WHERE FirstName='Not Found'";
        $rs = $conn->Execute($sql);
        $this->assertTrue($rs !== false);
        $this->assertTrue($rs->fields[0] == 0); //$rs->fields[0] is a string, so do not use ===

        $obj->closeConnection($conn);
    }
}
?>