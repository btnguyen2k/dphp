<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * A user profile entry.
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
 * This class represents an user profile entry.
 *
 * @package    	Duser
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
class Ddth_Duser_UserProfile {

    /**
     * @var mixed
     */
    private $userId;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $data;

    /**
     * Constructs a new Ddth_Duser_UserProfile object.
     * 
     * @param mixed $userId
     * @param string $domain
     * @param string $name
     * @param string $data
     */
    public function __construct($userId = NULL, $domain = NULL, $name = NULL, $data = NULL) {
        $this->setUserId($userId);
        $this->setDomain($domain);
        $this->setName($name);
        $this->setData($data);
    }

    /**
     * Gets profile data.
     * 
     * @return string
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Gets profile domain.
     * 
     * @return string
     */
    public function getDomain() {
        return $this->domain;
    }

    /**
     * Gets profile name
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Gets user id associated with the profile entry.
     * 
     * @return mixed
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Sets profile data.
     * 
     * @param string $data
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * Sets profile domain.
     * 
     * @param string $domain
     */
    public function setDomain($domain) {
        $this->domain = $domain;
    }

    /**
     * Sets profile name.
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Sets user id associated with the profile entry.
     * 
     * @param mixed $userId
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }
}
?>
