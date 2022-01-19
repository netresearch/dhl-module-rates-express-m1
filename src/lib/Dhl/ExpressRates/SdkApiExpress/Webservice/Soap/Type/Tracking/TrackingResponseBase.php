<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Webservice\Soap\Type\Tracking;

/**
 * TrackingResponseBase class.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class TrackingResponseBase
{
    const CLASSNAME = __CLASS__;

    /**
     * @var TrackingResponse
     */
    protected $TrackingResponse;

    /**
     * @param TrackingResponse $TrackingResponse
     */
    public function __construct(TrackingResponse $TrackingResponse)
    {
        $this->TrackingResponse = $TrackingResponse;
    }

    /**
     * @return TrackingResponse
     */
    public function getTrackingResponse()
    {
        return $this->TrackingResponse;
    }

    /**
     * @param TrackingResponse $TrackingResponse
     * @return self
     */
    public function setTrackingResponse(TrackingResponse $TrackingResponse)
    {
        $this->TrackingResponse = $TrackingResponse;

        return $this;
    }
}
