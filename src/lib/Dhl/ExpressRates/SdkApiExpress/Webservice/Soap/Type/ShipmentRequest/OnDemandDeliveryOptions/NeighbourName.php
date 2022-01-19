<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\OnDemandDeliveryOptions;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The neighbour name.
 *
 * Mandatory if the delivery option is SW and the LWNTypeCode is N (Neighbour) – this is where the name of
 * the neighbour is required.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class NeighbourName extends AlphaNumeric
{
    const MAX_LENGTH = 20;
}
