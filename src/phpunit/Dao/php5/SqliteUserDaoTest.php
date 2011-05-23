<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for UserDao (Sqlite engine).
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
 * Test cases for Sqlite UserDao.
 *
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 */
class SqliteUserDaoTest extends PHPUnit_Framework_TestCase {
    protected function setup() {
        parent::setUp();

        //$sqliteFilename = ':memory:';
        $dir = '../../../tmp';
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $sqliteFilename = "$dir/" . __CLASS__ . ".sqlite";
        @unlink($sqliteFilename);

        global $DPHP_DAO_CONFIG;
        $DPHP_DAO_CONFIG = Array('dphp-dao.factoryClass' => 'Ddth_Dao_Sqlite_BaseSqliteDaoFactory',
                'dphp-dao.sqlite.filename' => $sqliteFilename,
                'dao.user' => 'SqliteUserDao');

        $factory = Ddth_Dao_BaseDaoFactory::getInstance();
        $sqliteConn = $factory->getConnection();
        $sql = 'CREATE TABLE tbl_user (id INTEGER PRIMARY KEY ASC, username VARCHAR(32), email VARCHAR(64))';
        sqlite_exec($sqliteConn->getConn(), $sql);
        $factory->closeConnection();
    }

    /**
     * Tests UserDao: create new user.
     */
    public function testCreateUser() {
        $factory = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertNotNull($factory, "Can not create DAO factory object!");

        $userDao = $factory->getDao('dao.user');
        $this->assertNotNull($userDao, "Can not get the user dao!");

        $userDao->createUser(1, 'user1', 'user1@domain.com');
        $userDao->createUser(2, 'user2', 'user2@domain.com');
        $userDao->createUser(3, 'user3', 'user3@domain.com');
    }

    public function testGetUserById() {
        $this->testCreateUser();

        $factory = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertNotNull($factory, "Can not create DAO factory object!");

        $userDao = $factory->getDao('dao.user');
        $this->assertNotNull($userDao, "Can not get the user dao!");

        $user1 = $userDao->getUserById(1);
        $this->assertNotNull($user1);
        $this->assertEquals(1, $user1['id']);
        $this->assertEquals('user1', $user1['username']);
        $this->assertEquals('user1@domain.com', $user1['email']);
    }
}
?>
