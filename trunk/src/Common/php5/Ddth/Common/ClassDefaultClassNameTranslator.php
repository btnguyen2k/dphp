<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Default inplementation of interface {@link Ddth_Common_IClassNameTranslator}.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @category	Common
 * @package		Ddth
 * @subpackage	Common
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1
 */

require_once 'ClassIClassNameTranslator.php';

/**
 * Default inplementation of interface {@link Ddth_Common_IClassNameTranslator}.
 *
 * This class implements interface {@link Ddth_Common_IClassNameTranslator} with the
 * following translating rule:
 *
 * <ul>
 * 	<li>Class name format: <i>Package1_Package2_Package3_ClazzName</i>.
 * 	<li>Translated file name: <i>Package1/Package2/Package3/ClassClazzName.php</i>
 * 	<li>Example: class <i>Ddth_Common_DefaultClassNameTranslator</i> will be
 * 		translated to file <i>Ddth/Common/ClassDefaultClassNameTranslator.php</i>
 * </ul>
 *
 * @package    	Ddth
 * @subpackage	Common
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @since      	Class available since v0.1
 */
final class Ddth_Common_DefaultClassNameTranslator implements Ddth_Common_IClassNameTranslator {
    private static $instance;

    private function __construct() {
        //singleton
    }

    /**
     * Gets an instance of Ddth_Common_DefaultClassNameTranslator class.
     *
     * @return Ddth_Common_DefaultClassNameTranslator
     */
    public static function getInstance() {
        if ( !is_object(Ddth_Common_DefaultClassNameTranslator::$instance) ) {
            Ddth_Common_DefaultClassNameTranslator::$instance =
                new Ddth_Common_DefaultClassNameTranslator();
        }
        return Ddth_Common_DefaultClassNameTranslator::$instance;
    }

    /**
     * @see Ddth_Common_IClassNameTranslator::translateClassNameToFileName()
     */
    public function translateClassNameToFileName($className) {
        return $className;
    }
}
?>