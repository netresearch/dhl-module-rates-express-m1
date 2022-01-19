<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\Ship\Contact;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The mobile phone number type.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class MobilePhoneNumber extends AlphaNumeric
{
    const MAX_LENGTH = 25;
}
