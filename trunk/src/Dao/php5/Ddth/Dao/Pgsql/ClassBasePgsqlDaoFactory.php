<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory to create {@link Ddth_Dao_Pgsql_IPgsqlDao} instances.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Dao
 * @subpackage Pgsql
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassBasePgsqlDaoFactory.php 280 2011-06-07 07:31:28Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.2
 */

/**
 * Factory to create {@link Ddth_Dao_Pgsql_IPgsqlDao} instances.
 * This can be used as a base
 * implementation of PostgreSQL-based DAO factory.
 *
 * This factory uses the same configuration array as {@link
 * Ddth_Dao_BaseDaoFactory}, with additional
 * configurations:
 * <code>
 * Array(
 * #other configurations used by Ddth_Dao_Pgsql_BasePgsqlDaoFactory
 *
 * # PostgreSQL connection string
 * # See http://php.net/manual/en/function.pg-connect.php for more information
 * 'dphp-dao.pgsql.persistent'
 * => FALSE, #indicate if pgsql_pconnect (TRUE) or pgsql_connect (FALSE) is
 * used. Default value is FALSE
 * 'dphp-dao.pgsql.connectionString'
 * => "host=localhost port=5432 dbname=testdb user=foouser password=barpwd
 * options='--client_encoding=UTF8'"
 * )
 * </code>
 *
 * @package Dao
 * @subpackage Pgsql
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since Class available since v0.2
 */
class Ddth_Dao_Pgsql_BasePgsqlDaoFactory extends Ddth_Dao_AbstractConnDaoFactory {

    const CONF_PGSQL_CONNECTION_STRING = 'dphp-dao.pgsql.connectionString';
    const CONF_PGSQL_PERSISTENT = 'dphp-dao.pgsql.persistent';

    const CONF_PGSQL_HOST = 'dphp-dao.pgsql.host';
    const CONF_PGSQL_PORT = 'dphp-dao.pgsql.port';
    const CONF_PGSQL_USERNAME = 'dphp-dao.pgsql.username';
    const CONF_PGSQL_PASSWORD = 'dphp-dao.pgsql.password';
    const CONF_PGSQL_DATABASE = 'dphp-dao.pgsql.database';

    private $pgsqlConnectionString = '';
    private $pgsqlPersistent = FALSE;

    private $pgsqlHost = 'localhost';
    private $pgsqlPort = 5432;
    private $pgsqlUsername = NULL;
    private $pgsqlPassword = NULL;
    private $pgsqlDatabase = NULL;

    /**
     *
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    /**
     * Constructs a new Ddth_Dao_Pgsql_BasePgsqlDaoFactory object.
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

        $this->pgsqlHost = isset($config[self::CONF_PGSQL_HOST]) ? $config[self::CONF_PGSQL_HOST] : NULL;
        $this->pgsqlPort = isset($config[self::CONF_PGSQL_PORT]) ? $config[self::CONF_PGSQL_PORT] : NULL;
        $this->pgsqlUsername = isset($config[self::CONF_PGSQL_USERNAME]) ? $config[self::CONF_PGSQL_USERNAME] : NULL;
        $this->pgsqlPassword = isset($config[self::CONF_PGSQL_PASSWORD]) ? $config[self::CONF_PGSQL_PASSWORD] : NULL;
        $this->pgsqlDatabase = isset($config[self::CONF_PGSQL_DATABASE]) ? $config[self::CONF_PGSQL_DATABASE] : NULL;

        $this->pgsqlConnectionString = isset($config[self::CONF_PGSQL_CONNECTION_STRING]) ? $config[self::CONF_PGSQL_CONNECTION_STRING] : NULL;
        if ($this->pgsqlConnectionString === NULL) {
            // build the connection string from fragment options
            $this->pgsqlConnectionString = $this->buildConnectionString();
        }

        $this->pgsqlPersistent = isset($config[self::CONF_PGSQL_PERSISTENT]) ? $config[self::CONF_PGSQL_PERSISTENT] : FALSE;
    }

    /**
     * Builds the PgSQL connection string.
     *
     * @return string
     */
    protected function buildConnectionString() {
        $connStr = "host={$this->pgsqlHost}";
        if ($this->pgsqlPort !== NULL) {
            $connStr .= " port={$this->pgsqlPort}";
        }
        if ($this->pgsqlDatabase !== NULL) {
            $connStr .= " dbname={$this->pgsqlDatabase}";
        }
        if ($this->pgsqlUsername !== NULL) {
            $connStr .= " user={$this->pgsqlUsername}";
        }
        if ($this->pgsqlPassword !== NULL) {
            $connStr .= " password={$this->pgsqlPassword}";
        }
        $connStr .= " options='--client_encoding=UTF8'";
        return $connStr;
    }

    /**
     * Gets the PostgreSQL connection string.
     *
     * @return string
     */
    protected function getPgsqlConnectionString() {
        return $this->pgsqlConnectionString;
    }

    /**
     * Sets the PostgreSQL connection string.
     *
     * @param string $connectionString
     */
    protected function setPgsqlConnectionString($connectionString) {
        $this->pgsqlConnectionString = $connectionString;
    }

    /**
     * Gets the PostgreSQL persistent setting.
     *
     * @return bool
     */
    protected function getPgsqlPersistent() {
        return $this->pgsqlPersistent;
    }

    /**
     * Sets the PostgreSQL persistent setting.
     *
     * @param bool $persistent
     */
    protected function setPgsqlPersistent($persistent) {
        $this->pgsqlPersistent = $persistent;
    }

    /**
     * Gets a DAO by name.
     *
     * @param string $name
     * @return Ddth_Dao_Pgsql_IPgsqlDao
     * @throws Ddth_Dao_DaoException
     */
    public function getDao($name) {
        $dao = parent::getDao($name);
        if ($dao !== NULL && !($dao instanceof Ddth_Dao_Pgsql_IPgsqlDao)) {
            $msg = 'DAO [' . $name . '] is not of type [Ddth_Dao_Pgsql_IPgsqlDao]!';
            throw new Ddth_Dao_DaoException($msg);
        }
        return $dao;
    }

    /**
     * This function returns an object of type {@link
     * Ddth_Dao_Pgsql_PgsqlConnection}.
     *
     * @see Ddth_Dao_AbstractConnDaoFactory::createConnection()
     */
    protected function createConnection($startTransaction = FALSE) {
        $pgsqlConn = NULL;
        if ($this->pgsqlPersistent) {
            if ($this->LOGGER->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Opening a persistent pgsql connection...";
                $this->LOGGER->debug($msg);
            }
            $pgsqlConn = @pg_pconnect($this->pgsqlConnectionString);
        } else {
            if ($this->LOGGER->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Opening a pgsql connection...";
                $this->LOGGER->debug($msg);
            }
            $pgsqlConn = @pg_connect($this->pgsqlConnectionString, PGSQL_CONNECT_FORCE_NEW);
        }
        if ($pgsqlConn === FALSE || $pgsqlConn === NULL) {
            throw new Ddth_Dao_DaoException('Can not make connection to PostgreSQL server!');
        }
        $result = new Ddth_Dao_Pgsql_PgsqlConnection($pgsqlConn);
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
     * Ddth_Dao_Pgsql_PgsqlConnection}.
     *
     * @see Ddth_Dao_AbstractConnDaoFactory::forceCloseConnection()
     */
    protected function forceCloseConnection($conn, $hasError = FALSE) {
        if ($conn instanceof Ddth_Dao_Pgsql_PgsqlConnection) {
            $conn->closeConn($hasError);
        } else {
            $msg = 'I expect the first parameter is of type [Ddth_Dao_Pgsql_PgsqlConnection]!';
            throw new Ddth_Dao_DaoException($msg);
        }
    }
}
