<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Ddth::Commons::Loader.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.1
 */

/**
 */
class LoaderTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests DefaultClassNameTranslator's functionality.
     */
    public function testDefaultClassNameTranslator() {
        require_once 'Ddth/Commons/ClassDefaultClassNameTranslator.php';
        $instance = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        $this->assertNotNull($instance, "Can not get instance of class Ddth_Commons_DefaultClassNameTranslator");

        $filename = $instance->translateClassNameToFileName("Ddth_Commons_DefaultClassNameTranslator");
        $this->assertEquals("Ddth/Commons/ClassDefaultClassNameTranslator.php", $filename, "Class name to file name translation failed!");
    }
}
?>