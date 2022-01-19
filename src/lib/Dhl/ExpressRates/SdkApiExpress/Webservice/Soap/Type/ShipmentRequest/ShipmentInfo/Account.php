<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\ShipmentInfo;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * A shipment info account.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class Account extends AlphaNumeric
{
    const MIN_LENGTH = 0;
    const MAX_LENGTH = 12;
}
