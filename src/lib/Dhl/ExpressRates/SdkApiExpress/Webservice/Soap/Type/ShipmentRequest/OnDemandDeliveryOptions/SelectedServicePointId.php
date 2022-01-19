<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\OnDemandDeliveryOptions;

use Dhl\Express\Webservice\Soap\Type\Common\AlphaNumeric;

/**
 * The selected service point id.
 *
 * Mandatory if delivery option is TV – this is the unique DHL Express Service point location ID of where the
 * parcel should be delivered (please contact your local DHL Express Account Manager to obtain the list of
 * the service point IDs).
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class SelectedServicePointId extends AlphaNumeric
{
    const MAX_LENGTH = 6;
}
