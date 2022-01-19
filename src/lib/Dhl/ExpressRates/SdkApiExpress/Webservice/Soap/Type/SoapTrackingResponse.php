<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Webservice\Soap\Type;

use Dhl\Express\Webservice\Soap\Type\Tracking\TrackingResponseBase;

/**
 * The tracking response.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class SoapTrackingResponse
{
    const CLASSNAME = __CLASS__;

    /**
     * @var TrackingResponseBase
     */
    protected $trackingResponse;

    /**
     * @return TrackingResponseBase
     */
    public function getTrackingResponse()
    {
        return $this->trackingResponse;
    }

    /**
     * @param TrackingResponseBase $trackingResponse
     * @return self
     */
    public function setTrackingResponse(TrackingResponseBase $trackingResponse)
    {
        $this->trackingResponse = $trackingResponse;
        return $this;
    }
}
