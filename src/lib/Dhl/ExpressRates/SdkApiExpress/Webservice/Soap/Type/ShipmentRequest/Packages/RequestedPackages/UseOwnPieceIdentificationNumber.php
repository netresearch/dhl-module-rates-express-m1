<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\Type\ShipmentRequest\Packages\RequestedPackages;

use Dhl\Express\Webservice\Soap\Type\Common\YesNo;

/**
 * The use own piece identification number flag.
 *
 * Y = allows you to define your own PieceID in the tag below
 * N = Auto-allocates the PieceID from DHL Express
 *
 * You can request your own Piece ID range from your DHL Express IT consultant and store these locally in your
 * integration however this is not needed as if you leave this tag then DHL will automatically assign the piece
 * ID centrally.
 *
 * In addition this special function needs to be enabled for your username by your DHL Express IT Consultant.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
class UseOwnPieceIdentificationNumber extends YesNo
{
}
