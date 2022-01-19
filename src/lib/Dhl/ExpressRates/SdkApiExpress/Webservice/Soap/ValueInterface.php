<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap;

/**
 * Interface for value object.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface ValueInterface
{
    /**
     * Returns the value object as string.
     *
     * @return string
     */
    public function __toString();
}
