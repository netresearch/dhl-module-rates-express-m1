<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\Packages\RequestedPackages;

use Dhl\Express\Webservice\Soap\ValueInterface;

/**
 * The weight of the package.
 *
 * !!! This differs from the RateRequest->Weight
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class Weight implements ValueInterface
{
    /**
     * The value.
     *
     * @var float
     */
    private $value;

    /**
     * Constructor.
     *
     * @param float $value The value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the value as string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}
