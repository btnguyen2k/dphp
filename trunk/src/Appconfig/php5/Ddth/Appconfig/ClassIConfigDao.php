<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * DAO interface to manage {@link Ddth_Appconfig_Config}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Appconfig
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIAdodbFactory.php 144 2008-02-29 15:34:04Z btnguyen2k@gmail.com $
 * @since       File available since v0.1
 */

/**
 * DAO interface to manage {@link Ddth_Appconfig_Config}.
 *
 * @package     Appconfig
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.1
 */
interface Ddth_Appconfig_IConfigDao extends Ddth_Dao_IDao {

    /**
     * Creates a new configuration.
     *
     * @param Ddth_Appconfig_Config $config
     */
    public function createConfig($config);

    /**
     * Deletes a configuration.
     *
     * @param Ddth_Appconfig_Config $config
     */
    public function deleteConfig($config);

    /**
     * Gets a configuration by $domain & $key.
     *
     * @param string $domain
     * @param string $key
     * @return Ddth_Appconfig_Config
     */
    public function getConfig($domain, $key);

    /**
     * Updates an existing configuration.
     *
     * @param Ddth_Appconfig_Config $config
     */
    public function updateConfig($config);

    /**
     * Gets all available configurations.
     *
     * @return Array an index array of all configurations
     */
    public function getAllConfigs();

    /**
     * Gets all configurations in a domain.
     *
     * @param string $domain
     * @return Array an index array of all configurations
     */
    public function getConfigs($domain);

    /**
     * Deletes all configurations in a domain.
     *
     * @param string $domain
     */
    public function deleteConfigs($domain);
}
?>
