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

define('PACKAGE', 'Template');
$REQUIRED_PACKAGES = Array();
$EXTRA_INCLUDE_PATHS = Array('/libs/Smarty-2.6.19');

$DPHP_COMMONS_LOGGING_CONFIG = Array(
    'ddth.commons.logging.Logger' => 'Ddth_Commons_Logging_ConsoleLog',
    'logger.setting.default' => 'ERROR'
);

$DPHP_TEMPLATE_CONFIG = Array(
    'factory.class' => 'Ddth_Template_BaseTemplateFactory',
	'templates' => 'smarty, php',
    'template.baseDirectory' => '.',

    'template.smarty.class' => 'Ddth_Template_Smarty_SmartyTemplate',
    'template.smarty.pageClass' => 'Ddth_Template_Smarty_SmartyPage',
    'template.smarty.displayName' => 'Smarty template',
    'template.smarty.description' => 'Smarty-based template pack',
	'template.smarty.location' => 'templateSmarty',
    'template.smarty.configFile' => 'config.properties',
    'template.smarty.charset' => 'utf-8',
    'template.smarty.smarty.configs' => '.',
    'template.smarty.smarty.cache' => 'cache',
    'template.smarty.smarty.compile' => 'compile',

	'template.php.class' => 'Ddth_Template_Php_PhpTemplate',
    'template.php.pageClass' => 'Ddth_Template_Php_PhpPage',
    'template.php.displayName' => 'PHP template',
    'template.php.description' => 'PHP-based template pack',
	'template.php.location' => 'templatePhp',
    'template.php.configFile' => 'config.properties',
    'template.php.charset' => 'utf-8'
);

require '../../php5/Template_AllTest.php';
?>
