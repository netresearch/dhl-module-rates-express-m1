<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\OnDemandDeliveryOptions;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The requested delivery date.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class RequestedDeliveryDate extends AlphaNumeric
{
    const MAX_LENGTH = 29;
}
