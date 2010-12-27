<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * An implementation of {@link Ddth_Dao_Mysql_IMysqlDaoFactory}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @subpackage  Mysql
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIBoManager.php 150 2008-03-12 18:59:43Z nbthanh@vninformatics.com $
 * @since       File available since v0.2
 */

/**
 * An implementation of {@link Ddth_Dao_Mysql_IMysqlDaoFactory}. This can be used as a base implementation
 * of MySQL-based dao factory.
 *
 * This factory uses the same configuration file as {@link Ddth_Dao_BaseDaoFactory}, with additional
 * configurations:
 * <code>
 * # ddth-adodb configuration file
 * ddth-dao.adodb.config=ddth-adodb.properties
 * </code>
 *
 * @package     Dao
 * @subpackage  Mysql
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
class Ddth_Dao_Mysql_BaseMysqlDaoFactory extends Ddth_Dao_BaseDaoFactory implements Ddth_Dao_Mysql_IMysqlDaoFactory {

    const CONF_ADODB_CONFIG_FILE = 'ddth-dao.adodb.config';

    /**
     * @var Ddth_Adodb_IAdodbFactory
     */
    private $adodbFactory;

    /**
     * Constructs a new Ddth_Dao_Adodb_BaseAdodbDaoFactory object.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @see Ddth_Dao_IDaoFactory::init();
     */
    public function init($props) {
        parent::init($props);
        $configFile = $this->props->getProperty(self::CONF_ADODB_CONFIG_FILE);
        $this->adodbFactory = Ddth_Adodb_AdodbFactory::getInstance($configFile);
    }

    /**
     * Gets the Adodb factory.
     *
     * @return Ddth_Adodb_IAdodbFactory
     */
    protected function getAdodbFactory() {
        return $this->adodbFactory;
    }

    /**
     * Sets the Adodb factory.
     *
     * @param Ddth_Adodb_IAdodbFactory $adodbFactory
     */
    protected function setAdodbFactory($adodbFactory) {
        $this->adodbFactory = $adodbFactory;
    }

    /**
     * Gets a DAO by name.
     *
     * @param string $name
     * @return Ddth_Dao_Adodb_AbstractAdodbDao
     * @throws Ddth_Dao_DaoException
     */
    public function getDao($name) {
        $dao = parent::getDao($name);
        if ( $dao !== NULL && !($dao instanceof Ddth_Dao_Adodb_AbstractAdodbDao ) ) {
            $msg = 'DAO ['.$name.'] is not of type [Ddth_Dao_Adodb_AbstractAdodbDao]!';
            throw new Ddth_Dao_DaoException($msg);
        }
        return $dao;
    }

    /**
     * @see Ddth_Dao_Adodb_IAdodbDaoFactory::getConnection()
     */
    public function getConnection($startTransaction=false) {
        return $this->adodbFactory->getConnection($startTransaction);
    }

    /**
     * @see Ddth_Dao_Adodb_IAdodbDaoFactory::closeConnection()
     */
    public function closeConnection($conn, $hasError=false) {
        $this->adodbFactory->closeConnection($conn, $hasError);
    }
}
?>
