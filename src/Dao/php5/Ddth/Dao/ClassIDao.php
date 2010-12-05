<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Represents a DAO (business object manager).
 *
 * LICENSE: See the included license.txt file for detail.
 * 
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIBoManager.php 222 2010-11-21 07:25:10Z btnguyen2k@gmail.com $
 * @since       File available since v0.2
 */

/**
 * This class represents a DAO (business object manager).
 *
 * @package     Dao
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
interface Ddth_Dao_IDao {

    /**
     * Gets the DAO factory instance.
     * 
     * @return Ddth_Dao_IDaoFactory
     */
    public function getDaoFactory();

    /**
     * Initializes the DAO.
     * 
     * @param Ddth_Dao_IDaoFactory
     */
    public function init($daoFactory);
}
?>
