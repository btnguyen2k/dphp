<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * MySQL-specific {@link Ddth_Dao_SqlStatement}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @subpackage  Mysql
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.2.2
 */

/**
 * MySQL-specific {@link Ddth_Dao_SqlStatement}.
 *
 * @package    	Dao
 * @subpackage  Mysql
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2.2
 */
class Ddth_Dao_Mysql_MysqlSqlStatement extends Ddth_Dao_SqlStatement {
    /**
     * @see Ddth_Dao_SqlStatement::escape()
     */
    protected function escape($conn, $value) {
        return mysql_real_escape_string($value, $conn);
    }

    /**
     * @see Ddth_Dao_SqlStatement::doExecute()
     */
    protected function doExecute($preparedSql, $conn) {
        return mysql_query($preparedSql, $conn);
    }
}
?>
