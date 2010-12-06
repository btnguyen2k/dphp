<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory create {@link Ddth_Dao_Adodb_AbstractAdodbDao}.
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
 * Factory to create {@link Ddth_Dao_Adodb_AbstractAdodbDao}.
 *
 * @package     Dao
 * @subpackage  Adodb
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
interface Ddth_Dao_Adodb_IAdodbDaoFactory extends Ddth_Dao_IDaoFactory {
    /**
     * Gets an Adodb connection.
     *
     * @param bool $startTransaction indicates that if a transaction is automatically started
     * @return ADOConnection the Adodb connection
     */
    public function getConnection($startTransaction=false);

    /**
     * Closes an ADOConnection.
     *
     * @param ADOConnection $conn
     * @param bool $hasError indicates that an error has occurred during the usage of the connection
     */
    public function closeConnection($conn, $hasError=false);
}
?>
