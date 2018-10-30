<?php
/**
 * See LICENSE.md for license details.
 */

use Dhl\Express\Api\Data\RateResponseInterface;
use Dhl\Express\Model\Response\Rate\Rate;

/**
 * Class Dhl_ExpressRates_Model_Webservice_Rate_ResponseDataMapper
 *
 * @package Dhl\ExpressRates\Model|Webservice\Rate
 * @author Paul Siedler <paul.siedler@netresearch.de>
 * @copyright 2018 Netresearch GmbH & Co. KG
 * @link http://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Webservice_Rate_ResponseDataMapper
{
    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    private $moduleConfig;

    /**
     * @var Mage_Core_Model_Locale
     */
    protected $timeFormatter;

    /**
     * @var Mage_Directory_Model_Currency
     */
    protected $currencyModel;


    public function __construct()
    {
        $this->moduleConfig = Mage::getModel('dhl_expressrates/config');
        $this->timeFormatter = Mage::app()->getLocale();
        $this->currencyModel = Mage::getModel('directory/currency');
    }

    /**
     * @param RateResponseInterface $rateResponse
     * @return array Mage_Shipping_Model_Rate_Result_Method
     * @throws Mage_Core_Model_Store_Exception
     */
    public function mapResult(RateResponseInterface $rateResponse)
    {
        $result = array();

        /** @var Rate $rate */
        foreach ($rateResponse->getRates() as $rate) {
            $priceInBaseCurrency = $this->convertPriceToCurrency($rate->getAmount(), $rate->getCurrencyCode());
            
            $result[] = Mage::getModel('shipping/rate_result_method', array(
                    'data' => array(
                        'carrier' => Dhl_ExpressRates_Model_Carrier_Express::CODE,
                        'carrier_title' => $this->moduleConfig->getTitle(),
                        'method' => $rate->getServiceCode(),
                        'method_title' => $rate->getLabel(),
                        'price' => $priceInBaseCurrency,
                        'cost' => $priceInBaseCurrency,

                        // Pass delivery date through the method description
                        Dhl_ExpressRates_Model_Method_AdditionalInfo::ATTRIBUTE_KEY =>
                            $this->getMethodAdditionalInformation($rate)
                    ),
                )
            );
        }

        return $result;
    }

    /**
     * Returns the formatted delivery date based on the current locale.
     *
     * @param \DateTime $dateTime The date/time object to format
     *
     * @return string
     */
    private function getFormattedDeliveryDate(\DateTime $dateTime)
    {
        $format = $this->timeFormatter->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);

        return $this->timeFormatter->date($dateTime, $format, null, false)->toString($format);
    }

    /**
     * @param float $value
     * @param string $inputCurrencyCode
     * @return float
     * @throws Mage_Core_Model_Store_Exception
     */
    private function convertPriceToCurrency($value, $inputCurrencyCode)
    {
        /** @var string $baseCurrencyCode */
        $baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();

        if ($inputCurrencyCode === $baseCurrencyCode || $inputCurrencyCode === '') {
            return $value;
        }

        try {
            return $this->currencyModel->convert($value, $baseCurrencyCode);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("The given currency code $inputCurrencyCode is not valid.");
        }
    }

    /**
     * @param Rate $rate
     * @return Varien_Object
     */
    private function getMethodAdditionalInformation(Rate $rate)
    {
        $data = array();
        /** not implemented yet */
        /**
        if ($this->moduleConfig->isCheckoutDeliveryTimeEnabled()) {
            $deliveryDate = $this->getFormattedDeliveryDate($rate->getDeliveryTime());
            $data[Dhl_ExpressRates_Model_Method_AdditionalInfo::DELIVERY_DATE] = $deliveryDate;
        }
        */
        $additionalInformation = new Varien_Object();
        $additionalInformation->setData($data);

        return $additionalInformation;
    }
}
