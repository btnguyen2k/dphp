<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * An implementation of {@link Ddth_Dao_Adodb_IAdodbDaoFactory}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @subpackage  Adodb
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIBoManager.php 150 2008-03-12 18:59:43Z nbthanh@vninformatics.com $
 * @since       File available since v0.2
 */

/**
 * An implementation of {@link Ddth_Dao_Adodb_IAdodbDaoFactory}. This can be used as a base implementation
 * of Adodb-based dao factory.
 * 
 * This factory uses the same configuration file as {@link Ddth_Dao_BaseDaoFactory}.
 *
 * @package     Dao
 * @subpackage  Adodb
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
class Ddth_Dao_Adodb_BaseAdodbDaoFactory extends Ddth_Dao_BaseDaoFactory implements Ddth_Dao_Adodb_IAdodbDaoFactory {
    /**
     * Constructs a new Ddth_Dao_Adodb_BaseAdodbDaoFactory object.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Gets a DAO by name.
     *
     * @param string $name
     * @return Ddth_Dao_Adodb_AbstractAdodbDao
     * @throws Ddth_Dao_DaoException
     */
    public function getDao($name) {
        $dao = parent::getDao($name);
        if ( $dao !== NULL && !($dao instanceof Ddth_Dao_Adodb_AbstractAdodbDao ) ) {
            $msg = 'DAO ['.$name.'] is not of type [Ddth_Dao_Adodb_AbstractAdodbDao]!';
            throw new Ddth_Dao_DaoException($msg);
        }
        return $dao;
    }
}
?>
