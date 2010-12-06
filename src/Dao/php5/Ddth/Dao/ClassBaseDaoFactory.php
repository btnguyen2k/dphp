<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * An implementation of {@link Ddth_Dao_IDaoFactory}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIBoManager.php 150 2008-03-12 18:59:43Z nbthanh@vninformatics.com $
 * @since       File available since v0.2
 */

/**
 * An implementation of {@link Ddth_Dao_IDaoFactory}. This can be used as a base implementation
 * of dao factory.
 *
 * This class also provides static function to create instance of {@link Ddth_Dao_IDaoFactory}.
 * The function will first load configuration settings from a .properties file, and then create
 * an instance of type {@link Ddth_Dao_IDaoFactory} based on the configurations. The configuration
 * file has the following format:
 * <code>
 * # Name of the DAO factory class (must implement interface Ddth_Dao_IDaoFactory)
 * ddth-dao.factoryClass=Ddth_Dao_BaseDaoFactory
 *
 * # DAOs configurations: Each DAO is configured in the following format
 * # dao.<daoname>=<dao class name, must implement interface Ddth_Dao_IDao>
 * # Example:
 * dao.user=Ddth_Demo_Dao_UserDao
 * </code>
 *
 * @package     Dao
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
class Ddth_Dao_BaseDaoFactory implements Ddth_Dao_IDaoFactory {

    private static $cache = Array();
    private $daoCache = Array();

    const DEFAULT_CONFIG_FILE = "dphp-dao.properties";
    const CONF_DAO_FACTORY_CLASS = 'ddth-dao.factoryClass';
    const CONF_DAO_PREFIX = 'dao.';

    /**
     * @var Ddth_Commons_Properties
     */
    private $props = NULL;

    /**
     * Constructs a new Ddth_Dao_BaseDaoFactory object.
     */
    public function __construct() {
    }

    /**
     * Gets an instance of DAO factory.
     *
     * @param string $configFile path to the configuration file.
     * @return Ddth_Dao_IDaoFactory
     * @throws {@link Ddth_Dao_DaoException}
     */
    public static function getInstance($configFile = NULL) {
        if ( $configFile === NULL ) {
            return self::getInstance(self::DEFAULT_CONFIG_FILE);
        }
        /**
         * @var Ddth_Dao_IDaoFactory
         */
        $obj = isset(self::$cache[$configFile]) ? self::$cache[$configFile] : NULL;
        if ( $obj === NULL ) {
            $fileContent = Ddth_Commons_Loader::loadFileContent($configFile);
            if ( $fileContent === NULL ) {
                $msg = "Can not read file [$configFile]!";
                throw new Ddth_Dao_DaoException($msg);
            }
            $props = new Ddth_Commons_Properties();
            try {
                $this->props->import($fileContent);
            } catch ( Exception $e ) {
                $msg = $e->getMessage();
                throw new Ddth_Dao_DaoException($msg, $e->getCode());
            }
            $daoFactoryClass = $props->getProperty(self::CONF_DAO_FACTORY_CLASS);
            if ( $daoFactoryClass === NULL || trim($daoFactoryClass) === '' ) {
                $daoFactoryClass = 'Ddth_Dao_BaseDaoFactory';
            }
            
            if ( $daoFactoryClass !== NULL && trim($daoFactoryClass) !== '' ) {
                $obj = new $daoFactoryClass();
            }
            if ( $obj instanceof Ddth_Dao_IDaoFactory ) {
                $obj->init($props);
            } else {
                $msg = 'The DAO factory is not instance of [Ddth_Dao_IDaoFactory]!';
                throw new Ddth_Dao_DaoException($msg);
            }
            self::$cache[$configFile] = $obj;
        }
        return $obj;
    }

    /**
     * @see Ddth_Dao_IDaoFactory::init();
     */
    public function init($props) {
        $this->props = $props;
    }

    /**
     * Gets a property.
     *
     * @param string $name
     * @return string
     */
    protected function getProperty($name) {
        return $this->props->getProperty($name);
    }

    /**
     * Gets a DAO by name.
     *
     * @param string $name
     * @return {@link Ddth_Dao_IDao}
     * @throws {@link Ddth_Dao_DaoException}
     */
    public function getDao($name) {
        $className = $this->getProperty($name);
        if ( $className === NULL || trim($className) === '' ) {
            return NULL;
        }
        $dao = isset($this->daoCache[$name])?$this->daoCache[$name]:NULL;
        if ( !($dao instanceof Ddth_Dao_IDao) ) {
            $dao = NULL;
        }
        if ( $dao === NULL ) {
            $dao = new $className();
            if ( $dao instanceof Ddth_Dao_IDao ) {
                $dao->init($this);
            } else {
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
        if ( preg_match('/get((\w+)Dao)/i', $name, $matches) ) {
            $dao = $this->getDao($matches[1], $arguments);
            if ( $dao === NULL ) {
                $dao = $this->getDao(ucfirst($matches[1]), $arguments);
            }
            if ( $dao === NULL ) {
                $dao = $this->getDao($matches[2], $arguments);
            }
            if ( $dao === NULL ) {
                $dao = $this->getDao(ucfirst($matches[2]), $arguments);
            }
            return $dao;
        }
        return NULL;
    }
}
?>
