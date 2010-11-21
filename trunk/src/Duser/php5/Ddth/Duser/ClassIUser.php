<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * User entity.
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
 * This interface represents an user entity.
 *
 * @package    	Duser
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
interface Ddth_Duser_IUser {

    /**
     * Adds user to the specified group.
     *
     * @param Ddth_Duser_IGroup
     */
    public function addRole($group);

    /**
     * Authenticates a password.
     *
     * @param string
     * @return boolean
     */
    public function authenticate($password);

    /**
     * Encrypts a supplied password
     *
     * @param string raw password
     * @return string encrypted password
     */
    public function encryptPassword($password);

    /**
     * Retrieves the user's Id.
     *
     * @return mixed
     */
    public function getId();

    /**
     * Retrieves all groups that are assigned to this user.
     *
     * @return Array()
     */
    public function getRoles();

    /**
     * Retrieves the user's login name.
     *
     * @return string
     */
    public function getLoginName();

    /**
     * Retrieves the user's password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Checks if the user has a specific role.
     *
     * @param Ddth_Duser_IGroup
     * @return boolean
     */
    public function hasRole($group);

    /**
     * Checks if this user account belongs to a God group.
     *
     * @return boolean
     */
    public function isGod();

    /**
     * Removes user from a specified group.
     *
     * @param Ddth_Duser_IGroup
     */
    public function removeRole($group);
}
?>
