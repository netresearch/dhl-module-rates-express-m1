<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\TypeMapper;

use Dhl\Express\Api\Data\ShipmentDeleteResponseInterface;
use Dhl\Express\Exception\ShipmentDeleteRequestException;
use Dhl\Express\Model\ShipmentDeleteResponse;
use Dhl\Express\Webservice\Soap\Type\Common\Notification;
use Dhl\Express\Webservice\Soap\Type\SoapShipmentDeleteResponse;

/**
 * The shipment delete response mapper.
 *
 * Transform the SOAP response type into rate objects suitable for further processing.
 *
 * @package  Dhl\Express\Webservice
 * @link     https://www.netresearch.de/
 */
class ShipmentDeleteResponseMapper
{
    /**
     * Maps the SOAP response type to the API response type.
     *
     * @param SoapShipmentDeleteResponse $shipmentDeleteResponse
     *
     * @return ShipmentDeleteResponseInterface
     * @throws ShipmentDeleteRequestException
     */
    public function map(SoapShipmentDeleteResponse $shipmentDeleteResponse)
    {
        $notification = $shipmentDeleteResponse->getNotification();
        if (\is_array($notification) && !empty($notification)) {
            /** @var Notification $notification */
            $notification = current($notification);
        }

        if ($notification->isError()) {
            throw new ShipmentDeleteRequestException($notification->getMessage(), $notification->getCode());
        }

        return new ShipmentDeleteResponse(
            $shipmentDeleteResponse->getNotification()->getMessage(),
            $shipmentDeleteResponse->getNotification()->getCode()
        );
    }
}
