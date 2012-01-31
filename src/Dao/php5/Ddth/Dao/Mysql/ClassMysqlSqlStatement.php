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
        $result = mysql_real_escape_string($value, $conn);
        if ($result === FALSE) {
            throw new Ddth_Dao_DaoException(mysql_error($conn));
        }
        return $result;
    }

    /**
     * @see Ddth_Dao_SqlStatement::doExecute()
     */
    protected function doExecute($preparedSql, $conn) {
        $result = mysql_query($preparedSql, $conn);
        if ($result === FALSE) {
            throw new Ddth_Dao_DaoException(mysql_error($conn));
        }
        return $result;
    }

    /**
     * (non-PHPdoc)
     * @see Ddth_Dao_SqlStatement::getNumAffectedRows()
     */
    public function getNumAffectedRows($conn) {
        $result = mysql_affected_rows($conn);
        return $result !== -1 ? $result : FALSE;
    }
}