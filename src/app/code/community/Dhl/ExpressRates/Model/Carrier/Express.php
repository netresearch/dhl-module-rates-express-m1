<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Carrier_Express
 *
 * @package Dhl\ExpressRates\Model
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Carrier_Express
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    const CODE = 'dhlexpress';

    /**
     * @var string
     */
    protected $_code = self::CODE;

    /**
     * @var Dhl_ExpressRates_Model_Rate_CheckoutProvider
     */
    protected $rateProvider;

    /**
     * Dhl_ExpressRates_Model_Carrier_Express constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->rateProvider = Mage::getSingleton('dhl_expressrates/rate_checkoutProvider');
    }

    /**
     * @inheritDoc
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        return $this->rateProvider->getRates($request);
    }

    /**
     * This is only used in sales rules.
     * @see \Mage_SalesRule_Model_Rule_Condition_Address::getValueSelectOptions
     *
     * todo(nr): return the methods enabled via config ("offered products")
     * @link https://bugs.nr/DHLEX-16
     *
     * @inheritDoc
     */
    public function getAllowedMethods()
    {
        // code => title
        return array();
    }

}
