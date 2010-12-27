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
     * Tests creation of Ddth_Adodb_AdodbSqlStatementFactory objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($obj1, "Can not create Ddth_Adodb_AdodbSqlStatementFactory object!");

        $obj2 = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertTrue($obj1===$obj2, "The two objects are expected to be equal!");
    }

    public function testGetStatement() {
        $factory = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($factory, "Can not create Ddth_Adodb_AdodbSqlStatementFactory object!");

        $name = 'sql.createTable';
        $stm = $factory->getSqlStatement($name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");
        $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);

        $name = 'sql.createUser';
        $stm = $factory->getSqlStatement($name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");
        $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);

        $name = 'sql.getUserById';
        $stm = $factory->getSqlStatement($name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");
        $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);

        $name = 'sql.getUserByUsername';
        $stm = $factory->getSqlStatement($name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");
        $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);

        $name = 'sql.getUserByEmail';
        $stm = $factory->getSqlStatement($name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");
        $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);

        $name = 'sql.not-exist';
        $stm = $factory->getSqlStatement($name);
        $this->assertNull($stm);
    }

    public function testQueryCreateTable() {
        $stmFactory = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($stmFactory, "Can not create Ddth_Adodb_AdodbSqlStatementFactory object!");

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        try{
            $name = 'sql.createTable';
            $stm = $stmFactory->getSqlStatement($name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);
            $stm->prepareAndExecute($conn);
        } catch ( Exception $e ) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ( $exception !== NULL ) {
            throw $exception;
        }
    }

    public function testQueryCreateUsers() {
        $this->testQueryCreateTable();

        $stmFactory = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($stmFactory, "Can not create Ddth_Adodb_AdodbSqlStatementFactory object!");

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection(TRUE);
        try{
            $name = 'sql.createUser';
            $stm = $stmFactory->getSqlStatement($name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);
            $stm->prepareAndExecute($conn, Array(1, 'first',  'first-user@local'));
            $stm->prepareAndExecute($conn, Array(2, 'second', 'second-user@local'));
            $stm->prepareAndExecute($conn, Array(3, 'third',  'third-user@local'));
        } catch ( Exception $e ) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ( $exception !== NULL ) {
            throw $exception;
        }
    }

    public function testQueryGetUser1() {
        $this->testQueryCreateUsers();

        $stmFactory = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($stmFactory, "Can not create Ddth_Adodb_AdodbSqlStatementFactory object!");

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.getUserById';
            $stm = $stmFactory->getSqlStatement($name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);
            $resultSet = $stm->prepareAndExecute($conn, Array(1));
            $this->assertNotNull($resultSet);
            $this->assertFalse($resultSet->EOF);
            $this->assertEquals(1, $resultSet->fields['id']);
            $this->assertEquals('first', $resultSet->fields['username']);
            $this->assertEquals('first-user@local', $resultSet->fields['email']);
            $resultSet->Close();
        } catch ( Exception $e ) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ( $exception !== NULL ) {
            throw $exception;
        }
    }

    public function testQueryGetUser2() {
        $this->testQueryCreateUsers();

        $stmFactory = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($stmFactory, "Can not create Ddth_Adodb_AdodbSqlStatementFactory object!");

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.getUserByUsername';
            $stm = $stmFactory->getSqlStatement($name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);
            $resultSet = $stm->prepareAndExecute($conn, Array('second'));
            $this->assertNotNull($resultSet);
            $this->assertFalse($resultSet->EOF);
            $this->assertEquals(2, $resultSet->fields['id']);
            $this->assertEquals('second', $resultSet->fields['username']);
            $this->assertEquals('second-user@local', $resultSet->fields['email']);
            $resultSet->Close();
        } catch ( Exception $e ) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ( $exception !== NULL ) {
            throw $exception;
        }
    }

    public function testQueryGetUser3() {
        $this->testQueryCreateUsers();

        $stmFactory = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($stmFactory, "Can not create Ddth_Adodb_AdodbSqlStatementFactory object!");

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.getUserByEmail';
            $stm = $stmFactory->getSqlStatement($name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);
            $resultSet = $stm->prepareAndExecute($conn, Array('third-user@local'));
            $this->assertNotNull($resultSet);
            $this->assertFalse($resultSet->EOF);
            $this->assertEquals(3, $resultSet->fields['id']);
            $this->assertEquals('third', $resultSet->fields['username']);
            $this->assertEquals('third-user@local', $resultSet->fields['email']);
            $resultSet->Close();
        } catch ( Exception $e ) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ( $exception !== NULL ) {
            throw $exception;
        }
    }

    public function testQueryGetUser4() {
        $this->testQueryCreateUsers();

        $stmFactory = Ddth_Adodb_AdodbSqlStatementFactory::getInstance(self::CONFIG_FILE);
        $this->assertNotNull($stmFactory, "Can not create Ddth_Adodb_AdodbSqlStatementFactory object!");

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.getUserById';
            $stm = $stmFactory->getSqlStatement($name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $this->assertTrue($stm instanceof Ddth_Adodb_AdodbSqlStatement);
            $resultSet = $stm->prepareAndExecute($conn, Array(0));
            $this->assertNotNull($resultSet);
            $this->assertTrue($resultSet->EOF);
            $resultSet->Close();
        } catch ( Exception $e ) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ( $exception !== NULL ) {
            throw $exception;
        }
    }
}
?>
