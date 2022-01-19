<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Api\Data;

use Dhl\Express\Api\Data\Request\Rate\ShipperAddressInterface;
use Dhl\Express\Api\Data\Request\Rate\RecipientAddressInterface;
use Dhl\Express\Api\Data\Request\Rate\ShipmentDetailsInterface;
use Dhl\Express\Api\Data\Request\Rate\PackageInterface;
use Dhl\Express\Api\Data\Request\InsuranceInterface;

/**
 * Rate Request Interface.
 *
 * DTO that carries relevant data for requesting shipping rates.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface RateRequestInterface
{
    /**
     * @return ShipperAddressInterface
     */
    public function getShipperAddress();

    /**
     * @return string
     */
    public function getShipperAccountNumber();

    /**
     * @return RecipientAddressInterface
     */
    public function getRecipientAddress();

    /**
     * @return ShipmentDetailsInterface
     */
    public function getShipmentDetails();

    /**
     * @return PackageInterface[]
     */
    public function getPackages();

    /**
     * @return InsuranceInterface|null
     */
    public function getInsurance();
}
