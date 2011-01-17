<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * ADOdb helper class.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Adodb
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.1.2
 */

/**
 * ADOdb helper class.
 *
 * @package    	Adodb
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.1.2
 */
class Ddth_Adodb_AdodbHelper {

    /**
     * Static cache used by function {@link loadSqlStatement()}.
     *
     * @var Array
     */
    private static $sqlStatementCache = Array();

    /**
     * Loads a SQL statement from a file ({@link Ddth_Commons_Properties .properties format}).
     *
     * The file contains SQL statement in the following format:
     * <code>
     * # Each line is a sql statement, in .properties format
     * <name>=<the SQL query>
     *
     * # Example:
     * sql.selectUserById = SELECT * FROM tbl_user WHERE id=?
     * sql.deleteUserByEmail = DELETE FROM tbl_user WHERE email=?
     * sql.createUser = INSERT INTO tbl_user (id, username, email) VALUES (?, ?, ?)
     * </code>
     *
     * Usage example:
     * <code>
     * //obtain an ADOConnection
     * $adoConn = ...;
     *
     * $configFile = 'dphp-adodb.sql.properties';
     * $sql = Ddth_Adodb_AdodbHelper::loadSqlStatement($configFile, 'sql.selectYserById');
     * $values = Array(1);
     * $resultSet = $adoConn->Execute($sql, $values);
     * </code>
     *
     * @param string $configFile name of the configuration file
     * @param string $name name of the SQL statement to load. If NULL is supplied,
     * the function returns all the SQL statements as a {@link Ddth_Commons_Properties} object
     * @since function available since v0.2
     */
    public static function loadSqlStatement($configFile, $name = NULL) {
        $props = isset(self::$sqlStatementCache[$configFile]) ? self::$sqlStatementCache[$configFile] : NULL;
        if ($props === NULL) {
            $fileContent = Ddth_Commons_Loader::loadFileContent($configFile);
            if ($fileContent === NULL || $fileContent === "") {
                return NULL;
            }
            $props = new Ddth_Commons_Properties();
            $props->import($fileContent);
            self::$sqlStatementCache[$configFile] = $props;
        }
        return $name !== NULL ? $props->getProperty($name) : $props;
    }

    /**
     * A shortcut to to build string with n question marks separated by commas (e.g. "?,?,?,?").
     *
     * @param int
     * @return string
     */
    public static function buildArrayParams($count = 1) {
        $count += 0;
        if ($count < 1) {
            return '';
        }
        $result = '?';
        for ($i = 1; $i < $count; $i++) {
            $result .= ',?';
        }
        return $result;
    }

    /**
     * Prepares the SQL statement.
     *
     * @param ADOConnection an active ADOdb connection
     * @param string the SQL statement
     * @param Array list of named binding parameters (case-sensitive! and in-order!!!)
     * @return string the prepared SQL statement
     * @since function available since v0.1.5.1
     */
    public static function prepareSql($conn, $sql, $params = Array()) {
        foreach ($params as $p) {
            $sql = str_replace('${' . $p . '}', $conn->Param($p), $sql);
        }
        return $sql;
    }
}
?>
