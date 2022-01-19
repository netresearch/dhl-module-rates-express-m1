<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Webservice\Soap\Type\Tracking;

/**
 * Fault class.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class Fault
{
    const CLASSNAME = __CLASS__;

    /**
     * @var PieceFaultCollection
     */
    protected $PieceFault;

    /**
     * @param PieceFaultCollection $PieceFault
     */
    public function __construct(PieceFaultCollection $PieceFault)
    {
        $this->PieceFault = $PieceFault;
    }

    /**
     * @return PieceFaultCollection
     */
    public function getPieceFault()
    {
        return $this->PieceFault;
    }

    /**
     * @param PieceFaultCollection $PieceFault
     * @return self
     */
    public function setPieceFault(PieceFaultCollection $PieceFault)
    {
        $this->PieceFault = $PieceFault;

        return $this;
    }
}
