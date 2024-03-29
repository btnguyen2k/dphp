<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * An implementation of {@link Ddth_Dao_IDaoFactory}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Dao
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassBaseDaoFactory.php 293 2011-09-04 19:06:23Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.2
 */

/**
 * An implementation of {@link Ddth_Dao_IDaoFactory}.
 * This can be used as a base implementation
 * of dao factory.
 *
 * This class also provides static function to create instance of {@link
 * Ddth_Dao_IDaoFactory}.
 * This function accepts an associative array as parameter. If the argument is
 * NULL,
 * the global variable $DPHP_DAO_CONFIG is used instead (if there is no global
 * variable
 * $DPHP_DAO_CONFIG, the function falls back to use the global variable
 * $DPHP_DAO_CONF).
 *
 * Detailed specs of the configuration array:
 * <code>
 * Array(
 * # Name of the DAO factory class (must implement interface
 * Ddth_Dao_IDaoFactory)
 * 'dphp-dao.factoryClass' => 'Ddth_Dao_BaseDaoFactory',
 *
 * # DAOs configurations: Each DAO is configured in the following format
 * 'dao.<daoname>' => '<dao class name, must implement interface
 * Ddth_Dao_IDao>',
 * # Example:
 * 'dao.user' => 'Ddth_Demo_Dao_UserDao'
 * )
 * </code>
 *
 * @package Dao
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since Class available since v0.2
 */
class Ddth_Dao_BaseDaoFactory implements Ddth_Dao_IDaoFactory {

    private static $cache = Array();
    private $daoCache = Array();
    private static $queryLog = Array();

    const DEFAULT_CONFIG_FILE = "dphp-dao.properties";
    const CONF_DAO_FACTORY_CLASS = 'dphp-dao.factoryClass';
    const CONF_DAO_PREFIX = 'dao.';

    /**
     *
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    /**
     *
     * @var Array
     */
    private $config = NULL;

    /**
     * Constructs a new Ddth_Dao_BaseDaoFactory object.
     */
    public function __construct() {
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
    }

    /**
     * Logs an executed query.
     *
     * @param mixed $queryInfo
     */
    public static function logQuery($queryInfo) {
        self::$queryLog[] = $queryInfo;
    }

    /**
     * Gets the query log.
     *
     * @return Array
     */
    public static function getQueryLog() {
        return self::$queryLog;
    }

    /**
     * Gets an instance of DAO factory.
     *
     * @param Array $config
     *            configuration array (see {@link Ddth_Dao_BaseDaoFactory here}
     *            for more information.
     * @return Ddth_Dao_IDaoFactory
     * @throws {@link Ddth_Dao_DaoException}
     */
    public static function getInstance($config = NULL) {
        $logger = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
        if ($config === NULL) {
            global $DPHP_DAO_CONFIG;
            $config = isset($DPHP_DAO_CONFIG) ? $DPHP_DAO_CONFIG : NULL;
            if ($config !== NULL && $logger->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . ']Use global config $DPHP_DAO_CONFIG';
                $logger->debug($msg);
            }
        }
        if ($config === NULL) {
            global $DPHP_DAO_CONF;
            $config = isset($DPHP_DAO_CONF) ? $DPHP_DAO_CONF : NULL;
            if ($config !== NULL && $logger->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . ']Use global config $DPHP_DAO_CONF';
                $logger->debug($msg);
            }
        }
        if ($config === NULL) {
            global $DPHP_DAO_CFG;
            $config = isset($DPHP_DAO_CFG) ? $DPHP_DAO_CFG : NULL;
            if ($config !== NULL && $logger->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . ']Use global config $DPHP_DAO_CFG';
                $logger->debug($msg);
            }
        }
        if ($config === NULL) {
            $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]NULL config!";
            $logger->warn($msg);
            return NULL;
        }
        $hash = md5(serialize($config));
        /**
         *
         * @var Ddth_Dao_IDaoFactory
         */
        $obj = isset(self::$cache[$hash]) ? self::$cache[$hash] : NULL;
        if ($obj === NULL) {
            $daoFactoryClass = isset($config[self::CONF_DAO_FACTORY_CLASS]) ? $config[self::CONF_DAO_FACTORY_CLASS] : NULL;
            if ($daoFactoryClass === NULL || trim($daoFactoryClass) === '') {
                $daoFactoryClass = __CLASS__;
            }
            if ($logger->isDebugEnabled()) {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Dao factory class: {$daoFactoryClass}";
                $logger->debug($msg);
            }
            $obj = new $daoFactoryClass();
            if ($obj instanceof Ddth_Dao_IDaoFactory) {
                $obj->init($config);
            } else {
                $msg = 'The DAO factory is not instance of [Ddth_Dao_IDaoFactory]!';
                throw new Ddth_Dao_DaoException($msg);
            }
            self::$cache[$hash] = $obj;
        }
        return $obj;
    }

    /**
     *
     * @see Ddth_Dao_IDaoFactory::init();
     */
    public function init($config) {
        $this->config = $config;
    }

    /**
     * Gets the configuration array.
     *
     * @return Array
     */
    protected function getConfig() {
        return $this->config;
    }

    /**
     * Gets a DAO by name.
     *
     * @param string $name
     * @return {@link Ddth_Dao_IDao}
     * @throws {@link Ddth_Dao_DaoException}
     */
    public function getDao($name) {
        $daoConfig = isset($this->config[$name]) ? $this->config[$name] : NULL;
        if ($daoConfig === NULL) {
            return NULL;
        }
        $dao = isset($this->daoCache[$name]) ? $this->daoCache[$name] : NULL;
        if (!($dao instanceof Ddth_Dao_IDao)) {
            $dao = NULL;
        }
        if ($dao === NULL) {
            if (is_array($daoConfig)) {
                $className = $daoConfig['class'];
                $_daoConfig = $daoConfig;
                unset($_daoConfig['class']);
            } else {
                $className = $daoConfig;
                $_daoConfig = Array();
            }
            $dao = new $className();
            if ($dao instanceof Ddth_Dao_IDao) {
                $dao->init($this, $_daoConfig);
                $this->daoCache[$name] = $dao;
            } else {
                $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "][$className] is not instance of [Ddth_Dao_IDao]!";
                $this->LOGGER->warn($msg);
                $dao = NULL;
            }
        }
        return $dao;
    }

    /**
     * Convenience method to retrieve a DAO by name following the convention:
     * when method Ddth_Dao_DaoFactory::getXxxDao is called:
     * - getDao('xxxDao') is called, if NULL is returned:
     * - getDao('XxxDao') is called, if NULL is returned:
     * - getDao('xxx') is called, if NULL is returned:
     * - getDao('Xxx') is called
     */
    public function __call($name, $arguments = Array()) {
        $matches = Array();
        if (preg_match('/get((\w+)Dao)/i', $name, $matches)) {
            // try 1
            $names = $this->_genNames($matches[1]);
            $dao = NULL;
            foreach ($names as $name) {
                $dao = $this->getDao($name);
                if ($dao !== NULL) {
                    return $dao;
                }
            }

            // try 2
            $names = $this->_genNames($matches[2]);
            $dao = NULL;
            foreach ($names as $name) {
                $dao = $this->getDao($name);
                if ($dao !== NULL) {
                    return $dao;
                }
            }
        }
        return NULL;
    }

    private function _genNames($name) {
        $lower = strtolower($name);
        $upper = strtoupper($name);
        $prefix = 'dao.';
        $result = Array($name, ucfirst($name), $lower, ucfirst($lower), $upper);
        $result[] = $prefix . $name;
        $result[] = $prefix . ucfirst($name);
        $result[] = $prefix . $lower;
        $result[] = $prefix . ucfirst($lower);
        $result[] = $prefix . $upper;
        return $result;
    }
}
