<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Passport entity.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Duser
 * @author		Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version			$Id: ClassIAdodbFactory.php 144 2008-02-29 15:34:04Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

/**
 * This interface represents the Passport: Permission is granted to user/group via
 * Passport.
 *
 * @package    	Duser
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
interface Ddth_Duser_IPassport {

    /**
     * Does passport apply to all resources in domain?
     * 
     * @return boolean
     */
    public function isGlobal();

    /**
     * Returns the group that the passport has been granted to.
     * 
     * @return Ddth_Duser_IGroup
     */
    public function getGroup();

    /**
     * Returns the user that the passport has been granted to.
     * 
     * @return Ddth_Duser_IUser
     */
    public function getUser();

    /**
     * Returns the permission the passport has been granted.
     * 
     * @return Ddth_Duser_IPermission
     */
    public function getPermission();
}
?>
