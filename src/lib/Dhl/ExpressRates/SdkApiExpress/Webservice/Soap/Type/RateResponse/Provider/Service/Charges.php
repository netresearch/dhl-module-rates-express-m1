<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\RateResponse\Provider\Service;

use Dhl\Express\Webservice\Soap\Type\RateResponse\Provider\Service\Charges\Charge;

/**
 * The list of charges section.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class Charges
{
    const CLASSNAME = __CLASS__;

    /**
     * This the currency for all line item charges listed in the Charge section
     *
     * @var string
     */
    private $Currency;

    /**
     * List of charge sections.
     *
     * @var array|Charge[]
     */
    private $Charge;

    /**
     * The currency type the total is expressed in.
     *
     * Possible values:
     * - ‘BILLC’, billing currency
     * - ‘PULCL’, country public rates currency
     * - ‘BASEC’, base currency
     *
     * @var string $type
     */
    protected $type = '';

    /**
     * Returns the currency of all charges.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->Currency;
    }

    /**
     * Returns list of charge sections.
     *
     * @return array|Charge[]
     */
    public function getCharge()
    {
        return $this->Charge;
    }

    /**
     * Returns the currency type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
