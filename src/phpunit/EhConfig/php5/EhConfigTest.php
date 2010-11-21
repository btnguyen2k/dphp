<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Adodb.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @author		Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @version			$Id: AdodbTest.php 180 2008-09-05 09:03:13Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

//initialization
//defines package name and package php version
if ( !defined('PACKAGE') ) {
    define('PACKAGE', 'EhConfig');
}
if ( !defined('PACKAGE_PHP_VERSION') ) {
    define('PACKAGE_PHP_VERSION', 'php5');
}
$REQUIRED_PACKAGES = Array('Commons', 'Adodb', 'EhProperties');

//setting up include path
$dir = dirname(dirname(dirname(dirname(__FILE__))));
$INCLUDE_PATH = '.';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.PACKAGE.'/'.PACKAGE_PHP_VERSION;
foreach ( $REQUIRED_PACKAGES as $package ) {
    $INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.$package.'/'.PACKAGE_PHP_VERSION;
}
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/AdoDb5-5.0.4';
ini_set('include_path', $INCLUDE_PATH);

require_once 'PHPUnit/Framework.php';

class EhConfigTest extends PHPUnit_Framework_TestCase {
    protected function setup() {
        parent::setUp();
        $dir = '../../../tmp';
        if ( !is_dir($dir) ) {
            mkdir($dir);
        }
        copy('../../../firebirdembed/blankdb.gdb', '../../../tmp/ehconfigtest.gdb');
    }

    /**
     * Tests creation of Ddth::EhConfig::ConfigManager objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_EhConfig_ConfigManager::getInstance();
        $this->assertNotNull($obj1, "Can not create Ddth::EhConfig::ConfigManager object!");

        $obj2 = Ddth_EhConfig_ConfigManager::getInstance();
        $this->assertTrue($obj1===$obj2);
    }

    /**
     * Tests creation of database table to store configurations.
     */
    public function testCreateTable() {
        $props = new Ddth_EhProperties_EhProperties();
        $configFile = Ddth_EhConfig_ConfigManager::DEFAULT_CONFIG_FILE;
        $props->import(Ddth_Commons_Loader::loadFileContent($configFile));
        $clazz = $props->getProperty(Ddth_EhConfig_Adodb_ConfigManager::PROPERTY_ADODB_FACTORY_CLASS, Ddth_EhConfig_Adodb_ConfigManager::DEFAULT_ADODB_FACTORY_CLASS);
        $adodbFactory = new $clazz();
        $this->assertNotNull($adodbFactory);

        $conn = $adodbFactory->getConnection(true);
        $sql = 'CREATE TABLE tblConfig (conf_domain VARCHAR(32), conf_name VARCHAR(32), conf_value VARCHAR(255))';
        $conn->Execute($sql);
        $adodbFactory->closeConnection($conn);
    }

    /**
     * Test createConfig function.
     */
    public function testCreateConfig() {
        $this->testCreateTable();

        $cm = Ddth_EhConfig_ConfigManager::getInstance();
        $this->assertNotNull($cm, "Can not create Ddth::EhConfig::ConfigManager object!");

        $key = new Ddth_EhConfig_ConfigKey('GLOBAL', 'CHARSET');
        $value = 'UTF-8';
        $config = new Ddth_EhConfig_Config($key, $value);
        $cm->createConfig($config);

        $key = new Ddth_EhConfig_ConfigKey('GLOBAL', 'NAME');
        $value = 'ADOdb';
        $config = new Ddth_EhConfig_Config($key, $value);
        $cm->createConfig($config);
    }

    /**
     * Test getConfig function.
     */
    public function testGetConfig() {
        $this->testCreateConfig();

        $cm = Ddth_EhConfig_ConfigManager::getInstance();
        $this->assertNotNull($cm, "Can not create Ddth::EhConfig::ConfigManager object!");

        $key = new Ddth_EhConfig_ConfigKey('GLOBAL', 'CHARSET');
        $config = $cm->getConfig($key);
        $this->assertNotNull($config);
        $this->assertEquals($key, $config->getKey());
        $this->assertEquals('UTF-8', $config->getValue());
    }

    /**
     * Test deleteConfig function
     */
    public function testDeleteConfig() {
        $this->testCreateConfig();

        $cm = Ddth_EhConfig_ConfigManager::getInstance();
        $this->assertNotNull($cm, "Can not create Ddth::EhConfig::ConfigManager object!");

        $key = new Ddth_EhConfig_ConfigKey('GLOBAL', 'CHARSET');
        $config = $cm->getConfig($key);
        $this->assertNotNull($config);
        $this->assertEquals($key, $config->getKey());
        $this->assertEquals('UTF-8', $config->getValue());

        $cm->deleteConfig($key);
        $config = $cm->getConfig($key);
        $this->assertNull($config);
    }

    /**
     * Test deleteConfig function
     */
    public function deleteAllConfigsInDomain() {
        $this->testCreateConfig();

        $cm = Ddth_EhConfig_ConfigManager::getInstance();
        $this->assertNotNull($cm, "Can not create Ddth::EhConfig::ConfigManager object!");

        $key = new Ddth_EhConfig_ConfigKey('GLOBAL', 'CHARSET');
        $config = $cm->getConfig($key);
        $this->assertNotNull($config);
        $this->assertEquals($key, $config->getKey());
        $this->assertEquals('UTF-8', $config->getValue());

        $cm->deleteAllConfigsInDomain($key->getDomain());
        $config = $cm->getConfig($key);
        $this->assertNull($config);
    }
}
?>