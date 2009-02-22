<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Factory to create ADOdb SQL Statements.
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
 * @id			$Id: ClassAdodbFactory.php 148 2008-03-12 05:38:09Z nbthanh@vninformatics.com $
 * @since      	File available since v0.1.6
 */

/**
 * Factory to create ADOdb SQL Statements.
 *
 * @package    	Adodb
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
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

    /**
     * Constructs a new Ddth_Adodb_AdodbSqlStatementFactory object.
     */
    protected function __construct() {
        $clazz = "Ddth_Adodb_AdodbSqlStatementFactory";
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog($clazz);
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