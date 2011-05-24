<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * User-Permission mapping.
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
 * @version			$Id$
 * @since      	File available since v0.1
 */

/**
 * This class captures the user-permission mapping.
 *
 * @package    	Duser
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
class Ddth_Duser_UserRule {

    /**
     * @var Ddth_Duser_IUser
     */
    private $user;

    /**
     * @var Ddth_Duser_IPermission
     */
    private $permission;

    /**
     * @var boolean
     */
    private $isGlobal;

    /**
     * Constructs a new Ddth_Duser_UserRule object.
     * 
     * @param Ddth_Duser_IUser $user
     * @param Ddth_Duser_IPermission $permission
     * @param boolean $isGlobal
     */
    public function __construct($user = NULL, $permission = NULL, $isGlobal = false) {
        $this->setUser($user);
        $this->setPermission($permission);
        $this->setIsGlobal($isGlobal);
    }

    /**
     * Gets id of the user in the mapping.
     * 
     * @return mixed
     */
    public function getUserId() {
        return $this->user !== NULL ? $this->user->getId() : NULL;
    }

    /**
     * Gets the user in the mapping.
     * 
     * @return Ddth_Duser_IUser
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Sets the user in the mapping.
     * 
     * @param Ddth_Duser_IUser $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * Gets the permission in the mapping.
     * 
     * @return Ddth_Duser_IPermission
     */
    public function getPermission() {
        return $this->permission;
    }

    /**
     * Sets the permission in the mapping.
     * 
     * @param Ddth_Duser_IPermission $permission
     */
    public function setPermission($permission) {
        $this->permission = $permission;
    }

    /**
     * Gets 'isGlobal' attribute.
     * 
     * @return boolean
     */
    public function isGlobal() {
        return $this->isGlobal;
    }

    /**
     * Sets 'isGlobal' attribute.
     * 
     * @param boolean $isGlobal
     */
    public function setIsGlobal($isGlobal) {
        $this->isGlobal = $isGlobal;
    }
}
?>
