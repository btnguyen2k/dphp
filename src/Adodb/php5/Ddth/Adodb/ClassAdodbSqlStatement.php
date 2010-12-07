<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * An ADOdb SQL Statement.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Adodb
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassAdodbFactory.php 148 2008-03-12 05:38:09Z nbthanh@vninformatics.com $
 * @since       File available since v0.1.6
 */

/**
 * An ADOdb SQL Statement.
 *
 * @package    	Adodb
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.1.6
 */
class Ddth_Adodb_AdodbSqlStatement {
    
    private $sql = '';
    
    private $params = Array();
    
    /**
     * Constructs a new Ddth_Adodb_AdodbSqlStatement object.
     * 
     * @param string $sql
     * @param Array $params
     */
    public function __construct($sql='', $params=Array()) {
        $this->setSql($sql);
        $this->setParams($params);
    }
    
    /**
     * Gets the sql command.
     * @return string
     */
    public function getSql() {
        return $this->sql;
    }
    
    /**
     * Sets the sql command.
     * @param string
     */
    public function setSql($sql) {
        $this->sql = $sql;
    }
    
    /**
     * Gets binding parameter list.
     * @return Array
     */
    public function getParams() {
        return $this->params;
    }
    
    /**
     * Sets binding parameter list.
     * @param Array
     */
    public function setParams($params) {
        $this->params = is_array($params) ? $params : Array(); 
    }
    
    /**
     * Prepares the statement.
     * 
     * @param ADOConnection an active ADOdb connection
     * @return string the prepared SQL statement
     */
    public function prepare($conn) {
        return Ddth_Adodb_AdodbHelper::prepareSql($conn, $this->getSql(), $this->getParams());
    }
}
?>
