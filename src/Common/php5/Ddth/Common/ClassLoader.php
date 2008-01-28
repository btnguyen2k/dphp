<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Class and source code loader for PHP.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * This module provides handy procedural and object oriented interface to load PHP
 * classes and source code files.
 *
 * @category	Common
 * @package		Ddth
 * @subpackage	Common
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1
 */

/**
 * Object oriented interface to load PHP classes and source code files.
 *
 * This helper class provides an object oriented interface to load PHP classes and
 * source code files.
 *
 * @package    	Ddth
 * @subpackage	Common
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @since      	Class available since v0.1
 */
final class Ddth_Common_Loader {
    /**
     * Loads a PHP source file.
     *
     * @param string $fileName
     * @param bool $singleton use {@link http://www.php.net/include_once/ include_once()}
     * to load file if set to true, use {@link http://www.php.net/include/ include()} otherwise.
     *
     * @return bool true if success, false otherwise
     */
    public static function loadFile($fileName, $singleton=true) {
        if ( $singleton ) {
            return (@include_once $fileName) != FALSE;
        } else {
            return (@include $fileName) != FALSE;
        }
    }

    /**
     * Loads a PHP class.
     *
     * @param string $className
     * @param Ddth_Common_IClassNameTranslator $classNameTranslator
     *
     * @return bool true if success, false otherwise
     */
    public static function loadClass($className, $classNameTranslator) {
        return Ddth_Common_Loader::loadFile(
            $classNameTranslator->translateClassNameToFileName($className));
    }
}
?>