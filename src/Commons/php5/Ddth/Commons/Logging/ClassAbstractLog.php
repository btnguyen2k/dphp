<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * An abstract named logger.
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
 * An abstract named logger.
 * 
 * This class is the top level abstract class of all other concrete named
 * logger inplementations.
 *
 * @package    	Ddth
 * @subpackage	Logging
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @since      	Class available since v0.1
 */
abstract class Ddth_Commons_Logging_AbstractLog
implements Ddth_Commons_Logging_ILog {
    private $className;
    
    private $settings;
    
    public function __construct($className) {
        $this->className = $className;
    }

    /**
     * Initializes this logger.
     *
     * @param Ddth_Commons_Properties initializing properties
     * @throws {@link Ddth_Commons_Logging_LogConfigurationException LogConfigurationException} 
     */
    public function init($prop) {
        if ( $prop == NULL ) {
            $prop = new Ddth_Commons_Properties();
        }
        if ( !($prop instanceof Ddth_Commons_Properties) ) {
            $msg = 'Invalid argument!';
            throw new Ddth_Commons_Logging_LogConfigurationException($msg);
        }
        $this->settings = $prop;
    }

    /**
     * Logs a message with debug log level.
     *
     * @param string
     * @param Exception
     */
    public function debug($message, $e = NULL);

    /**
     * Logs a message with error log level.
     *
     * @param string
     * @param Exception
     */
    public function error($message, $e = NULL);

    /**
     * Logs a message with fatal log level.
     *
     * @param string
     * @param Exception
     */
    public function fatal($message, $e = NULL);

    /**
     * Logs a message with info log level.
     *
     * @param string
     * @param Exception
     */
    public function info($message, $e = NULL);

    /**
     * Logs a message with trace log level.
     *
     * @param string
     * @param Exception
     */
    public function trace($message, $e = NULL);

    /**
     * Logs a message with warn log level.
     *
     * @param string
     * @param Exception
     */
    public function warn($message, $e = NULL);

    /**
     * Is debug logging currently enabled?
     *
     * @return bool
     */
    public function isDebugEnabled();

    /**
     * Is error logging currently enabled?
     *
     * @return bool
     */
    public function isErrorEnabled();

    /**
     * Is fatal logging currently enabled?
     *
     * @return bool
     */
    public function isFatalEnabled();

    /**
     * Is info logging currently enabled?
     *
     * @return bool
     */
    public function isInfoEnabled();

    /**
     * Is trace logging currently enabled?
     *
     * @return bool
     */
    public function isTraceEnabled();

    /**
     * Is warn logging currently enabled?
     *
     * @return bool
     */
    public function isWarnEnabled();
}
?>