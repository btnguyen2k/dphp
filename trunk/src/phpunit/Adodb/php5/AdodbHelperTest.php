<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for AdodbHelper.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.1.2
 */

/**
 */
class AdodbHelperTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests functionality of Ddth::Adodb::AdodbHelper::buildArrayParams().
     */
    public function testBuildArrayParams() {
        $expected = '?';
        $result = Ddth_Adodb_AdodbHelper::buildArrayParams();
        $this->assertEquals($expected, $result);

        $expected = '?,?,?';
        $result = Ddth_Adodb_AdodbHelper::buildArrayParams(3);
        $this->assertEquals($expected, $result);
    }
}
?>
