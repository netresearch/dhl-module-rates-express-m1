<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\Common\SpecialServices;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The text instruction of a service. Alpha numeric type with 50 characters.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class TextInstruction extends AlphaNumeric
{
    const MAX_LENGTH = 50;
}
