<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory to create {@link Ddth_Dao_SqlStatement} objects.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Dao
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassSqlStatementFactory.php 301 2012-01-17 08:50:25Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.1.6
 */

/**
 * Factory to create {@link Ddth_Dao_SqlStatement} objects.
 *
 * This factory loads sql statements from a file ({@link Ddth_Commons_Properties
 * .properties format}).
 * Detailed specification of the configuration file is as the following:
 * <code>
 * statement.class = name of the concrete SqlStatement class (must extend
 * Ddth_Dao_SqlStatement)
 *
 * # Each line is a sql statement, in .properties format
 * <name>=<the SQL query>
 *
 * # Examples:
 * sql.selectUserById = SELECT * FROM tbl_user WHERE id=${id}
 * sql.deleteUserByEmail = DELETE FROM tbl_user WHERE email=${email}
 * sql.createUser = INSERT INTO tbl_user (id, username, email) VALUES (${id},
 * ${username}, ${email})
 *
 * # Note: do NOT use quotes (" or ') around the place-holders.
 * </code>
 *
 * Usage:
 * <code>
 * $configFile = 'user.sql.properties';
 * $factory = Ddth_Dao_SqlStatementFactory::getInstance($configFile);
 * $sqlStm = $factory->getSqlStatement('sql.selectUserById');
 * </code>
 * See {@link Ddth_Dao_SqlStatement here} for more details on how to use {@link
 * Ddth_Dao_SqlStatement}.
 *
 * @package Dao
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since Class available since v0.1.6
 */
class Ddth_Dao_SqlStatementFactory {

    const PROP_STATEMENT_CLASS = 'statement.class';

    /**
     *
     * @var Ddth_EhProperties_EhProperties
     */
    private $configs;

    private $cache = Array();

    private $stmClass = NULL;

    /**
     *
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    private static $staticCache = Array();

    /**
     * Constructs a Ddth_Dao_SqlStatementFactory object from a configuration
     * file.
     *
     * See {@link Ddth_Dao_SqlStatementFactory} for format of the configuration
     * file.
     *
     * @parmam Ddth_Dao_IDao $dao
     *
     * @param string $configFile
     *            path to the configuration file
     * @return Ddth_Dao_SqlStatementFactory
     */
    public static function getInstance($dao, $configFile, $configBaseFile = NULL) {
        $cacheKey = "$configFile.$configBaseFile";
        $obj = isset(self::$staticCache[$cacheKey]) ? self::$staticCache[$cacheKey] : NULL;
        if ($obj === NULL) {
            $props = new Ddth_EhProperties_EhProperties();
            if ($configBaseFile !== NULL && $configBaseFile !== '') {
                $fileContentBase = Ddth_Commons_Loader::loadFileContent($configBaseFile);
                if ($fileContentBase === NULL || trim($fileContentBase) === "") {
                    $msg = "[$configBaseFile] is not found or empty!";
                    throw new Ddth_Dao_DaoException($msg);
                } else {
                    $props->import($fileContentBase);
                }
            }

            if ($configFile !== NULL && $configFile !== '') {
                $fileContent = Ddth_Commons_Loader::loadFileContent($configFile);
                if ($fileContent === NULL || trim($fileContent) === "") {
                    $msg = "[$configFile] is not found or empty!";
                    throw new Ddth_Dao_DaoException($msg);
                } else {
                    $props->import($fileContent);
                }
            }

            if ($dao instanceof Ddth_Dao_Mysql_IMysqlDao) {
                $obj = new Ddth_Dao_Mysql_MysqlSqlStatementFactory($props);
            } else if ($dao instanceof Ddth_Dao_Pgsql_IPgsqlDao) {
                $obj = new Ddth_Dao_Pgsql_PgsqlSqlStatementFactory($props);
            } else if ($dao instanceof Ddth_Dao_Sqlite_ISqliteDao) {
                $obj = new Ddth_Dao_Sqlite_SqliteSqlStatementFactory($props);
            } else {
                $obj = new Ddth_Dao_SqlStatementFactory($props);
            }
            self::$staticCache[$cacheKey] = $obj;
        }
        return $obj;
    }

    /**
     * Constructs a new Ddth_Dao_SqlStatementFactory object.
     *
     * @param Ddth_Commons_Properties $props
     */
    protected function __construct($props) {
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
        $this->setConfigs($props);
    }

    /**
     * Gets name of the statement class.
     *
     * @return string
     * @since fucntion available since v0.2.7
     */
    protected function getStatementClass() {
        return $this->stmClass;
    }

    /**
     * Sets name of the statement class
     *
     * @param string $stmClass
     * @since fucntion available since v0.2.7
     */
    protected function setStatementClass($stmClass = NULL) {
        $this->stmClass = $stmClass;
        if ($this->stmClass === NULL) {
            $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Invalid statementclass: NULL!";
            $this->LOGGER->warn($msg);
        }
    }

    /**
     * Sets configurations.
     *
     * @param Ddth_Commons_Properties $props
     */
    public function setConfigs($props) {
        $this->configs = $props;
        $this->setStatementClass($props->getProperty(self::PROP_STATEMENT_CLASS));
        $this->cache = Array(); // clear cache
    }

    /**
     * Gets the configuration object.
     *
     * @return Ddth_Commons_Properties
     */
    protected function getConfigs() {
        return $this->configs;
    }

    /**
     * Gets a SqlStatement.
     *
     * @param string $name
     *            identification name of the statement
     * @return Ddth_Dao_SqlStatement the obtained statement, NULL if not found
     */
    public function getSqlStatement($name) {
        $stm = isset($this->cache[$name]) ? $this->cache[$name] : NULL;
        if ($stm === NULL) {
            $sql = $this->configs->getProperty($name);
            /**
             *
             * @var Ddth_Dao_SqlStatement
             */
            $stm = $sql !== NULL ? new $this->stmClass() : NULL;
            if ($stm !== NULL) {
                if (!($stm instanceof Ddth_Dao_SqlStatement)) {
                    $stm = NULL;
                    $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "][{$this->stmClass}] is not instance of [Ddth_Dao_SqlStatement]!";
                    $this->LOGGER->error($msg);
                } else {
                    $stm->setSql($sql);
                    $this->cache[$name] = $stm;
                }
            }
        }
        return $stm;
    }
}
