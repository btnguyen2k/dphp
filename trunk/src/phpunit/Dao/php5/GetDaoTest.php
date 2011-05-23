<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for DAO creation & retrieval.
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
 * Test cases for DAO creation & retrieval.
 *
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 */
class GetDaoTest extends PHPUnit_Framework_TestCase {
    protected function setup() {
        parent::setUp();

        $sqliteFilename = ':memory:';
        global $DPHP_DAO_CONFIG;
        $DPHP_DAO_CONFIG = Array('dphp-dao.factoryClass' => 'Ddth_Dao_Sqlite_BaseSqliteDaoFactory',
                'dphp-dao.sqlite.filename' => $sqliteFilename,
                'dao.user' => 'SqliteUserDao');
    }

    /**
     * Tests creation of Ddth::Dao::DaoFactory objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertNotNull($obj1, "Can not create DAO factory object!");

        $obj2 = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertTrue($obj1 === $obj2);
    }

    /**
     * Tests getDao() method.
     */
    public function testGetDao() {
        $obj = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertNotNull($obj, "Can not create DAO factory object!");

        $userDao = $obj->getDao('dao.user');
        $this->assertNotNull($userDao, "Can not get the user dao!");
    }

    /**
     * Tests 'magic' methods to get DAO.
     */
    public function testGetDaoMagic() {
        $obj = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertNotNull($obj, "Can not create DAO factory object!");

        $userDao = $obj->getUserDao();
        $this->assertNotNull($userDao, "Can not get the user dao!");
    }
}
?>
