<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\OnDemandDeliveryOptions;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The name of the authorized person.
 *
 * Mandatory if delivery option is SX or SW– this is the person that this authorised to sign and receive
 * the DHL Express shipment.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class AuthorizerName extends AlphaNumeric
{
    const MAX_LENGTH = 20;
}
