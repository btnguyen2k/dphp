<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PgSQL-based {@link Ddth_Dao_SqlStatementFactory}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Dao
 * @subpackage Pgsql
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassSqlStatementFactory.php 301 2012-01-17 08:50:25Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.2.7
 */

/**
 * PgSQL-based {@link Ddth_Dao_SqlStatementFactory}.
 *
 * This factory create {@link Ddth_Dao_Pgsql_PgsqlSqlStatement} if no statement
 * class is specified.
 *
 * @package Dao
 * @subpackage Pgsql
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassSqlStatementFactory.php 301 2012-01-17 08:50:25Z
 *          btnguyen2k@gmail.com $
 * @since Class available since v0.2.7
 * @see Ddth_Dao_SqlStatementFactory
 */
class Ddth_Dao_Pgsql_PgsqlSqlStatementFactory extends Ddth_Dao_SqlStatementFactory {
    /**
     * Constructs a new Ddth_Dao_Pgsql_PgsqlSqlStatementFactory object.
     *
     * @param Ddth_Commons_Properties $props
     */
    protected function __construct($props) {
        parent::__construct($props);
    }

    /**
     * (non-PHPdoc)
     *
     * @see Ddth_Dao_SqlStatementFactory::setStatementClass()
     */
    protected function setStatementClass($stmClass = NULL) {
        if ($stmClass === NULL) {
            $stmClass = 'Ddth_Dao_Pgsql_PgsqlSqlStatement';
        }
        parent::setStatementClass($stmClass);
    }
}
