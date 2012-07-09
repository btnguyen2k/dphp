<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory to create {@link Ddth_Dao_Mysql_IMysqlDao} instances.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Dao
 * @subpackage Mysql
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassBaseMysqlDaoFactory.php 281 2011-06-14 17:17:23Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.2
 */

/**
 * Factory to create {@link Ddth_Dao_Mysql_IMysqlDao} instances.
 * This can be used as a base
 * implementation of MySql-based DAO factory.
 *
 * This factory uses the same configuration array as {@link
 * Ddth_Dao_BaseDaoFactory}, with additional
 * configurations:
 * <code>
 * Array(
 * #other configurations used by Ddth_Dao_Mysql_BaseMysqlDaoFactory
 *
 * # MySQL hostname, username, and password
 * # See http://php.net/manual/en/function.mysql-connect.php for more
 * information
 * 'dphp-dao.mysql.host' => 'localhost',
 * 'dphp-dao.mysql.username' => 'root', #supply FALSE or NULL to disable
 * username field
 * 'dphp-dao.mysql.password' => '', #supply FALSE or NULL to disable password
 * field
 * 'dphp-dao.mysql.persistent' => FALSE, #indicate if mysql_pconnect (TRUE) or
 * mysql_connect (FALSE) is used. Default value is FALSE
 * 'dphp-dao.mysql.database' => 'mydb', #name of the database to use
 *
 * #these queries will be automatically executed right after a new connection is
 * established
 * 'dphp-dao.mysql.setupSqls' => Array("SET NAMES utf8")
 * )
 * </code>
 *
 * @package Dao
 * @subpackage Mysql
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since Class available since v0.2
 */
class Ddth_Dao_Mysql_BaseMysqlDaoFactory extends Ddth_Dao_AbstractConnDaoFactory {

    const CONF_MYSQL_HOST = 'dphp-dao.mysql.host';
    const CONF_MYSQL_PORT = 'dphp-dao.mysql.port';
    const CONF_MYSQL_USERNAME = 'dphp-dao.mysql.username';
    const CONF_MYSQL_PASSWORD = 'dphp-dao.mysql.password';
    const CONF_MYSQL_PERSISTENT = 'dphp-dao.mysql.persistent';
    const CONF_MYSQL_DATABASE = 'dphp-dao.mysql.database';
    const CONF_SETUP_SQLS = 'dphp-dao.mysql.setupSqls';

    private $mysqlHost = 'localhost';
    private $mysqlPort = NULL;
    private $mysqlUsername = NULL;
    private $mysqlPassword = NULL;
    private $mysqlPersistent = FALSE;
    private $mysqlDatabase = NULL;
    private $setupSqls = NULL;

    /**
     *
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    /**
     * Constructs a new Ddth_Dao_Mysql_BaseMysqlDaoFactory object.
     */
    public function __construct() {
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
        parent::__construct();
    }

    /**
     *
     * @see Ddth_Dao_IDaoFactory::init();
     */
    public function init($config) {
        parent::init($config);
        $this->mysqlHost = isset($config[self::CONF_MYSQL_HOST]) ? $config[self::CONF_MYSQL_HOST] : NULL;
        $this->mysqlPort = isset($config[self::CONF_MYSQL_PORT]) ? $config[self::CONF_MYSQL_PORT] : NULL;
        $this->mysqlUsername = isset($config[self::CONF_MYSQL_USERNAME]) ? $config[self::CONF_MYSQL_USERNAME] : NULL;
        $this->mysqlPassword = isset($config[self::CONF_MYSQL_PASSWORD]) ? $config[self::CONF_MYSQL_PASSWORD] : NULL;
        $this->mysqlPersistent = isset($config[self::CONF_MYSQL_PERSISTENT]) ? $config[self::CONF_MYSQL_PERSISTENT] : FALSE;
        $this->mysqlDatabase = isset($config[self::CONF_MYSQL_DATABASE]) ? $config[self::CONF_MYSQL_DATABASE] : NULL;
        $this->setupSqls = isset($config[self::CONF_SETUP_SQLS]) ? $config[self::CONF_SETUP_SQLS] : NULL;
    }

    /**
     * Gets the MySQL host.
     *
     * @return string
     */
    protected function getMysqlHost() {
        return $this->mysqlHost;
    }

    /**
     * Sets the MySQL host.
     *
     * @param string $host
     */
    protected function setMysqlHost($host) {
        $this->mysqlHost = $host;
    }

    /**
     * Gets the MySQL port.
     *
     * @return string
     */
    protected function getMysqlPort() {
        return $this->mysqlPort;
    }

    /**
     * Sets the MySQL port.
     *
     * @param int $port
     */
    protected function setMysqlPort($port) {
        $this->mysqlPort = $port;
    }

    /**
     * Gets the MySQL username.
     *
     * @return string
     */
    protected function getMysqlUsername() {
        return $this->mysqlUsername;
    }

    /**
     * Sets the MySQL username.
     *
     * @param string $username
     */
    protected function setMysqlUsername($username) {
        $this->mysqlUsername = $username;
    }

    /**
     * Gets the MySQL password.
     *
     * @return string
     */
    protected function getMysqlPassword() {
        return $this->mysqlPassword;
    }

    /**
     * Sets the MySQL password.
     *
     * @param string $password
     */
    protected function setMysqlPassword($password) {
        $this->mysqlPassword = $password;
    }

    /**
     * Gets the MySQL persistent setting.
     *
     * @return bool
     */
    protected function getMysqlPersistent() {
        return $this->mysqlPersistent;
    }

    /**
     * Sets the MySQL persistent setting.
     *
     * @param bool $persistent
     */
    protected function setMysqlPersistent($persistent) {
        $this->mysqlPersistent = $persistent;
    }

    /**
     * Gets the MySQL database name.
     *
     * @return string
     */
    protected function getMysqlDatabase() {
        return $this->mysqlDatabase;
    }

    /**
     * Sets the MySQL database name.
     *
     * @param string $database
     */
    protected function setMysqlDatabase($database) {
        $this->mysqlDatabase = $database;
    }

    /**
     * Gets a DAO by name.
     *
     * @param string $name
     * @return Ddth_Dao_Mysql_IMysqlDao
     * @throws Ddth_Dao_DaoException
     */
    public function getDao($name) {
        $dao = parent::getDao($name);
        if ($dao !== NULL && !($dao instanceof Ddth_Dao_Mysql_IMysqlDao)) {
            $msg = 'DAO [' . $name . '] is not of type [Ddth_Dao_Mysql_IMysqlDao]!';
            throw new Ddth_Dao_DaoException($msg);
        }
        return $dao;
    }

    /**
     * This function returns an object of type {@link
     * Ddth_Dao_Mysql_MysqlConnection}.
     *
     * @see Ddth_Dao_AbstractConnDaoFactory::createConnection()
     */
    protected function createConnection($startTransaction = FALSE) {
        $mysqlHost = $this->mysqlHost;
        if ($this->mysqlPort !== NULL) {
            $mysqlHost .= ':' . $this->mysqlPort;
        }
        $mysqlConn = NULL;
        if ($this->mysqlPersistent) {
            if ($this->LOGGER->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Opening a persistent mysql connection to [{$mysqlHost}]...";
                $this->LOGGER->debug($msg);
            }
            if ($this->mysqlUsername !== false) {
                if ($this->mysqlPassword !== false) {
                    $mysqlConn = @mysql_pconnect($mysqlHost, $this->mysqlUsername, $this->mysqlPassword);
                } else {
                    $mysqlConn = @mysql_pconnect($mysqlHost, $this->mysqlUsername);
                }
            } else {
                $mysqlConn = @mysql_pconnect($mysqlHost);
            }
        } else {
            if ($this->LOGGER->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Opening a mysql connection to [{$mysqlHost}]...";
                $this->LOGGER->debug($msg);
            }
            if ($this->mysqlUsername !== false) {
                if ($this->mysqlPassword !== false) {
                    $mysqlConn = @mysql_connect($mysqlHost, $this->mysqlUsername, $this->mysqlPassword, TRUE);
                } else {
                    $mysqlConn = @mysql_connect($mysqlHost, $this->mysqlUsername, '', TRUE);
                }
            } else {
                $mysqlConn = @mysql_connect($mysqlHost, '', '', TRUE);
            }
        }
        if ($mysqlConn === FALSE || $mysqlConn === NULL) {
            throw new Ddth_Dao_DaoException('Can not make connection to MySQL server!');
        }
        if (isset($this->mysqlDatabase) && $this->mysqlDatabase !== FALSE) {
            if (!mysql_select_db($this->mysqlDatabase, $mysqlConn)) {
                throw new Ddth_Dao_DaoException(mysql_error($mysqlConn));
            }
        }
        if ($this->setupSqls !== NULL && is_array($this->setupSqls)) {
            foreach ($this->setupSqls as $sql) {
                if ($this->LOGGER->isDebugEnabled()) {
                    $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Execute startup sql: $sql";
                    $this->LOGGER->debug($msg);
                }
                mysql_query($sql, $mysqlConn);
            }
        }
        $result = new Ddth_Dao_Mysql_MysqlConnection($mysqlConn);
        if ($startTransaction) {
            if ($this->LOGGER->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Starting db transaction...";
                $this->LOGGER->debug($msg);
            }
            $result->startTransaction();
        }
        return $result;
    }

    /**
     * This function expects the first argument is of type {@link
     * Ddth_Dao_Mysql_MysqlConnection}.
     *
     * @see Ddth_Dao_AbstractConnDaoFactory::forceCloseConnection()
     */
    protected function forceCloseConnection($conn, $hasError = FALSE) {
        if ($conn instanceof Ddth_Dao_Mysql_MysqlConnection) {
            $conn->closeConn($hasError);
        } else {
            $msg = 'I expect the first parameter is of type [Ddth_Dao_Mysql_MysqlConnection]!';
            throw new Ddth_Dao_DaoException($msg);
        }
    }
}
