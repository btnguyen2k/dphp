<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Simple logger that sends log messages to PHP's system logger.
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
 * Simple logger that sends log messages to PHP's system logger.
 *
 * This logger uses {@link http://www.php.net/error_log error_log()}
 * function to send log messages to PHP's system logger.
 *
 * @package    	Ddth
 * @subpackage	Logging
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @since      	Class available since v0.1
 */
abstract class Ddth_Commons_Logging_SimpleLog
extends Ddth_Commons_Logging_AbstractLog {
    /**
     * Constructs an new Ddth_Commons_Logging_AbstractLog object.
     *
     * @param logical name of the logger
     */
    public function __construct($className) {
        parent::__construct($className);
    }

    /**
     * Initializes this logger.
     *
     * @param Ddth_Commons_Properties initializing properties
     * @throws {@link Ddth_Commons_Logging_LogConfigurationException LogConfigurationException}
     */
    public function init($prop) {
        //normalize class name
        if ( !is_string($this->className) ) {
            $this->className = NULL;
        }
        if ( $this->className != NULL ) {
            $this->className = trim(str_replace('::', '_', $this->className));
        }

        if ( $prop == NULL ) {
            $prop = new Ddth_Commons_Properties();
        }
        if ( !($prop instanceof Ddth_Commons_Properties) ) {
            $msg = 'Invalid argument!';
            throw new Ddth_Commons_Logging_LogConfigurationException($msg);
        }
        $this->settings = $prop;

        //set up logging level
        $loggerClazzs = Array();
        $needle = Ddth_Commons_Logging_ILog::SETTING_PREFIX_LOGGER_CLASS;
        foreach ( $prop->keys() as $key ) {
            $pos = strpos($key, $needle);
            if ( $pos !== false ) {
                $loggerClazzs[] = substr($key, $pos);
            }
        }
        sort($loggerClazzs);
        $loggerClazzs = array_reverse($loggerClazzs);
        foreach ( $loggerClazzs as $clazz ) {
            if ( $this->className == $clazz ||
            strpos($clazz, $this->className.'_')!==false ) {
                $key = Ddth_Commons_Logging_ILog::SETTING_PREFIX_LOGGER_CLASS.$clazz;
                $level = trim(strtoupper($prop->getProperty($key)));
                switch ($level) {
                    case 'TRACE':
                        $this->isTrace = true;
                    case 'DEBUG':
                        $this->isDebug = true;
                    case 'INFO':
                        $this->isInfo = true;
                    case 'WARN':
                        $this->isWarn = true;
                    case 'ERROR':
                        $this->isError = true;
                    case 'FATAL':
                        $this->isFatal = true;
                    default:
                        //default level = ERROR
                        $this->isError = true;
                        $this->isFatal = true;
                }
                break;
            }
        }
    }

    /**
     * Logs a message with debug log level.
     *
     * @param string
     * @param Exception
     */
    public abstract function debug($message, $e = NULL);

    /**
     * Logs a message with error log level.
     *
     * @param string
     * @param Exception
     */
    public abstract function error($message, $e = NULL);

    /**
     * Logs a message with fatal log level.
     *
     * @param string
     * @param Exception
     */
    public abstract function fatal($message, $e = NULL);

    /**
     * Logs a message with info log level.
     *
     * @param string
     * @param Exception
     */
    public abstract function info($message, $e = NULL);

    /**
     * Logs a message with trace log level.
     *
     * @param string
     * @param Exception
     */
    public abstract function trace($message, $e = NULL);

    /**
     * Logs a message with warn log level.
     *
     * @param string
     * @param Exception
     */
    public abstract function warn($message, $e = NULL);

    /**
     * Is debug logging currently enabled?
     *
     * @return bool
     */
    public function isDebugEnabled() {
        return $this->isDebug;
    }

    /**
     * Is error logging currently enabled?
     *
     * @return bool
     */
    public function isErrorEnabled() {
        return $this->isError;
    }

    /**
     * Is fatal logging currently enabled?
     *
     * @return bool
     */
    public function isFatalEnabled() {
        return $this->isFatal;
    }

    /**
     * Is info logging currently enabled?
     *
     * @return bool
     */
    public function isInfoEnabled() {
        return $this->isInfo;
    }

    /**
     * Is trace logging currently enabled?
     *
     * @return bool
     */
    public function isTraceEnabled() {
        return $this->isTrace;
    }

    /**
     * Is warn logging currently enabled?
     *
     * @return bool
     */
    public function isWarnEnabled() {
        return $this->isWarn;
    }
}
?>