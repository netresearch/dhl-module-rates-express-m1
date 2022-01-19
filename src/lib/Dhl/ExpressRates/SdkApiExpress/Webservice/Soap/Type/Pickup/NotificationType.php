<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Webservice\Soap\Type\Pickup;

/**
 * NotificationType class.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class NotificationType
{
    const CLASSNAME = __CLASS__;

    /**
     * @var string
     */
    protected $Message;

    /**
     * @var int
     */
    protected $code;

    /**
     * @param string $Message
     * @param int $code
     */
    public function __construct($Message, $code)
    {
        $this->Message = $Message;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->Message;
    }

    /**
     * @param string $Message
     * @return self
     */
    public function setMessage($Message)
    {
        $this->Message = $Message;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}
