<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * An ADOdb SQL Statement.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Adodb
 * @author		Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version			$Id: ClassAdodbFactory.php 148 2008-03-12 05:38:09Z nbthanh@vninformatics.com $
 * @since      	File available since v0.1.6
 */

/**
 * An ADOdb SQL Statement.
 *
 * @package    	Adodb
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @since      	Class available since v0.1.6
 */
class Ddth_Adodb_AdodbSqlStatement {
    
    private $sql = '';
    
    private $params = Array();
    
    /**
     * Constructs a new Ddth_Adodb_AdodbSqlStatement object.
     */
    public function __construct() {
        //empty
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