<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory interface to create and dispose ADOdb connections.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Adodb
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIAdodbFactory.php 230 2010-12-07 19:25:57Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

/**
 * Factory interface to create and dispose ADOdb connections.
 *
 * This factory interface provides APIs create and dispose
 * {@link http://adodb.sourceforge.net/ ADOdb} connections.
 *
 * @package    	Adodb
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.1
 */
interface Ddth_Adodb_IAdodbFactory {
    /**
     * @var string
     */
    const DEFAULT_CONFIG_FILE = "dphp-adodb.properties";

    /**
     * Gets an ADOdb connection.
     *
     * @param bool indicates that if a transaction is automatically started
     * @return ADOConnection an instance of ADOConnection, NULL is returned if
     * the connection can not be created
     */
    public function getConnection($startTransaction=false);

    /**
     * Closes an ADOConnection
     *
     * @param ADOConnection
     * @param bool
     */
    public function closeConnection($conn, $hasError=false);
}
?>
