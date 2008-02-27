<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * ADOdb connection factory.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Adodb
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1
 */

if ( !function_exists('__autoload') ) {
    /**
     * Automatically loads class source file when used.
     *
     * @param string
     */
    function __autoload($className) {
        require_once 'Ddth/Commons/ClassDefaultClassNameTranslator.php';
        require_once 'Ddth/Commons/ClassLoader.php';
        $translator = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        Ddth_Commons_Loader::loadClass($className, $translator);
    }
}

/**
 * ADOdb connection factory.
 *
 * This factory provides APIs create and dispose
 * {@link http://adodb.sourceforge.net/ ADOdb} connections.
 *
 * @package    	Adodb
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
class Ddth_Adodb_AdodbFactory {
    const DEFAULT_CONFIG_FILE = "adodb.properties";

    private static $cacheInstances = Array();

    /**
     * Gets an instance of Ddth_Adodb_AdodbFactory.
     *
     * @param string name of the configuration file (located in
     * {@link http://www.php.net/manual/en/ini.core.php#ini.include-path include-path})
     * @return Ddth_Adodb_AdodbFactory
     * @throws {@link Ddth_Adodb_AdodbException AdodbException}
     * @see {@link Ddth_Adodb_AdodbConfig configuration file format}.
     */
    public static function getInstance($configFile=NULL) {
        if ( $configFile == NULL ) {
            return self::getInstance(self::DEFAULT_CONFIG_FILE);
        }
        if ( !isset(self::$cacheInstances[$configFile]) ) {
            $config = Ddth_Adodb_AdodbConfig::loadConfig($configFile);
            $instance = new Ddth_Adodb_AdodbFactory($config);
            self::$cacheInstances[$configFile] = $instance;
        }
        return self::$cacheInstances[$configFile];
    }

    /**
     * Constructs a new Ddth_Adodb_AdodbFactory object.
     *
     * @param Ddth_Adodb_AdodbConfig
     */
    protected function __construct($config) {
    }
}
?>