<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Represents a set of properties as pairs of (key => value).
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
 * @subpackage	Commons
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @id			$Id:ClassIClassNameTranslator.php 60 2008-01-28 18:25:46Z nbthanh@vninformatics.com $
 * @since      	File available since v0.1
 */

/**
 * This class represents a set of properties as pairs of (key => value).
 *
 * The property list can be exported as a string, imported from a string, saved
 * to a file or loaded from a file. Keys and values are treated as strings.
 *
 * Encoding: Properties class uses UTF-8 as the default character encoding.
 * 
 * Supported property file format: the loading, storing, exporting and importing
 * methods support the following property file/string formats.
 * 
 * <b>Java-like properties and ini-like files:</b>
 * - Lines begin with ; or # are comments
 * - Each key/value pair is stored in one or more lines with the following
 *   format: propertyKey=propertyValue
 * - Property value can span multiple lines, joining by character \
 * 
 * Example:
 * <pre>
 * ;this is a comment
 *     #this is also a comment
 * key1=value1
 * key2 = value2
 * key3  =     multiple-line value \
 *     line 2 \
 *     ; line 3 \
 *     # line 4
 * </pre>
 *
 * @package    	Ddth
 * @subpackage	Commons
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @since      	Class available since v0.1
 */
class Ddth_Commons_Properties {
    /**
     * Set of properties (key => value). Key is a string, value is an array of
     * 2 elements, the first one is the property value (string),
     * the second (optional) is the property comment (string.
     */
    private $properties = Array();

    /**
     * Constructs a new Ddth_Commons_Properties object.
     */
    public function __construct() {
    }
    
    /**
     * Empties the property list.
     */
    public function clear() {
        $this->properties = Array();
    }

    /**
     * Gets a property value.
     * 
     * @param string the property key
     * @param string a default value
     * @return string the property value if found, the default value otherwise
     */
    public function getProperty($key, $defaultValue=NULL) {
        if ( isset($this->properties[$key]) ) {
            return $this->properties[$key];
        }
        return $defaultValue;
    }
    
    /**
     * Sets a property value.
     * 
     * @param string the property key
     * @param string the property value
     * @param string the property comment
     * @return the previous value of the property specified by property key, or
     * NULL if there is no such value
     */
    public function setProperty($key, $value, $comment=NULL) {
        $result = $this->getProperty($key);
        $this->properties[$key] = Array($value, $comment);
        return $result;
    }
}
?>