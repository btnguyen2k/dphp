<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory to create {@link Ddth_Dao_Mysql_AbstractMysqlDao}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @subpackage  Mysql
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIBoManager.php 150 2008-03-12 18:59:43Z nbthanh@vninformatics.com $
 * @since       File available since v0.2
 */

/**
 * Factory to create {@link Ddth_Dao_Mysql_AbstractMysqlDao}.
 *
 * @package     Dao
 * @subpackage  Mysql
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
interface Ddth_Dao_Mysql_IMysqlDaoFactory extends Ddth_Dao_IDaoFactory {
    /**
     * Gets an MySQL connection.
     *
     * @param bool $startTransaction indicates that if a transaction is automatically started
     * @return mixed the MySQL connection
     */
    public function getConnection($startTransaction=false);

    /**
     * Closes an MySQL.
     *
     * @param mixed $conn
     * @param bool $hasError indicates that an error has occurred during the usage of the connection
     */
    public function closeConnection($conn, $hasError=false);
}
?>
