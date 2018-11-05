<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Rate_PickupTime
 *
 * @package Dhl\ExpressRates\Model\Rate
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Rate_PickupTime
{
    /**
     * The module configuration.
     *
     * @var Dhl_ExpressRates_Model_Config
     */
    private $moduleConfig;

    /**
     * @var Mage_Core_Model_Date
     */
    private $date;

    /**
     * PickupTime constructor.
     */
    public function __construct()
    {
        $this->moduleConfig = Mage::getSingleton('dhl_expressrates/config');
        $this->date         = Mage::getSingleton('core/date');
    }

    /**
     * Returns the timestamp when the offer is ready. When the current time is after today's cut off time,
     * tomorrows cut off time will be returned. If it's not, today's cut off time will be returned.
     *
     * @return int
     */
    public function getReadyAtTimestamp()
    {
        $cutOffTimeRaw = explode(',', $this->moduleConfig->getCutOffTime());
        $pickUpTimeRaw = explode(',', $this->moduleConfig->getPickupTime());

        $cutOffTime = new \DateTime($this->date->date());
        $cutOffTime->setTime((int) $cutOffTimeRaw[0], (int) $cutOffTimeRaw[1], (int) $cutOffTimeRaw[2]);

        $pickUpTime = new \DateTime($this->date->date());
        $pickUpTime->setTime((int) $pickUpTimeRaw[0], (int) $pickUpTimeRaw[1], (int) $pickUpTimeRaw[2]);

        if ($this->date->timestamp() >= $cutOffTime->getTimestamp()) {
            $pickUpTime->modify('+1 day');
        }

        return $pickUpTime->getTimestamp();
    }
}
