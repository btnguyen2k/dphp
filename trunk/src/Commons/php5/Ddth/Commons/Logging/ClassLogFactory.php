<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory for creating {@link Ddth_Commons_Logging_ILog ILog} instances.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @category	Commons
 * @package		Ddth
 * @subpackage	Logging
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @id			$Id:ClassIClassNameTranslator.php 60 2008-01-28 18:25:46Z nbthanh@vninformatics.com $
 * @since      	File available since v0.1
 */

/**
 * Automatically loads class source file when used.
 *
 * @param string
 */
function __autoload($className) {
    require_once 'Commons/ClassDefaultClassNameTranslator.php';
    require_once 'Commons/ClassLoader.php';
    $translator = Ddth_Commons_DefaultClassNameTranslator::getInstance();
    Ddth_Commons_Loader::loadClass($className, $translator);
}

/**
 * Factory for creating {@link Ddth_Commons_Logging_ILog ILog} instances.
 *
 * @package    	Ddth
 * @subpackage	Logging
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @since      	Class available since v0.1
 */
interface Ddth_Commons_Logging_LogFactory {
    const FACTORY_SETTINGS_FILE = "dphp-logging.properties";

    private static $factorySettings = NULL;

    private static $logSettings = NULL;

    /**
     * Gets a named logger.
     *
     * @param string name of the configuration file
     * @return Ddth_Commons_Logging_ILog
     * @throws {@link Ddth_Commons_Logging_LogConfigurationException LogConfigurationException}
     * @throws {@link Ddth_Commons_Exceptions_IllegalArgumentException IllegalArgumentException}
     * @throws {@link Ddth_Commons_Exceptions_IllegalStateException IllegalStateException}
     */
    public static function getLog($className, $configFile=NULL) {
        if ( self::$logSettings == NULL ) {
            if ( $configFile == NULL ) {
                $configFile = self::FACTORY_SETTINGS_FILE;
            }
            self::loadFactorySettings($configFile);
        }
    }

    /**
     * Loads factory settings from configuration file.
     * 
     * @param string name of the configuration file
     * @throws {@link Ddth_Commons_Logging_LogConfigurationException LogConfigurationException}
     * @throws {@link Ddth_Commons_Exceptions_IllegalArgumentException IllegalArgumentException}
     * @throws {@link Ddth_Commons_Exceptions_IllegalStateException IllegalStateException}
     */
    private static function loadFactorySettings($configFile=NULL) {
        if ( $configFile == NULL ) {
            $configFile = self::FACTORY_SETTINGS_FILE;
        }
        $config = Ddth_Commons_Loader::loadFileContent($configFile);
        if ( $config == NULL ) {
            $msg = 'Can not load log factory configuration file "'.$configFile.'"';
            throw new Ddth_Commons_Logging_LogConfigurationException($msg);
        }
        $prop = new Ddth_Commons_Properties();
        $prop->import($config);
        self::$factorySettings = $prop;
    }
}
?>