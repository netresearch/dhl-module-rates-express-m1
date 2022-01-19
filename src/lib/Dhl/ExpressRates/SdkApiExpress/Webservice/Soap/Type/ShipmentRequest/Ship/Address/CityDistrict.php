<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\Ship\Address;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The city district type.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class CityDistrict extends AlphaNumeric
{
    const MAX_LENGTH = 35;
}
