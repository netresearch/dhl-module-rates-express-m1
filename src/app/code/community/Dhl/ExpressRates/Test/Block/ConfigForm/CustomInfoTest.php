<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Block_ConfigForm_CustomInfoTest
 *
 * @package Dhl\ExpressRates\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Block_ConfigForm_CustomInfoTest extends \EcomDev_PHPUnit_Test_Case
{
    const BLOCK_ALIAS = 'dhl_expressrates/adminhtml_system_config_custominformation';

    protected function setUp()
    {
        parent::setUp();

        Mage::app()->getStore()->setConfig(\Mage_Core_Block_Template::XML_PATH_TEMPLATE_ALLOW_SYMLINK, '1');

        $this->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        Mage::getDesign()->setArea('adminhtml');
    }

    /**
     * @test
     */
    public function getModuleVersion()
    {
        /** @var \Dhl_ExpressRates_Block_Adminhtml_System_Config_Custominformation $block */
        $block = Mage::app()->getLayout()->createBlock(self::BLOCK_ALIAS);
        $moduleVersion = $block->getModuleVersion();
        $this->assertRegExp('/[\d]+\.[\d]+\.[\d]+/', $moduleVersion);
    }

    /**
     * @test
     */
    public function getLogoUrl()
    {
        /** @var \Dhl_ExpressRates_Block_Adminhtml_System_Config_Custominformation $block */
        $block = Mage::app()->getLayout()->createBlock(self::BLOCK_ALIAS);
        $logoUrl = $block->getLogoUrl();
        $this->assertInternalType('string', $logoUrl);
        $this->assertStringEndsWith('logo.svg', $logoUrl);
    }

    /**
     * @test
     */
    public function renderInfoField()
    {
        /** @var \Dhl_ExpressRates_Block_Adminhtml_System_Config_Custominformation $block */
        $block = Mage::app()->getLayout()->createBlock(self::BLOCK_ALIAS);
        $this->assertInstanceOf('Mage_Adminhtml_Block_System_Config_Form_Field', $block);

        $element = new Varien_Data_Form_Element_Text(array('frontend_model' => self::BLOCK_ALIAS));
        $infoHtml = $block->render($element);
        $this->assertContains('dhl-express-custom-info', $infoHtml);
    }
}
