<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory to create ADOdb SQL Statements.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Adodb
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id: ClassAdodbFactory.php 148 2008-03-12 05:38:09Z nbthanh@vninformatics.com $
 * @since      	File available since v0.1.6
 */

/**
 * Factory to create ADOdb SQL Statements.
 *
 * @package    	Adodb
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @since      	Class available since v0.1.6
 */
class Ddth_Adodb_AdodbSqlStatementFactory {
    
    /**
     * @var Ddth_Commons_Properties
     */
    private $configurations;
    
    /**
     * Constructs a new Ddth_Adodb_AdodbSqlStatementFactory object.
     */
    protected function __construct() {
        //empty
    }
}
?>