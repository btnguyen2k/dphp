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
 * @version			$Id: AdodbTest.php 188 2008-09-14 09:26:59Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

//initialization
//defines package name and package php version
if ( !defined('PACKAGE') ) {
    define('PACKAGE', 'Dao');
}
if ( !defined('PACKAGE_PHP_VERSION') ) {
    define('PACKAGE_PHP_VERSION', 'php5');
}
$REQUIRED_PACKAGES = Array('Commons', 'Adodb');

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

class DaoTest extends PHPUnit_Framework_TestCase {
    protected function setup() {
        parent::setUp();
        $dir = '../../../tmp';
        if ( !is_dir($dir) ) {
            mkdir($dir);
        }
        copy('../../../firebirdembed/blankdb.gdb', '../../../tmp/daotest.gdb');
    }

    /**
     * Tests creation of Ddth::Dao::DaoFactory objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Dao_DaoFactory::getInstance();
        $this->assertNotNull($obj1, "Can not create Ddth::Dao::DaoFactory object!");

        $obj2 = Ddth_Dao_DaoFactory::getInstance();
        $this->assertTrue($obj1===$obj2);
    }
    
    /**
     * Tests getDao() method.
     */
    public function testGetDao() {
        $obj = Ddth_Dao_DaoFactory::getInstance();
        $this->assertNotNull($obj, "Can not create Ddth::Dao::DaoFactory object!");
        
        $userDao =$obj->getDao('UserDao');
        $this->assertNotNull($userDao);
    }
    
	/**
     * Tests 'magic' methods to get DAO.
     */
    public function testGetDaoMagic() {
        $obj = Ddth_Dao_DaoFactory::getInstance();
        $this->assertNotNull($obj, "Can not create Ddth::Dao::DaoFactory object!");
        
        $userDao =$obj->getUserDao();
        $this->assertNotNull($userDao);
    }
}
?>