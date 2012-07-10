<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Sqlite-specific {@link Ddth_Dao_SqlStatement}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Dao
 * @subpackage Sqlite
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassSqliteSqlStatement.php 294 2011-09-12 12:30:53Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.2.2
 */

/**
 * Sqlite-specific {@link Ddth_Dao_SqlStatement}.
 *
 * @package Dao
 * @subpackage Sqlite
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since Class available since v0.2.2
 */
class Ddth_Dao_Sqlite_SqliteSqlStatement extends Ddth_Dao_SqlStatement {
    /**
     *
     * @see Ddth_Dao_SqlStatement::escape()
     */
    protected function escape($conn, $value) {
        if ($value === NULL) {
            return NULL;
        }
        if (is_array($value)) {
            $resultArr = Array();
            foreach ($value as $v) {
                $resultArr[] = $this->escape($conn, $v);
            }
            return implode(',', $resultArr);
        }
        return sqlite_escape_string($value);
    }

    /**
     *
     * @see Ddth_Dao_SqlStatement::doExecute()
     */
    protected function doExecute($preparedSql, $conn) {
        $errorMsg = '';
        $result = sqlite_unbuffered_query($conn, $preparedSql, SQLITE_BOTH, $errorMsg);
        if ($result === FALSE) {
            throw new Ddth_Dao_DaoException($errorMsg);
        }
        return $result;
    }

    /**
     * (non-PHPdoc)
     *
     * @see Ddth_Dao_SqlStatement::getNumAffectedRows()
     *
     * SQLite uses the connection result resource identifier to detect number of affected rows.
     */
    public function getNumAffectedRows($conn = NULL, $qres = NULL) {
        $result = sqlite_changes($conn);
        return $result !== -1 ? $result : FALSE;
    }
}
