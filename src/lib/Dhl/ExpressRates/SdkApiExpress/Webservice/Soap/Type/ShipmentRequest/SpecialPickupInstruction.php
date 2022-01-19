<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * This node details special pickup instructions you may wish to send to the DHL Courier.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class SpecialPickupInstruction extends AlphaNumeric
{
    const MAX_LENGTH = 75;
}
