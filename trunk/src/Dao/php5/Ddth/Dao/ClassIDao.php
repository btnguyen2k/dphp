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
     * Gets a connection to persistent storage.
     *
     * @param bool $startTransaction indicates that if a transaction is automatically started
     * @return mixed the connection, or NULL if the connection can not be created
     */
    public function getConnection($startTransaction=false);
    
    /**
     * Closes an existing connection.
     *
     * @param mixed $conn the existing connection to close
     * @param bool $hasError indicates that an error has occurred during the usage of the connection
     */
    public function closeConnection($conn, $hasError=false);

    /**
     * Gets the DAO factory instance.
     *
     * @return Ddth_Dao_IDaoFactory
     */
    public function getDaoFactory();

    /**
     * Initializes the DAO.
     *
     * @param Ddth_Dao_IDaoFactory $daoFactory
     */
    public function init($daoFactory);
}
?>
