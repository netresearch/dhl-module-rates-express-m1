<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap;

use Dhl\Express\Webservice\Soap\Type;

/**
 * SOAP Client Class Map.
 *
 * Map SOAP types to PHP classes.
 *
 * @package  Dhl\Express\Webservice
 * @link     https://www.netresearch.de/
 */
class ClassMap
{
    /**
     * Obtain SOAP types to PHP classes mapping for SOAP responses.
     *
     * @param string $request
     *
     * @return array|string[]
     */
    public static function get($request = '')
    {
        $classMap =  [
            // getRateRequest response
            'docTypeRef_NotificationType3' => Type\Common\Notification::CLASSNAME,
            'docTypeRef_RateResponseType'  => Type\SoapRateResponse::CLASSNAME,
            'docTypeRef_ProviderType'      => Type\RateResponse\Provider::CLASSNAME,
            'docTypeRef_ServiceType'       => Type\RateResponse\Provider\Service::CLASSNAME,
            'docTypeRef_TotalNetType'      => Type\RateResponse\Provider\Service\TotalNet::CLASSNAME,
            'docTypeRef_ChargesType'       => Type\RateResponse\Provider\Service\Charges::CLASSNAME,
            'docTypeRef_ChargeType'        => Type\RateResponse\Provider\Service\Charges\Charge::CLASSNAME,

            // createShipmentRequest response
            'docTypeRef_NotificationType2'   => Type\Common\Notification::CLASSNAME,
            'docTypeRef_ShipmentDetailType'  => Type\SoapShipmentResponse::CLASSNAME,
            'docTypeRef_PackagesResultsType' => Type\ShipmentResponse\PackagesResults::CLASSNAME,
            'docTypeRef_PackageResultType'   => Type\ShipmentResponse\PackagesResults\PackageResult::CLASSNAME,
            'docTypeRef_LabelImageType'      => Type\ShipmentResponse\LabelImage::CLASSNAME,

            // trackShipmentRequest
            'ServiceHeader' => Type\Tracking\ServiceHeader::CLASSNAME,
            'TrackingResponse' => Type\Tracking\TrackingResponse::CLASSNAME,
            'Response' => Type\Tracking\Response::CLASSNAME,
            'AWBInfo' => Type\Tracking\AWBInfo::CLASSNAME,
            'Status' => Type\Tracking\Status::CLASSNAME,
            'Condition' => Type\Tracking\Condition::CLASSNAME,
            'ArrayOfCondition' => Type\Tracking\ConditionCollection::CLASSNAME,
            'ShipmentInfo' => Type\Tracking\ShipmentInfo::CLASSNAME,
            'OriginServiceArea' => Type\Tracking\OriginServiceArea::CLASSNAME,
            'DestinationServiceArea' => Type\Tracking\DestinationServiceArea::CLASSNAME,
            'ShipmentEvent' => Type\Tracking\ShipmentEvent::CLASSNAME,
            'ServiceEvent' => Type\Tracking\ServiceEvent::CLASSNAME,
            'ServiceArea' => Type\Tracking\ServiceArea::CLASSNAME,
            'ArrayOfShipmentEvent' => Type\Tracking\ShipmentEventCollection::CLASSNAME,
            'Reference' => Type\Tracking\Reference::CLASSNAME,
            'TrackingPieces' => Type\Tracking\TrackingPieces::CLASSNAME,
            'PieceInfo' => Type\Tracking\PieceInfo::CLASSNAME,
            'PieceDetails' => Type\Tracking\PieceDetails::CLASSNAME,
            'PieceEvent' => Type\Tracking\PieceEvent::CLASSNAME,
            'ArrayOfPieceEvent' => Type\Tracking\PieceEventCollection::CLASSNAME,
            'ArrayOfPieceInfo' => Type\Tracking\PieceInfoCollection::CLASSNAME,
            'ArrayOfAWBInfo' => Type\Tracking\AWBInfoCollection::CLASSNAME,
            'Fault' => Type\Tracking\Fault::CLASSNAME,
            'PieceFault' => Type\Tracking\PieceFault::CLASSNAME,
            'ArrayOfPieceFault' => Type\Tracking\PieceFaultCollection::CLASSNAME,
            'trackShipmentRequestResponse' => Type\SoapTrackingResponse::CLASSNAME,
            'pubTrackingResponse' => Type\Tracking\TrackingResponseBase::CLASSNAME,
            'ShipperReference' => Type\Tracking\ShipperReference::CLASSNAME,

            // deleteShipmentRequest response
            'docTypeRef_DeleteResponseType' => Type\SoapShipmentDeleteResponse::CLASSNAME,
            'docTypeRef_NotificationType'   => Type\Common\Notification::CLASSNAME,
        ];

        if ($request === 'PickUpRequest') {
            $classMap['docTypeRef_ShipmentDetailType'] = Type\SoapPickupResponse::CLASSNAME;
            $classMap['docTypeRef_NotificationType2'] = Type\Pickup\NotificationType::CLASSNAME;
        }

        return $classMap;
    }
}
