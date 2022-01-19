<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\InternationalDetail\Commodities;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The description of the content of the shipment.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class Description extends AlphaNumeric
{
    const MAX_LENGTH = 35;
}
