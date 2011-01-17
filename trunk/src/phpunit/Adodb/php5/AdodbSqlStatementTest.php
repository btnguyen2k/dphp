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
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        @unlink('../../../tmp/adodbtest.db');
        global $DPHP_ADODB_CONFIG;
        $DPHP_ADODB_CONFIG = Array('adodb.driver' => 'sqlite',
                'adodb.host' => '../../../tmp/adodbtest.db',
                'adodb.user' => '',
                'adodb.password' => '',
                'adodb.database' => 'adodbtest');
    }

    /**
     * Tests creation of Ddth_Adodb_AdodbSqlStatementFactory objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE);
        $this->assertNotNull($obj1, "Can not load SQL statements!");
        $this->assertTrue($obj1 instanceof Ddth_Commons_Properties, "The returned object is expected to be an instance of Ddth_Commons_Properties!");

        $obj2 = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE);
        $this->assertTrue($obj1 === $obj2, "The two objects are expected to be equal!");
    }

    public function testGetStatement() {
        $name = 'sql.createTable';
        $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");

        $name = 'sql.createUser';
        $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");

        $name = 'sql.getUserById';
        $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");

        $name = 'sql.getUserByUsername';
        $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");

        $name = 'sql.getUserByEmail';
        $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
        $this->assertNotNull($stm, "Can not get statement [$name]!");

        $name = 'sql.not-exist';
        $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
        $this->assertNull($stm);
    }

    public function testQueryCreateTable() {
        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        try {
            $name = 'sql.createTable';
            $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $conn->Execute($stm);
        } catch (Exception $e) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ($exception !== NULL) {
            throw $exception;
        }
    }

    public function testQueryCreateUsers() {
        $this->testQueryCreateTable();

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection(TRUE);
        try {
            $name = 'sql.createUser';
            $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $conn->Execute($stm, Array(1, 'first', 'first-user@local'));
            $conn->Execute($stm, Array(2, 'second', 'second-user@local'));
            $conn->Execute($stm, Array(3, 'third', 'third-user@local'));
        } catch (Exception $e) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ($exception !== NULL) {
            throw $exception;
        }
    }

    public function testQueryGetUser1() {
        $this->testQueryCreateUsers();

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.getUserById';
            $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $resultSet = $conn->Execute($stm, Array(1));
            $this->assertNotNull($resultSet);
            $this->assertFalse($resultSet->EOF);
            $this->assertEquals(1, $resultSet->fields['id']);
            $this->assertEquals('first', $resultSet->fields['username']);
            $this->assertEquals('first-user@local', $resultSet->fields['email']);
            $resultSet->Close();
        } catch (Exception $e) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ($exception !== NULL) {
            throw $exception;
        }
    }

    public function testQueryGetUser2() {
        $this->testQueryCreateUsers();

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.getUserByUsername';
            $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $resultSet = $conn->Execute($stm, Array('second'));
            $this->assertNotNull($resultSet);
            $this->assertFalse($resultSet->EOF);
            $this->assertEquals(2, $resultSet->fields['id']);
            $this->assertEquals('second', $resultSet->fields['username']);
            $this->assertEquals('second-user@local', $resultSet->fields['email']);
            $resultSet->Close();
        } catch (Exception $e) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ($exception !== NULL) {
            throw $exception;
        }
    }

    public function testQueryGetUser3() {
        $this->testQueryCreateUsers();

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.getUserByEmail';
            $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $resultSet = $conn->Execute($stm, Array('third-user@local'));
            $this->assertNotNull($resultSet);
            $this->assertFalse($resultSet->EOF);
            $this->assertEquals(3, $resultSet->fields['id']);
            $this->assertEquals('third', $resultSet->fields['username']);
            $this->assertEquals('third-user@local', $resultSet->fields['email']);
            $resultSet->Close();
        } catch (Exception $e) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ($exception !== NULL) {
            throw $exception;
        }
    }

    public function testQueryGetUser4() {
        $this->testQueryCreateUsers();

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.getUserById';
            $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $resultSet = $conn->Execute($stm, Array(0));
            $this->assertNotNull($resultSet);
            $this->assertTrue($resultSet->EOF);
            $resultSet->Close();
        } catch (Exception $e) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ($exception !== NULL) {
            throw $exception;
        }
    }

    public function testQueryMultiParams1() {
        $this->testQueryCreateUsers();

        $connFactory = Ddth_Adodb_AdodbFactory::getInstance();

        $exception = NULL;
        $conn = $connFactory->getConnection();
        $conn->SetFetchMode(ADODB_FETCH_ASSOC);
        try {
            $name = 'sql.multiParams1';
            $stm = Ddth_Adodb_AdodbHelper::loadSqlStatement(self::CONFIG_FILE, $name);
            $this->assertNotNull($stm, "Can not get statement [$name]!");
            $resultSet = $conn->Execute($stm, Array(1, 'first-user@local', 2));
            $this->assertNotNull($resultSet);
            $this->assertFalse($resultSet->EOF);
            $count = 0;
            while (!$resultSet->EOF) {
                $count++;
                $resultSet->MoveNext();
            }
            $this->assertEquals(2, $count);
            $resultSet->Close();
        } catch (Exception $e) {
            $exception = $e;
        }
        $connFactory->closeConnection($conn);
        if ($exception !== NULL) {
            throw $exception;
        }
    }
}
?>
