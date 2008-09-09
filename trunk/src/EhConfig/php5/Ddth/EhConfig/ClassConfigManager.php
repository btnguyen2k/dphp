<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Configuration Manager.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		EhConfig
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id: ClassIAdodbFactory.php 144 2008-02-29 15:34:04Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

/**
 * Configuration Manager.
 * 
 * Configuration file format: configurations are stored in
 * .properties file; supported configuration properties as of v0.1:
 * <code>
 * # Name of the configuration manager class. Default value is
 * # Ddth_EhConfig_Adodb_ConfigManager
 * ehconfig.managerClass=Ddth_EhConfig_Adodb_ConfigManager
 * 
 * # Other configuration properties required by sub-classes
 * # ...
 * </code>
 *
 * @package    	EhConfig
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
abstract class Ddth_EhConfig_ConfigManager {

    const DEFAULT_CONFIG_FILE = 'dphp-ehconfig.properties';

    const PROPERTY_MANAGER_CLASS = 'ehconfig.managerClass';

    const DEFAULT_MANAGER_CLASS = 'Ddth_EhConfig_Adodb_ConfigManager';

    private static $cacheInstances = Array();

    /**
     * Gets an instance of Ddth_EhConfig_ConfigManager.
     *
     * See: {@link Ddth_EhConfig_ConfigManager configuration file format}.
     *
     * @param string name of the configuration file (located in
     * {@link http://www.php.net/manual/en/ini.core.php#ini.include-path include-path})
     * @return Ddth_EhConfig_ConfigManager
     * @throws {@link Ddth_EhConfig_EhConfigException EhConfigException}
     */
    public static function getInstance($configFile=NULL) {
        if ( $configFile === NULL ) {
            return self::getInstance(self::DEFAULT_CONFIG_FILE);
        }
        if ( !isset(self::$cacheInstances[$configFile]) ) {
            $props = new Ddth_Commons_Properties();
            $props->import(Ddth_Commons_Loader::loadFileContent($configFile));

            $managerClass = $props->getProperty(self::PROPERTY_MANAGER_CLASS, self::DEFAULT_MANAGER_CLASS);
            $instance = new $managerClass();
            $instance->init($props);
            self::$cacheInstances[$configFile] = $instance;
        }
        return self::$cacheInstances[$configFile];
    }

    /**
     * Constructs a new Ddth_EhConfig_ConfigManager object.
     */
    protected function __construct() {
    }

    /**
     * Initializes the manager.
     *
     * @param Ddth_Commons_Properties
     * @throws {@link Ddth_EhConfig_EhConfigException EhConfigException}
     */
    protected abstract function init($props);
}
?>
