<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class ADhl_ExpressRates_Model_Method_AdditionalInfo
 *
 * @package Dhl\ExpressRates\Model\Method
 * @author Paul Siedler <paul.siedler@netresearch.de>
 * @copyright 2018 Netresearch GmbH & Co. KG
 * @link http://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Method_AdditionalInfo extends Varien_Object
{
    const ATTRIBUTE_KEY = 'additional_info';
    const DELIVERY_DATE = 'delivery_date';

    /**
     * @return string
     */
    public function getDeliveryDate()
    {
        return (string)$this->getData(self::DELIVERY_DATE);
    }

    /**
     * @param string $deliveryDate
     * @return void
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->setData(self::DELIVERY_DATE, $deliveryDate);
    }
}
