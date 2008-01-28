<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * A simple logging interface abstracting other logging libraries.  
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
 * A simple logging interface abstracting other logging libraries.
 * 
 * A simple logging interface abstracting other logging libraries. In order to be
 * instantiated successfully by LogFactory, classes that implement this interface
 * must have a constructor that takes a single String parameter representing the
 * "name" of this ILog.
 * 
 * The six logging levels used by ILog are (in order):
 * 1. trace (the least serious)
 * 2. debug
 * 3. info
 * 4. warn
 * 5. error
 * 6. fatal (the most serious)
 * 
 * The mapping of these log levels to the concepts used by the underlying logging
 * system is implementation dependent. The implemention should ensure, though,
 * that this ordering behaves as expected.
 * 
 * Configuration of the underlying logging system will generally be done external
 * to the Logging APIs, through whatever mechanism is supported by that system.
 *
 * @package    	Ddth
 * @subpackage	Logging
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @since      	Class available since v0.1
 */
interface Ddth_Commons_Logging_ILog {
}
?>