<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\OnDemandDeliveryOptions;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * Entry code to gain access to an apartment complex or gate.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class GateCode extends AlphaNumeric
{
    const MAX_LENGTH = 10;
}
