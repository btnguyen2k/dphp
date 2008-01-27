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
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1 
 */

/**
 * Object oriented interface to load PHP classes and source code files.
 *
 * Xconfig is a library that provides a light-weight mechanism to access data
 * stored in a XML file. This library was created with the purpose to read
 * application's configuration data stored in XML format; hence the name Xconfig.
 *
 * @package    	Ddth
 * @subpackage	Common
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @since      	Class available since v0.1
 */
class Ddth_Common_Loader {
    private $strXml;
    private $objSimpleXml;

    /**
     * Constructs a new Ddth_Xconfig object.
     */
    function __construct() {
        $this->strXml = NULL;
        $this->objSimpleXml = NULL;
    }

    /**
     * Gets the XML configuration string.
     * @return string
     */
    public function getXmlConfig() {
        return $this->strXml;
    }

    /**
     * Sets the XML configuration string.
     * 
     * XML configuration string is set to NULL if the input xml string is not parsable.
     * 
     * @param string $xml
     */
    public function setXmlConfig($xml="") {
        $this->strXml = $xml;
        try {
            @$this->objSimpleXml = new SimpleXMLElement($xml);
        } catch (Exception $e) {
            $this->objSimpleXml = NULL;
            $this->strXml = NULL;
        }
    }
}
?>