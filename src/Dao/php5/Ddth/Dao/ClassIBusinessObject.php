<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Representation of business object.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * @package		Dao
 * @author		Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	See the included license.txt file for detail
 * @version			$Id$
 * @since      	File available since v0.1
 */

/**
 * Representation of business object.
 *
 * This interface represents a business object.
 *
 * @package    	Dao
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
interface Ddth_Dao_IBusinessObject {
    /**
     * Gets id the business object's id.
     * 
     * @return mixed
     */
    public function getId();
}
?>