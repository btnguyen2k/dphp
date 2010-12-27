<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Base abstract implementation for MySQL-based DAOs.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @subpackage  Mysql
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIBoManager.php 207 2009-01-01 20:24:27Z btnguyen2k@gmail.com $
 * @since       File available since v0.2
 */

/**
 * Base abstract implementation for MySQL-based DAOs.
 *
 * Instances of type {@link Ddth_Dao_Mysql_AbstractMysqlDao} should be created by {@link Ddth_Dao_Mysql_IMysqlDaoFactory}.
 *
 * @package    	Dao
 * @subpackage  Mysql
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
abstract class Ddth_Dao_Mysql_AbstractMysqlDao extends Ddth_Dao_AbstractDao {
    /**
     * Constructs a new Ddth_Dao_Mysql_AbstractMysqlDao object,
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @see Ddth_Dao_IDao::init()
     */
    public function init($daoFactory) {
        if ( !($daoFactory instanceof Ddth_Dao_Mysql_IMysqlDaoFactory) ) {
            $msg = 'I expect an instance of [Ddth_Dao_Mysql_IMysqlDaoFactory] but got ['.get_class($daoFactory).']!';
            throw new Ddth_Dao_DaoException($msg);
        }
        parent::init($daoFactory);
    }

    /**
     * @see Ddth_Dao_IDao::getConnection()
     */
    public function getConnection($startTransaction=false) {
        return $this->getDaoFactory()->getConnection($startTransaction);
    }

    /**
     * @see Ddth_Dao_IDao::closeConnection()
     */
    public function closeConnection($conn, $hasError=false) {
        $this->getDaoFactory()->closeConnection($conn, $hasError);
    }
}
?>
