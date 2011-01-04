<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Template.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author		Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version		$Id$
 * @since		File available since v0.1
 */

/**
 */
class TemplateTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creation of language factory
     */
    public function testObjCreation() {
        $obj1 = Ddth_Template_BaseTemplateFactory::getInstance();
        $this->assertNotNull($obj1, "Can not create template factory!");

        $obj2 = Ddth_Template_BaseTemplateFactory::getInstance();
        $this->assertNotNull($obj2, "Can not create language factory!");

        $this->assertTrue($obj1 === $obj2);
    }

    /**
     * Test retrieval of a template.
     */
    public function testGetTemplate() {
        $factory = Ddth_Template_BaseTemplateFactory::getInstance();
        $this->assertNotNull($factory, "Can not create template factory!");

        $templateList = $factory->getTemplateNames();
        $this->assertEquals(2, count($templateList));
        $this->assertEquals('smarty', $templateList[0]);
        $this->assertEquals('php', $templateList[1]);

        $template = $factory->getTemplate($templateList[0]);
        $this->assertTrue($template instanceof Ddth_Template_Smarty_SmartyTemplate);

        $template = $factory->getTemplate($templateList[1]);
        $this->assertTrue($template instanceof Ddth_Template_Php_PhpTemplate);
    }

    public function testTemplatePhp() {
        $factory = Ddth_Template_BaseTemplateFactory::getInstance();
        $this->assertNotNull($factory, "Can not create template factory!");

        $template = $factory->getTemplate('php');
        $this->assertTrue($template instanceof Ddth_Template_Php_PhpTemplate);

        $page = $template->getPage('index');
        $this->assertTrue($page instanceof Ddth_Template_Php_PhpPage);
        $model = Array('action' => 'index');
        ob_start();
        $page->render($model);
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertTrue(strpos($output, 'Action: index;') > -1);
    }

    public function testTemplateSmarty() {
        $factory = Ddth_Template_BaseTemplateFactory::getInstance();
        $this->assertNotNull($factory, "Can not create template factory!");

        $template = $factory->getTemplate('smarty');
        $this->assertTrue($template instanceof Ddth_Template_Smarty_SmartyTemplate);

        $page = $template->getPage('index');
        $this->assertTrue($page instanceof Ddth_Template_Smarty_SmartyPage);
        $model = Array('action' => 'index');
        ob_start();
        $page->render($model);
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertTrue(strpos($output, 'Action: index;') > -1);
    }
}
?>
