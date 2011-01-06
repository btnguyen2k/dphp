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
class DaoTest extends PHPUnit_Framework_TestCase {
    protected function setup() {
        parent::setUp();
        $dir = '../../../tmp';
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        @unlink('../../../tmp/adodbtest.db');
        //copy('../../../firebirdembed/blankdb.gdb', '../../../tmp/adodbtest.gdb');


        global $DPHP_ADODB_CONFIG;
        $DPHP_ADODB_CONFIG = Array('adodb.driver' => 'sqlite', 'adodb.host' => '../../../tmp/adodbtest.db', 'adodb.user' => '', 'adodb.password' => '', 'adodb.database' => 'adodbtest')#'adodb.url'         => 'mysql://test:test@localhost/test'
        #,
        #'adodb.setupSqls    => "SET NAMES 'utf8'"
        ;

        global $DPHP_DAO_CONFIG;
        $DPHP_DAO_CONFIG = Array('ddth-dao.factoryClass' => 'Ddth_Dao_BaseDaoFactory', 'dao.user' => 'UserDao', 'dao.simpleBlog' => 'UserDao');
    }

    /**
     * Tests creation of Ddth::Dao::DaoFactory objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertNotNull($obj1, "Can not create [Ddth_Dao_BaseDaoFactory] object!");

        $obj2 = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertTrue($obj1 === $obj2);
    }

    /**
     * Tests getDao() method.
     */
    public function testGetDao() {
        $obj = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertNotNull($obj, "Can not create [Ddth_Dao_BaseDaoFactory] object!");

        $userDao = $obj->getDao('dao.user');
        $this->assertNotNull($userDao, "Can not get the user dao!");
    }

    /**
     * Tests 'magic' methods to get DAO.
     */
    public function testGetDaoMagic() {
        $obj = Ddth_Dao_BaseDaoFactory::getInstance();
        $this->assertNotNull($obj, "Can not create [Ddth_Dao_BaseDaoFactory] object!");

        $userDao = $obj->getUserDao();
        $this->assertNotNull($userDao, "Can not get the user dao!");
    }
}
?>
