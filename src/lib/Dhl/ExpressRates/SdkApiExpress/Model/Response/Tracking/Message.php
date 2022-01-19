<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Model\Response\Tracking;

use Dhl\Express\Api\Data\Response\Tracking\MessageInterface;

/**
 * Tracking message.
 *
 * @package  Dhl\Express\Model
 * @link     https://www.netresearch.de/
 */
class Message implements MessageInterface
{
    /**
     * @var int
     */
    private $time;

    /**
     * @var string
     */
    private $reference;

    /**
     * Message constructor.
     *
     * @param int    $time
     * @param string $reference
     */
    public function __construct($time, $reference)
    {
        $this->time = $time;
        $this->reference = $reference;
    }

    /**
     * Returns the messages time.
     *
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Returns the messages reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }
}
