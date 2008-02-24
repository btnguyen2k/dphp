<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Implementation of IXnode.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Xpath
 * @subpackage	SimpleXml
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1
 */

if ( !function_exists('__autoload') ) {
    /**
     * Automatically loads class source file when used.
     *
     * @param string
     */
    function __autoload($className) {
        require_once 'Ddth/Commons/ClassDefaultClassNameTranslator.php';
        require_once 'Ddth/Commons/ClassLoader.php';
        $translator = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        Ddth_Commons_Loader::loadClass($className, $translator);
    }
}

/**
 * Implementation of IXnode.
 *
 * This implementation of {@link Ddth_Xpath_IXnode IXnode} interface is a
 * "generic" XML node.
 *
 * @package    	Xpath
 * @subpackage	SimpleXml
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
class Ddth_Xpath_SimpleXml_Xnode implements Ddth_Xpath_IXnode {
    
    private $name;
    
    private $parent;
    
    private $path;

    private $simpleXml;
    
    /**
     * Constructs a new Ddth_Xpath_SimpleXml_Xnode object.
     * 
     * @param SimpleXML the SimpleXML object holding data for this node
     * @param Ddth_Xpath_IXnode the parent node
     * @throws {@link Ddth_Xpath_XpathException XpathException} 
     */
    public function __construct($simpleXml, $parent=NULL) {
        if ( $simpleXml==NULL || !($simpleXml instanceof SimpleXML) ) {
            $msg = "[$simpleXml] is not an instance of SimpleXML!";
            throw new Ddth_Xpath_XpathException($msg);
        }
        if ( $parent!=NULL && !($parent instanceof Ddth_Xpath_IXnode) ) {
            $msg = "Parent is not an instance of Ddth_Xpath_IXnode!";
            throw new Ddth_Xpath_XpathException($msg);
        }
        
        $this->simpleXml = $simpleXml;
        $this->parent = $parent;
        $this->name = $simpleXml->getName();
    }
}
?>