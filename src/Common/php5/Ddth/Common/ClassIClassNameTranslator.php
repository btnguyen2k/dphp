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
 * @id			$Id: Loader.php 51 2008-01-27 19:35:35Z nbthanh@vninformatics.com $
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
interface Ddth_Common_IClassNameTranslator {
    /**
     * Translates a class name to physical file name on disk.
     * 
     * @param string $className
     * 
     * @return string file name on disk available for including.  
     */
    public function translateClassNameToFileName($className);
}
?>