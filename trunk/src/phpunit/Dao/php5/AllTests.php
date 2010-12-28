<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test suite bootstrap for Adodb.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.1
 */

define('PACKAGE', 'Dao');
$REQUIRED_PACKAGES = Array('Adodb');
$EXTRA_INCLUDE_PATHS = Array('');

$DPHP_COMMONS_LOGGING_CONFIG = Array(
    'ddth.commons.logging.Logger' => 'Ddth_Commons_Logging_ConsoleLog',
    'logger.setting.default' => 'ERROR'
);

require '../../php5/Template_AllTest.php';
?>