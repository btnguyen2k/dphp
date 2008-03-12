<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Adodb-aware BusinessObject manager.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Dao
 * @subpackage  Adodb
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1
 */

/**
 * Adodb-aware BusinessObject manager.
 *
 * @package    	Dao
 * @subpackage  Adodb
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
interface Ddth_Dao_Adodb_IAdodbBoManager extends Ddth_Dao_IBoManager {
    /**
     * Deletes a business object.
     * 
     * @param Ddth_Dao_Adodb_IAdodbBusinessObject
     * @throws {@link Ddth_Dao_DaoException DaoException}
     */
    public function delete($bo);
    
    /**
     * Retrieves a business object from the persistent storage by id.
     * 
     * @param mixed
     * @return Ddth_Dao_Adodb_IAdodbBusinessObject
     * @throws {@link Ddth_Dao_DaoException DaoException}
     */
    public function get($id);
    
    /**
     * Saves a new business object to the persistent storage.
     * 
     * @param Ddth_Dao_Adodb_IAdodbBusinessObject
     * @return Ddth_Dao_Adodb_IAdodbBusinessObject the newly saved business object
     * @throws {@link Ddth_Dao_DaoException DaoException}
     */
    public function save($bo);
    
    /**
     * Updates an existing business object in the persistent storage.
     * 
     * @param Ddth_Dao_Adodb_IAdodbBusinessObject
     * @throws {@link Ddth_Dao_DaoException DaoException}
     */
    public function update($bo);
}
?>