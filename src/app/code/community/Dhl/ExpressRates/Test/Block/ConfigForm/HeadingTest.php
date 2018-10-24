<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Block_ConfigForm_HeadingTest
 *
 * @package Dhl\ExpressRates\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Block_ConfigForm_HeadingTest extends \EcomDev_PHPUnit_Test_Case
{
    const BLOCK_ALIAS = 'dhl_expressrates/adminhtml_system_config_heading';

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
    public function renderHeading()
    {
        $headingText = 'Foo Sub-Group';
        $headingComment = 'Foo Sub-Group Comment';

        /** @var \Dhl_ExpressRates_Block_Adminhtml_System_Config_Heading $block */
        $block = Mage::app()->getLayout()->createBlock(self::BLOCK_ALIAS);
        $this->assertInstanceOf('Mage_Adminhtml_Block_System_Config_Form_Field', $block);

        $element = new Varien_Data_Form_Element_Text(
            array(
                'frontend_model' => self::BLOCK_ALIAS,
                'label' => $headingText,
                'comment' => $headingComment,
            )
        );
        $element->setForm(new Varien_Data_Form());
        $headingHtml = $block->render($element);
        $this->assertContains("<h4>$headingText</h4>", $headingHtml);
        $this->assertContains("<p>$headingComment</p>", $headingHtml);
    }
}
