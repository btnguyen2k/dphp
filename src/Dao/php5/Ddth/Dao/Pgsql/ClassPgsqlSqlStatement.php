<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PgSQL-specific {@link Ddth_Dao_SqlStatement}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Dao
 * @subpackage Pgsql
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassPgsqlSqlStatement.php 294 2011-09-12 12:30:53Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.2.3
 */

/**
 * PgSQL-specific {@link Ddth_Dao_SqlStatement}.
 *
 * @package Dao
 * @subpackage Pgsql
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since Class available since v0.2.3
 */
class Ddth_Dao_Pgsql_PgsqlSqlStatement extends Ddth_Dao_SqlStatement {
    /**
     *
     * @see Ddth_Dao_SqlStatement::escape()
     */
    protected function escape($conn, $value, $bytea = FALSE) {
        if ($value === NULL) {
            return NULL;
        }
        if (is_array($value)) {
            $resultArr = Array();
            foreach ($value as $v) {
                $resultArr[] = $this->escape($conn, $v, $bytea);
            }
            return implode(',', $resultArr);
        }
        if ($bytea) {
            return pg_escape_bytea($conn, $value);
        }
        return pg_escape_string($conn, $value);
    }

    /**
     *
     * @see Ddth_Dao_SqlStatement::doExecute()
     */
    protected function doExecute($preparedSql, $conn) {
        $result = pg_query($conn, $preparedSql);
        if ($result === FALSE) {
            throw new Ddth_Dao_DaoException(pg_last_error($conn));
        }
        return $result;
    }

    /**
     * (non-PHPdoc)
     *
     * @see Ddth_Dao_SqlStatement::getNumAffectedRows()
     *
     * PgSQL uses the query result resource identifier to detect number of affected rows.
     */
    public function getNumAffectedRows($conn = NULL, $qres = NULL) {
        $result = pg_affected_rows($qres);
        return $result !== -1 ? $result : FALSE;
    }
}
