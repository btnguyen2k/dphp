<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Defines the "autoload" function to load dPHP's classes.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @copyright   2008-2010 DDTH.ORG
 * @version     $Id: ClassDefaultClassNameTranslator.php 222 2010-11-21 07:25:10Z btnguyen2k@gmail.com $
 */

/**
 * Usage: <code>include_once("autoload.php");</code>.
 * That's it!
 */

if ( !function_exists('__autoload') ) {
    /**
     * Automatically loads class source file when used.
     *
     * @param string
     * @ignore
     */
    function __autoload($className) {
        require_once 'Ddth/Commons/ClassDefaultClassNameTranslator.php';
        require_once 'Ddth/Commons/ClassLoader.php';
        $translator = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        Ddth_Commons_Loader::loadClass($className, $translator);
    }
}
?>
