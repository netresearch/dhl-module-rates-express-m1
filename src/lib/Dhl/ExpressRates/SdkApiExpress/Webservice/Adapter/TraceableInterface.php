<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Webservice\Adapter;

/**
 * Traceable Adapter Interface.
 *
 * Adapters provide tracing capability, i.e. they record their latest requests and responses.
 *
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface TraceableInterface
{
    /**
     * @return string
     */
    public function getLastRequest();

    /**
     * @return string
     */
    public function getLastResponse();
}
