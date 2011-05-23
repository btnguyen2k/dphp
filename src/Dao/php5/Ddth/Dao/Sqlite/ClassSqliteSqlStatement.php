<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Sqlite-specific {@link Ddth_Dao_SqlStatement}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @subpackage  Sqlite
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.2.2
 */

/**
 * Sqlite-specific {@link Ddth_Dao_SqlStatement}.
 *
 * @package    	Dao
 * @subpackage  Sqlite
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2.2
 */
class Ddth_Dao_Sqlite_SqliteSqlStatement extends Ddth_Dao_SqlStatement {
    /**
     * @see Ddth_Dao_SqlStatement::escape()
     */
    protected function escape($conn, $value) {
        return sqlite_escape_string($value);
    }

    /**
     * @see Ddth_Dao_SqlStatement::doExecute()
     */
    protected function doExecute($preparedSql, $conn) {
        return sqlite_query($conn, $preparedSql);
    }
}
?>
