<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\InternationalDetail;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The export Reference field, appears on label.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class ExportReference extends AlphaNumeric
{
    const MIN_LENGTH = 0;
    const MAX_LENGTH = 40;
}
