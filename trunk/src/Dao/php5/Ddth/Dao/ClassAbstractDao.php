<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Abstract implementation of {@link Ddth_Dao_IDao}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Dao
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassAbstractDao.php 258 2010-12-28 10:39:48Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.1
 */

/**
 * Abstract implementation of {@link Ddth_Dao_IDao}.
 *
 * @package Dao
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since Class available since v0.1
 */
abstract class Ddth_Dao_AbstractDao implements Ddth_Dao_IDao {

    /**
     *
     * @var Ddth_Dao_IDaoFactory
     */
    private $daoFactory;

    private $config;

    /**
     * Constructs a new Ddth_Dao_AbstractDao object,
     */
    public function __construct() {
    }

    /**
     *
     * @see Ddth_Dao_IDao::init()
     */
    public function init($daoFactory, $config = Array()) {
        $this->daoFactory = $daoFactory;
        $this->config = $config;
    }

    /**
     * Gets the DaoFactory instance.
     *
     * @return Ddth_Dao_IDaoFactory
     */
    public function getDaoFactory() {
        return $this->daoFactory;
    }

    /**
     * Gets a configuration entry.
     *
     * @param mixed $name
     * @return mixed
     */
    public function getConfig($name) {
        return isset($this->config[$name]) ? $this->config[$name] : NULL;
    }

    /**
     * Gets a configuration entry.
     *
     * @param mixed $name
     * @param mixed $value
     */
    public function setConfig($name, $value) {
        if (!isset($this->config) || !is_array($this->config)) {
            $this->config = Array();
        }
        $this->config[$name] = $value;
    }
}
