<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory to create {@link Ddth_Adodb_AdodbSqlStatement} objects.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Adodb
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.1.6
 */

/**
 * Factory to create {@link Ddth_Adodb_AdodbSqlStatement} objects.
 *
 * @package     Adodb
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.1.6
 */
class Ddth_Adodb_AdodbSqlStatementFactory {

    /**
     * @var Ddth_Commons_Properties
     */
    private $configurations;

    private $cache = Array();

    /**
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    private static $staticCache = Array();

    /**
     * Constructs a Ddth_Adodb_AdodbSqlStatementFactory object from a configuration file.
     * 
     * @param string
     * @return Ddth_Adodb_AdodbSqlStatementFactory
     */
    public static function getInstance($configFile) {
        $obj = isset(self::$staticCache[$configFile]) ? self::$staticCache[$configFile] : NULL;
        if ( $obj === NULL ) {
            $fileContent = Ddth_Commons_Loader::loadFileContent($configFile);
            if ( $fileContent === NULL || $fileContent === "" ) {
                return NULL;
            }
            $props = new Ddth_Commons_Properties();
            $props->import($fileContent);
            $obj = new Ddth_Adodb_AdodbSqlStatementFactory($props);
            
            self::$staticCache[$configFile] = $obj;
        }
        return $obj;
    }

    /**
     * Constructs a new Ddth_Adodb_AdodbSqlStatementFactory object.
     * 
     * @param Ddth_Commons_Properties
     */
    protected function __construct($props) {
        //$clazz = "Ddth_Adodb_AdodbSqlStatementFactory";
        //$this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog($clazz);
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
        $this->setConfiguration($props);
    }

    /**
     * Sets configurations.
     * 
     * @param Ddth_Commons_Properties
     */
    public function setConfiguration($props) {
        $this->configurations = $props;
        $this->cache = Array(); //clear cache
    }

    /**
     * Gets an AdodbSqlStatement.
     * 
     * @param string
     * @return Ddth_Adodb_AdodbSqlStatement
     */
    public function getSqlStatement($name) {
        $stm = isset($this->cache[$name]) ? $this->cache[$name] : NULL;
        if ( $stm === NULL ) {
            $rawData = $this->configurations->getProperty($name);
            if ( $rawData === NULl || $rawData === "" ) {
                $msg = "SQL Statement Configuration not found [$name]!";
                $this->LOGGER->warn($msg);
                return NULL;
            }
            $tokens = split("[, ]+", $rawData, 2);
            if ( count($tokens) < 2 || !is_int($tokens[0]) ) {
                $msg = "Invalid SQL Statement Configuration [$rawData]!";
                $this->LOGGER->error($msg);
                return NULL;
            }
            $params = Array();
            $sql = "";
            if ( $tokens[0] > 0 ) {
                $stmTokens = split("[, ]+", $tokens[1], $tokens[0] + 1);
                for ( $i = 0, $n = count($stmTokens) - 1; $i < $n; $i++ ) {
                    $params[] = $stmTokens[$i];
                }
                $sql = $stmTokens[count($stmTokens) - 1];
            }
            $stm = new Ddth_Adodb_AdodbSqlStatement();
            $stm->setParams($params);
            $stm->setSql($sql);
            $this->cache[$name] = $stm;
        }
        return stm;
    }
}
?>