<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\DangerousGoods\Content;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The UN code.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class UNCode extends AlphaNumeric
{
    const MAX_LENGTH = 9999;
}
