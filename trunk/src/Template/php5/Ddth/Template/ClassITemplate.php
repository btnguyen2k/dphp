<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Represents a template pack.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Template
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1
 */

/**
 * Represents a template pack.
 *
 * This interface represents a single template pack.
 *
 * @package    	Template
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
interface Ddth_Template_ITemplate {
    /**
     * Gets description of the template pack.
     *
     * @return string
     */
    public function getDescription();
    
    /**
     * Gets display name of the template pack.
     *
     * @return string
     */
    public function getDisplayName();
    
    /**
     * Gets name of the template pack.
     *
     * @return string
     */
    public function getName();

    /**
     * Retrieves a page.
     * 
     * @param string
     * @return Ddth_Template_IPage
     * @throws Ddth_Template_TemplateException
     */
    public function getPage($pageId);
    
    /**
     * Initializes the template pack.
     *
     * @param Dddth_Commons_Properties
     * @throws Ddth_Template_TemplateException
     */
    public function init($settings);
}
?>