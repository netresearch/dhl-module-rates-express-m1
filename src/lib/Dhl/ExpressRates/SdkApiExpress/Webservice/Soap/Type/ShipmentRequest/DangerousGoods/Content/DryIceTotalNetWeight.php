<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\DangerousGoods\Content;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The dry ice total net weight.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class DryIceTotalNetWeight extends AlphaNumeric
{
    const MAX_LENGTH = 7;
}
