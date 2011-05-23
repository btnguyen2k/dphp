<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for SqlStatement & SqlStatementFactory.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: DaoTest.php 263 2011-01-06 06:34:18Z btnguyen2k@gmail.com $
 * @since       File available since v0.1
 */

/**
 * Test cases for SqlStatement & SqlStatementFactory.
 *
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 */
class SqlStatementTest extends PHPUnit_Framework_TestCase {
    protected function setup() {
        parent::setUp();

        $sqliteFilename = ':memory:';
        global $DPHP_DAO_CONFIG;
        $DPHP_DAO_CONFIG = Array('dphp-dao.factoryClass' => 'Ddth_Dao_Sqlite_BaseSqliteDaoFactory',
                'dphp-dao.sqlite.filename' => $sqliteFilename,
                'dao.user' => 'SqliteUserDao');

        global $SQL_USER;
        $SQL_USER = 'user.sql.properties';
    }

    /**
     * Test case: create SqlStatementFactory object(s).
     */
    public function testCreateObj() {
        global $SQL_USER;
        $obj1 = Ddth_Dao_SqlStatementFactory::getInstance($SQL_USER);
        $this->assertNotNull($obj1, "Can not create SqlStatement factory object!");

        $obj2 = Ddth_Dao_SqlStatementFactory::getInstance($SQL_USER);
        $this->assertTrue($obj1 === $obj2);
    }

    /**
     * Test case: create SqlStatementFactory inst and retrieve SqlStatement obj.
     * Enter description here ...
     */
    public function testGetStm() {
        global $SQL_USER;
        $obj1 = Ddth_Dao_SqlStatementFactory::getInstance($SQL_USER);
        $this->assertNotNull($obj1, "Can not create SqlStatement factory object!");

        $stm = $obj1->getSqlStatement('sql.selectUserById');
        $this->assertNotNull($stm, "Can not obtain the statement [sql.selectUserById]!");
    }
}
?>
