<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Webservice\Soap\Type\Tracking;

/**
 * ServiceArea class.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class ServiceArea
{
    const CLASSNAME = __CLASS__;

    /**
     * @var string $ServiceAreaCode
     */
    protected $ServiceAreaCode;

    /**
     * @var string $Description
     */
    protected $Description;

    /**
     * @return string
     */
    public function getServiceAreaCode()
    {
        return $this->ServiceAreaCode;
    }

    /**
     * @param string $ServiceAreaCode
     *
     * @return self
     */
    public function setServiceAreaCode($ServiceAreaCode)
    {
        $this->ServiceAreaCode = $ServiceAreaCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     * @return self
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;

        return $this;
    }
}
