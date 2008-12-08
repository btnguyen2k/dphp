<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Group-Permission mapping.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Duser
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id: ClassIAdodbFactory.php 144 2008-02-29 15:34:04Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

/**
 * This class captures the group-permission mapping.
 *
 * @package    	Duser
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
class Ddth_Duser_GroupRule {

    /**
     * @var Ddth_Duser_IGroup
     */
    private $group;

    /**
     * @var Ddth_Duser_IPermission
     */
    private $permission;

    /**
     * @var boolean
     */
    private $isGlobal;

    /**
     * Constructs a new Ddth_Duser_GroupRule object.
     * 
     * @param Ddth_Duser_IGroup $group
     * @param Ddth_Duser_IPermission $permission
     * @param boolean $isGlobal
     */
    public function __construct($group = NULL, $permission = NULL, $isGlobal = false) {
        $this->setGroup($group);
        $this->setPermission($permission);
        $this->setIsGlobal($isGlobal);
    }

    /**
     * Gets id of the group in the mapping.
     * 
     * @return mixed
     */
    public function getGroupId() {
        return $this->group !== NULL ? $this->group->getId() : NULL;
    }

    /**
     * Gets the group in the mapping.
     * 
     * @return Ddth_Duser_IGroup
     */
    public function getGroup() {
        return $this->group;
    }

    /**
     * Sets the group in the mapping.
     * 
     * @param Ddth_Duser_IGroup $group
     */
    public function setGroup($group) {
        $this->group = $group;
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
