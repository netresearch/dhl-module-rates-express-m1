<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Model\Request\Rate;

use Dhl\Express\Api\Data\Request\Rate\PackageInterface;

/**
 * Package.
 *
 * @package  Dhl\Express\Model
 * @link     https://www.netresearch.de/
 */
class Package implements PackageInterface
{
    /**
     * Units of measurement (weight).
     */
    const UOM_WEIGHT_KG = 'KG';
    const UOM_WEIGHT_G  = 'G';
    const UOM_WEIGHT_OZ = 'OZ';
    const UOM_WEIGHT_LB = 'LB';

    /**
     * Units of measurement (dimension).
     */
    const UOM_DIMENSION_CM = 'CM';
    const UOM_DIMENSION_IN = 'IN';
    const UOM_DIMENSION_MM = 'MM';
    const UOM_DIMENSION_M  = 'M';
    const UOM_DIMENSION_FT = 'FT';
    const UOM_DIMENSION_YD = 'YD';

    /**
     * The number of the package in the list of all packages.
     *
     * @var int
     */
    private $sequenceNumber;

    /**
     * The weight of the package.
     *
     * @var float
     */
    private $weight;

    /**
     * The length of the package.
     *
     * @var float
     */
    private $length;

    /**
     * The width of the package.
     *
     * @var float
     */
    private $width;

    /**
     * The height of the package.
     *
     * @var float
     */
    private $height;

    /**
     * The unit of measurement for the package dimensions.
     *
     * @var string
     */
    private $dimensionsUOM;

    /**
     * The unit of measurement for the package weight.
     *
     * @var string
     */
    private $weightUOM;

    /**
     * Constructor.
     *
     * @param int    $sequenceNumber The number of the package
     * @param float  $weight         The package weight
     * @param string $weightUOM      The unit of measurement for the package weight
     * @param float  $length         The package length
     * @param float  $width          The package width
     * @param float  $height         The package height
     * @param string $dimensionsUOM  The unit of measurement for the package dimensions
     */
    public function __construct(
        $sequenceNumber,
        $weight,
        $weightUOM,
        $length,
        $width,
        $height,
        $dimensionsUOM
    ) {
        $weightUOMs = [
            self::UOM_WEIGHT_KG,
            self::UOM_WEIGHT_G,
            self::UOM_WEIGHT_OZ,
            self::UOM_WEIGHT_LB,
        ];

        $dimensionUOMs = [
            self::UOM_DIMENSION_M,
            self::UOM_DIMENSION_CM,
            self::UOM_DIMENSION_MM,
            self::UOM_DIMENSION_IN,
            self::UOM_DIMENSION_YD,
            self::UOM_DIMENSION_FT,
        ];

        if (!\in_array($weightUOM, $weightUOMs, true)) {
            throw new \InvalidArgumentException('The weight UOM must be one of ' . implode(', ', $weightUOMs));
        }

        if (!\in_array($dimensionsUOM, $dimensionUOMs, true)) {
            throw new \InvalidArgumentException('The dimension UOM must be one of ' . implode(', ', $dimensionUOMs));
        }

        $this->sequenceNumber = $sequenceNumber;
        $this->weight         = $weight;
        $this->weightUOM      = $weightUOM;
        $this->length         = $length;
        $this->width          = $width;
        $this->height         = $height;
        $this->dimensionsUOM  = $dimensionsUOM;
    }

    /**
     * @inheritdoc
     */
    public function getSequenceNumber()
    {
        return $this->sequenceNumber;
    }

    /**
     * @inheritdoc
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @inheritdoc
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @inheritdoc
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @inheritdoc
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @inheritdoc
     */
    public function getDimensionsUOM()
    {
        return $this->dimensionsUOM;
    }

    /**
     * @inheritdoc
     */
    public function getWeightUOM()
    {
        return $this->weightUOM;
    }
}
