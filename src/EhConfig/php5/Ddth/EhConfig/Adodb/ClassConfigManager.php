<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Adodb implementation of Configuration Manager.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		EhConfig
 * @subpackage  Adodb
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id: ClassIAdodbFactory.php 144 2008-02-29 15:34:04Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

/**
 * Adodb implementation of Configuration Manager.
 * 
 * Configuration file format: configurations are stored in
 * .properties file; supported configuration properties as of v0.1:
 * <code>
 * # ADOdb-SQL to query a configuration by key (domain & name)
 * ehconfig.adodb.sql.getConfig=SELECT conf_value AS conf_value FROM tableName WHERE conf_domain=:domain AND conf_name=:name
 * 
 * # ADOdb-SQL to update a configuration by key (domain & name)
 * ehconfig.adodb.sql.updateConfig=UPDATE tableName SET conf_value=:value WHERE conf_domain=:domain AND conf_name=:name
 * 
 * # ADOdb-SQL to create a new configuration
 * ehconfig.adodb.sql.createConfig=INSERT INTO tableName (conf_domain, conf_name, conf_value) VALUES (:domain, :name, :value)
 * 
 * # ADOdb-SQL to delete a configuration by key (domain & name)
 * ehconfig.adodb.sql.createConfig=DELETE FROM tableName WHERE conf_domain=:domain AND conf_name=:name
 * 
 * # ADOdb-SQL to delete all configurations within a domain
 * ehconfig.adodb.sql.createConfig=DELETE FROM tableName WHERE conf_domain=:domain
 * </code>
 *
 * @package    	EhConfig
 * @subpackage  Adodb
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
class Ddth_EhConfig_Adodb_ConfigManager extends Ddth_EhConfig_ConfigManager {
    /**
     * Constructs a new Ddth_EhConfig_Adodb_ConfigManager object.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * {@see Ddth_EhConfig_ConfigManager::init()}
     */
    public function init($props) {
    }
}
?>
