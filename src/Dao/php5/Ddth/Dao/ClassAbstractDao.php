<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Abstract implementation of BusinessObject manager.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Dao
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @id			$Id: ClassIBoManager.php 207 2009-01-01 20:24:27Z btnguyen2k@gmail.com $
 * @since      	File available since v0.1
 */

/**
 * Abstract BusinessObject manager.
 *
 * @package    	Dao
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html  LGPL 3.0
 * @version    	0.1
 * @since      	Class available since v0.1
 */
abstract class Ddth_Dao_AbstractDao implements Ddth_Dao_IBoManager {

    /**
     * @var Ddth_Dao_DaoFactory
     */
    private $daoFactory;

    /**
     * Constructs a new Ddth_Dao_AbstractDao object,
     */
    public function __construct() {
    }

    /**
     * Initializes the BO manager.
     * 
     * @param Ddth_Dao_DaoFactory
     */
    public function init($daoFactory) {
        $this->daoFactory = $daoFactory;
    }

    /**
     * Gets the DaoFactory instance.
     * 
     * @return Ddth_Dao_DaoFactory
     */
    protected function getDaoFactory() {
        return $this->daoFactory;
    }
}
?>