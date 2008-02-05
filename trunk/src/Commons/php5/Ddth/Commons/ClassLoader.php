<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Class and file loader for PHP.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * This module provides handy procedural and object oriented interface to load PHP
 * classes and files.
 *
 * @category	Commons
 * @package		Ddth
 * @subpackage	Commons
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @id			$Id:ClassLoader.php 60 2008-01-28 18:25:46Z nbthanh@vninformatics.com $
 * @since      	File available since v0.1
 */

/** */
require_once 'ClassDefaultClassNameTranslator.php';

/**
 * Loads a PHP class.
 *
 * Note: The class' source file will be 'included' by
 * {@link http://www.php.net/include_once/ include_once()}.
 *
 * @param string name of the class to load
 * @param Ddth_Commons_IClassNameTranslator class name to file name translator
 * @return bool true if success, false otherwise
 */
function loader_loadClass($className, $classNameTranslator=NULL) {
    if ( $classNameTranslator==NULL || !is_object($classNameTranslator)
    || !($classNameTranslator instanceof Ddth_Commons_IClassNameTranslator) ) {
        $translator = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        return Ddth_Commons_Loader::loadClass($className, $translator);
    } else {
        return Ddth_Commons_Loader::loadClass($className, $classNameTranslator);
    }
}

/**
 * Loads a PHP source file.
 *
 * Note: the specified source file will be 'included' by
 * {@link http://www.php.net/include_once/ include_once()}
 * or {@link http://www.php.net/include/ include()}.
 *
 * @param string name of the PHP source file to load
 * @param bool use {@link http://www.php.net/include_once/ include_once()}
 * to load file if set to true, use {@link http://www.php.net/include/ include()}
 * otherwise.
 * @return bool true if success, false otherwise
 */
function loader_loadFile($fileName, $singleton=true) {
    return Ddth_Commons_Loader::loadFile($fileName, $singleton);
}

/**
 * Reads entire file content into a string.
 *
 * Note: this method will search for the file in the
 * {@link http://www.php.net/manual/en/ini.core.php#ini.include-path include directory}.
 *
 * @param string name of the file to read
 * @return string the file content as string, or NULL if file is
 * not found or not readable
 */
function loadFileContent($fileName) {
    return Ddth_Commons_Loader::loadFileContent($fileName);
}

/**
 * Object oriented interface to load PHP classes and files.
 *
 * This helper class provides an object oriented interface to load PHP classes and files.
 *
 * @package    	Ddth
 * @subpackage	Commons
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @since      	Class available since v0.1
 */
final class Ddth_Commons_Loader {
    /**
     * Loads a PHP source file.
     *
     * Note: the specified source file will be 'included' by
     * {@link http://www.php.net/include_once/ include_once()}
     * or {@link http://www.php.net/include/ include()}.
     *
     * @param string name of the PHP source file to load
     * @param bool use {@link http://www.php.net/include_once/ include_once()}
     * to load file if set to true, use {@link http://www.php.net/include/ include()}
     * otherwise.
     * @return bool true if success, false otherwise
     */
    public static function loadFile($fileName, $singleton=true) {
        if ( $singleton ) {
            return (@include_once $fileName) !== FALSE;
        } else {
            return (@include $fileName) !== FALSE;
        }
    }

    /**
     * Reads entire file content into a string.
     *
     * Note: this method will search for the file in the
     * {@link http://www.php.net/manual/en/ini.core.php#ini.include-path include directory}.
     *
     * @param string name of the file to read
     * @return string the file content as string, or NULL if file is
     * not found or not readable
     */
    public static function loadFileContent($fileName) {
        $result = @file_get_contents($fileName, FILE_USE_INCLUDE_PATH);
        return $result !== false ? $result : NULL;
    }

    /**
     * Loads a PHP class.
     *
     * Note: The class' source file will be 'included' by
     * {@link http://www.php.net/include_once/ include_once()}.
     *
     * @param string $className
     * @param Ddth_Commons_IClassNameTranslator $classNameTranslator
     * @return bool true if success, false otherwise
     */
    public static function loadClass($className, $classNameTranslator) {
        return Ddth_Commons_Loader::loadFile(
        $classNameTranslator->translateClassNameToFileName($className),
        true);
    }
}
?>