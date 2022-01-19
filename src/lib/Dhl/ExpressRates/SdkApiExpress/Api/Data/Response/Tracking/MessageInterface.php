<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Api\Data\Response\Tracking;

/**
 * Tracking Message interface.
 *
 * DTO that Tracking information's message.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface MessageInterface
{
    /**
     * Returns the messages time.
     *
     * @return int
     */
    public function getTime();

    /**
     * Returns the messages reference.
     *
     * @return string
     */
    public function getReference();
}
