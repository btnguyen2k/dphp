<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test suite bootstrap for Mls.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author		Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version		$Id$
 * @since		File available since v0.1
 */

define('PACKAGE', 'Mls');
$REQUIRED_PACKAGES = Array();
$EXTRA_INCLUDE_PATHS = Array();

$DPHP_COMMONS_LOGGING_CONFIG = Array(
    'ddth.commons.logging.Logger' => 'Ddth_Commons_Logging_ConsoleLog',
    'logger.setting.default' => 'ERROR'
);

$DPHP_MLS_CONFIG = Array(
    'languages'              => 'default, vn',
    'language.class'         => 'Ddth_Mls_FileLanguage',
    'language.baseDirectory' => '.',

    'language.default.displayName' => 'Default',
    'language.default.description' => 'This is the default language pack',
    'language.default.location'    => 'langDefault',

    'language.vn.displayName' => 'Vietnamese',
    'language.vn.description' => 'This is the Vietnamese language pack',
    'language.vn.location'    => 'langVn'
);

require '../../php5/Template_AllTest.php';
?>
