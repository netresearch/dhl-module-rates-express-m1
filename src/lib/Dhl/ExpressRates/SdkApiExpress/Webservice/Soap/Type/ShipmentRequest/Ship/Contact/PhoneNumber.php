<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\Ship\Contact;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The phone number type.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class PhoneNumber extends AlphaNumeric
{
    const MAX_LENGTH = 25;
}
