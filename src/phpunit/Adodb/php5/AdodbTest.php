<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Adodb.
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

class AdodbTest extends PHPUnit_Framework_TestCase {
    protected function setup() {
        parent::setUp();
        $dir = '../../../tmp';
        if ( !is_dir($dir) ) {
            mkdir($dir);
        }
        copy('../../../firebirdembed/blankdb.gdb', '../../../tmp/adodbtest.gdb');
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
        $this->assertTrue($rs->fields[0] === 3);

        $sql = "SELECT count(*) FROM tblPerson WHERE LastName='Hansen'";
        $rs = $conn->Execute($sql);
        $this->assertTrue($rs !== false);
        $this->assertTrue($rs->fields[0] === 1);

        $sql = "SELECT count(*) FROM tblPerson WHERE FirstName='Not Found'";
        $rs = $conn->Execute($sql);
        $this->assertTrue($rs !== false);
        $this->assertTrue($rs->fields[0] === 0);

        $obj->closeConnection($conn);
    }
}
?>