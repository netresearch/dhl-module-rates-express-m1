<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Api\Data\Request\Pickup;

/**
 * Shipper Interface.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface ShipperInterface
{
    /**
     * Returns the shippers account number.
     *
     * @return int
     */
    public function getAccount();

    /**
     * Returns the shippers name.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the shippers company.
     *
     * @return string
     */
    public function getCompany();

    /**
     * Returns the shippers phone number.
     *
     * @return string
     */
    public function getPhone();

    /**
     * Returns the shippers street lines.
     *
     * @return string[]
     */
    public function getStreetLines();

    /**
     * Returns the shippers city.
     *
     * @return string
     */
    public function getCity();

    /**
     * Returns the shippers postal code.
     *
     * @return string
     */
    public function getPostalCode();

    /**
     * Returns the shippers country code.
     *
     * @return string
     */
    public function getCountryCode();
}
