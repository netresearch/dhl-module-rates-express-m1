<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Api\Data\Response\Tracking\TrackingInfo;

/**
 * ShipmentInfo interface.
 *
 * DTO that Tracking information's shipment info.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface ShipmentDetailsInterface
{
    /**
     * Returns the shipper's name
     *
     * @return string
     */
    public function getShipperName();

    /**
     * Returns the consignee's name
     *
     * @return string
     */
    public function getConsigneeName();

    /**
     * Returns the shipment's date
     *
     * @return string
     */
    public function getShipmentDate();

    /**
     * @return string
     */
    public function getOriginDescription();

    /**
     * @return string
     */
    public function getDestinationDescription();

    /**
     * @return float
     */
    public function getWeight();

    /**
     * @return string
     */
    public function getEstimatedDeliveryDate();
}
