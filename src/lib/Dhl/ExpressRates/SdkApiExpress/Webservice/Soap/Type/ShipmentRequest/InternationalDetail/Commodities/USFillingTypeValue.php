<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\InternationalDetail\Commodities;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The US filling type value for shipments from the US.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class USFillingTypeValue extends AlphaNumeric
{
    const MAX_LENGTH = 20;
}
