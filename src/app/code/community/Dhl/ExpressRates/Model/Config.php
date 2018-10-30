<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Config
 *
 * @package Dhl\ExpressRates\Model
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Config
{
    const CONFIG_XML_PATH_AUTOLOAD_ENABLED = 'dhl_expressrates/dev/autoload_enabled';
    const CONFIG_SECTION = 'carriers';
    const CONFIG_GROUP = 'dhlexpress';
    const CONFIG_FIELD_ENABLE_LOGGING = 'logging';
    const CONFIG_FIELD_LOGLEVEL = 'loglevel';
    const CONFIG_FIELD_ACCOUNT_NUMBER = 'accountnumber';
    const CONFIG_FIELD_USERNAME = 'username';
    const CONFIG_FIELD_PASSWORD = 'password';
    const CONFIG_FIELD_SHIP_TO_SPECIFIC_COUNTRIES = 'sallowspecific';
    const CONFIG_FIELD_SPECIFIC_COUNTRIES ='specificcountry';
    const CONFIG_FIELD_ALLOWED_INTERNATIONAL_PRODUCTS = 'allowedinternationalproducts';
    const CONFIG_FIELD_ALLOWED_DOMESTIC_PRODUCTS = 'alloweddomesticproducts';
    const CONFIG_FIELD_PACKAGING_WEIGHT = 'packaging_weight';
    const CONFIG_FIELD_CUT_OFF_TIME = 'cut_off_time';
    const CONFIG_FIELD_PICKUP_TIME = 'pickup_time';
    const CONFIG_FIELD_REGULAR_PICKUP = 'regular_pickup';
    const CONFIG_FIELD_TERMS_OF_TRADE = 'terms_of_trade';
    const CONFIG_FIELD_PACKAGE_INSURANCE = 'package_insurance';
    const CONFIG_FIELD_PACKAGE_INSURANCE_FROM_VALUE = 'package_insurance_from_value';
    const CONFIG_FIELD_TITLE = 'title';
    const CONFIG_FIELD_SORT_ORDER = 'sort_order';
    const CONFIG_FIELD_CHECKOUT_SHOW_DELIVERY_TIME = 'checkout_show_delivery_time';
    const CONFIG_FIELD_SHOW_IF_NOT_APPLICABLE = 'show_method_if_not_applicable';
    const CONFIG_FIELD_ERROR_MESSAGE = 'specificerrmsg';
    const CONFIG_FIELD_ROUNDED_PRICES_FORMAT = 'round_prices_format';
    const CONFIG_FIELD_ROUNDED_PRICES_MODE = 'round_prices_mode';
    const CONFIG_FIELD_ROUNDED_PRICES_STATIC_DECIMAL = 'round_prices_static_decimal';
    const CONFIG_FIELD_INTERNATIONAL_AFFECT_RATES = 'international_affect_rates';
    const CONFIG_FIELD_INTERNATIONAL_HANDLING_TYPE = 'international_handling_type';
    const CONFIG_FIELD_DOMESTIC_AFFECT_RATES = 'domestic_affect_rates';
    const CONFIG_FIELD_DOMESTIC_HANDLING_TYPE = 'domestic_handling_type';
    const CONFIG_FIELD_FREE_SHIPPING_VIRTUAL_ENABLED = 'free_shipping_virtual_products_enable';
    const CONFIG_FIELD_INTERNATIONAL_FREE_SHIPPING_ENABLED = 'international_free_shipping_enable';
    const CONFIG_FIELD_INTERNATIONAL_FREE_SHIPPING_PRODUCTS = 'international_free_shipping_products';
    const CONFIG_FIELD_INTERNATIONAL_FREE_SHIPPING_SUBTOTAL = 'international_free_shipping_subtotal';
    const CONFIG_FIELD_DOMESTIC_FREE_SHIPPING_ENABLED = 'domestic_free_shipping_enable';
    const CONFIG_FIELD_DOMESTIC_FREE_SHIPPING_PRODUCTS = 'domestic_free_shipping_products';
    const CONFIG_FIELD_DOMESTIC_FREE_SHIPPING_SUBTOTAL = 'domestic_free_shipping_subtotal';
    const CONFIG_XML_PATH_INTERNATIONAL_HANDLING_FEE = 'international_handling_fee';
    const CONFIG_XML_PATH_DOMESTIC_HANDLING_FEE = 'domestic_handling_fee';
    const CONFIG_XML_SUFFIX_FIXED = '_fixed';
    const CONFIG_XML_SUFFIX_PERCENTAGE = '_percentage';
    const CONFIG_XML_PATH_WEIGHT_UNIT = 'general/locale/weight_unit';
    const CONFIG_XML_PATH_VERSION = 'version';
    const DEFAULT_DIMENSION_UNIT = 'in';

    /**
     * @var string[]
     */
    protected $weightUnitMap = array(
        'kgs' => 'kg',
        'lbs' => 'lb',
        'POUND' => 'lb',
        'KILOGRAM' => 'kg',
    );

    /**
     * @var string[]
     */
    protected $dimensionUnitMap = array(
        'INCH' => 'in',
        'CENTIMETER' => 'cm',
    );

    /**
     * @var string[]
     */
    protected $weightUnitToDimensionUnitMap = array(
        'kg' => 'cm',
        'lb' => 'in',
    );

    /**
    * Wrap store config access.
    *
    * @param string $field
    * @param mixed $store
    * @return mixed
    */
    protected function getStoreConfig($field, $store = null)
    {
        $path = sprintf('%s/%s/%s', self::CONFIG_SECTION, self::CONFIG_GROUP, $field);
        return Mage::getStoreConfig($path, $store);
    }

    /**
     * Wrap store config access.
     *
     * @param string $field
     * @param mixed $store
     * @return bool
     */
    protected function getStoreConfigFlag($field, $store = null)
    {
        $path = sprintf('%s/%s/%s', self::CONFIG_SECTION, self::CONFIG_GROUP, $field);
        return Mage::getStoreConfigFlag($path, $store);
    }

    /**
     * Check if custom autoloader should be registered.
     *
     * @return bool
     */
    public function isAutoloadEnabled()
    {
        return Mage::getStoreConfigFlag(self::CONFIG_XML_PATH_AUTOLOAD_ENABLED);
    }

    /**
     * @param mixed $store
     * @return bool
     */
    public function isLoggingEnabled($store = null)
    {
        return $this->getStoreConfigFlag(self::CONFIG_FIELD_ENABLE_LOGGING, $store);
    }

    /**
     * @param mixed $store
     * @return int
     */
    public function getLogLevel($store = null)
    {
        // NOTE: (int) null eq. 0 eq. \Zend_Log::EMERG
        return (int) $this->getStoreConfig(self::CONFIG_FIELD_LOGLEVEL, $store);
    }

    /**
     * Get the account number.
     *
     * @param mixed $store
     * @return string
     */
    public function getAccountNumber($store = null)
    {
        return (string) $this->getStoreConfig(self::CONFIG_FIELD_ACCOUNT_NUMBER, $store);
    }

    /**
     * Get the username.
     *
     * @param mixed $store
     * @return string
     */
    public function getUsername($store = null)
    {
        return (string) $this->getStoreConfig(self::CONFIG_FIELD_USERNAME, $store);
    }

    /**
     * Get the password.
     *
     * @param mixed $store
     * @return string
     */
    public function getPassword($store = null)
    {
        return (string) $this->getStoreConfig(self::CONFIG_FIELD_PASSWORD, $store);
    }

    /**
     * Check if shipping only to specific countries.
     *
     * @param mixed $store
     * @return bool
     */
    public function shipToSpecificCountries($store = null)
    {
        return (bool)$this->getStoreConfig(self::CONFIG_FIELD_SHIP_TO_SPECIFIC_COUNTRIES, $store);
    }

    /**
     * Get the specific countries.
     *
     * @param string|null $store
     * @return string[]
     */
    public function getSpecificCountries($store = null)
    {
        $countries = $this->getStoreConfig(self::CONFIG_FIELD_SPECIFIC_COUNTRIES, $store);

        return explode(',', $countries);
    }

    /**
     * Get the allowed international products.
     *
     * @param mixed $store
     * @return string[]
     */
    public function getAllowedInternationalProducts($store = null)
    {
        $allowedProductsValue = $this->getStoreConfig(
            self::CONFIG_FIELD_ALLOWED_INTERNATIONAL_PRODUCTS,
            $store
        );

        return $this->normalizeAllowedProducts($allowedProductsValue);
    }

    /**
     * Get the allowed domestic products.
     *
     * @param mixed $store
     * @return string[]
     */
    public function getAllowedDomesticProducts($store = null)
    {
        $allowedProducts = $this->getStoreConfig(
            self::CONFIG_FIELD_ALLOWED_DOMESTIC_PRODUCTS,
            $store
        );

        return $this->normalizeAllowedProducts($allowedProducts);
    }

    /**
     * Returns configured packaging weight for rates calculation.
     *
     * @param mixed $store
     * @return float
     */
    public function getPackagingWeight($store = null)
    {
        return (float)$this->getStoreConfig(self::CONFIG_FIELD_PACKAGING_WEIGHT, $store);
    }

    /**
     * Get terms of trade.
     *
     * @param mixed $store
     * @return string
     */
    public function getCutOffTime($store = null)
    {
        return (string)$this->getStoreConfig(self::CONFIG_FIELD_CUT_OFF_TIME, $store);
    }

    /**
     * Check if regular pickup is enabled.
     *
     * @param string|null $store
     * @return bool
     */
    public function isRegularPickup($store = null)
    {
        return (bool)$this->getStoreConfigFlag(self::CONFIG_FIELD_REGULAR_PICKUP, $store);
    }

    /**
     * Get the cut off time.
     *
     * @param mixed $store
     * @return string
     */
    public function getTermsOfTrade($store = null)
    {
        return (string)$this->getStoreConfig(self::CONFIG_FIELD_TERMS_OF_TRADE, $store);
    }

    /**
     * Return if packages are insured.
     *
     * @param mixed $store
     * @return bool
     */
    public function isInsured($store = null)
    {
        return (bool)$this->getStoreConfigFlag(self::CONFIG_FIELD_PACKAGE_INSURANCE, $store);
    }

    /**
     * Get the value from which the packages should be insured.
     *
     * @param mixed $store
     * @return float
     */
    public function insuranceFromValue($store = null)
    {
        return (float)$this->getStoreConfig(self::CONFIG_FIELD_PACKAGE_INSURANCE_FROM_VALUE, $store);
    }

    /**
     * Get the title.
     *
     * @param mixed $store
     * @return string
     */
    public function getTitle($store = null)
    {
        return (string)$this->getStoreConfig(self::CONFIG_FIELD_TITLE, $store);
    }

    /**
     * @param mixed $store
     * @return string
     */
    public function getSpecificErrorMessage($store = null)
    {
        return (string)$this->getStoreConfig(self::CONFIG_FIELD_ERROR_MESSAGE, $store);
    }

    /**
     * Get the sort order.
     *
     * @param mixed $store
     * @return int
     */
    public function getSortOrder($store = null)
    {
        return (int)$this->getStoreConfig(self::CONFIG_FIELD_SORT_ORDER, $store);
    }

    /**
     * Check if delivery time should be displayed in checkout
     *
     * @param mixed $store
     * @return bool
     */
    public function isCheckoutDeliveryTimeEnabled($store = null)
    {
        $value = $this->getStoreConfig(self::CONFIG_FIELD_CHECKOUT_SHOW_DELIVERY_TIME, $store);

        return $value === '1';
    }

    /**
     * Show DHL Express in checkout if there are no products available.
     *
     * @param mixed $store
     * @return bool
     */
    public function showIfNotApplicable($store = null)
    {
        return (bool)$this->getStoreConfig(self::CONFIG_FIELD_SHOW_IF_NOT_APPLICABLE, $store);
    }

    /**
     * Get the error message.
     *
     * @param mixed $store
     * @return string
     */
    public function getNotApplicableErrorMessage($store = null)
    {
        return (string)$this->getStoreConfig(self::CONFIG_FIELD_ERROR_MESSAGE, $store);
    }

    /**
     * Get rounded prices format.
     *
     * @param mixed $store
     * @return string
     */
    public function getRoundedPricesFormat($store = null)
    {
        return (string)$this->getStoreConfig(self::CONFIG_FIELD_ROUNDED_PRICES_FORMAT, $store);
    }

    /**
     * Get mode for rounded prices.
     *
     * @param mixed $store
     * @return string
     */
    public function getRoundedPricesMode($store = null)
    {
        return (string)$this->getStoreConfig(self::CONFIG_FIELD_ROUNDED_PRICES_MODE, $store);
    }

    /**
     * Get rounded prices static decimal value.
     *
     * @param mixed $store
     * @return float
     */
    public function getRoundedPricesStaticDecimal($store = null)
    {
        return (float)$this->getStoreConfig(
            self::CONFIG_FIELD_ROUNDED_PRICES_STATIC_DECIMAL,
            $store
        ) / 100;
    }

    /**
     * Check if international rates configuration is enabled
     *
     * @param mixed $store
     * @return bool
     */
    public function isInternationalRatesConfigurationEnabled($store = null)
    {
        return $this->getStoreConfigFlag(self::CONFIG_FIELD_INTERNATIONAL_AFFECT_RATES, $store);
    }

    /**
     * Get the international handling type.
     *
     * @param mixed $store
     *
     * @return string
     */
    public function getInternationalHandlingType($store = null)
    {
        return $this->isInternationalRatesConfigurationEnabled($store)
            ? (string)$this->getStoreConfig(self::CONFIG_FIELD_INTERNATIONAL_HANDLING_TYPE, $store)
            : '';
    }

    /**
     * Check if domestic rates configuration is enabled
     *
     * @param mixed $store
     * @return bool
     */
    public function isDomesticRatesConfigurationEnabled($store = null)
    {
        return $this->getStoreConfigFlag(self::CONFIG_FIELD_DOMESTIC_AFFECT_RATES, $store);
    }

    /**
     * Get the domestic handling type.
     *
     * @param mixed $store
     *
     * @return string
     */
    public function getDomesticHandlingType($store = null)
    {
        return $this->isDomesticRatesConfigurationEnabled($store)
            ? (string)$this->getStoreConfig(self::CONFIG_FIELD_DOMESTIC_HANDLING_TYPE, $store)
            : '';
    }

    /**
     * Returns whether virtual products should be included in the subtotal value calculation or not.
     *
     * @param mixed $store
     *
     * @return bool
     */
    public function isFreeShippingVirtualProductsIncluded($store = null)
    {
        return $this->getStoreConfigFlag(self::CONFIG_FIELD_FREE_SHIPPING_VIRTUAL_ENABLED, $store);
    }

    /**
     * @param mixed $store
     * @return bool
     */
    public function isInternationalFreeShippingEnabled($store = null)
    {
        return $this->getStoreConfigFlag(self::CONFIG_FIELD_INTERNATIONAL_FREE_SHIPPING_ENABLED, $store);
    }

    /**
     * Get the international free shipping allowed products.
     *
     * @param mixed $store
     *
     * @return string[]
     */
    public function getInternationalFreeShippingProducts($store = null)
    {
        if ($this->isInternationalFreeShippingEnabled($store)) {
            $allowedProducts = $this->getStoreConfig(
                self::CONFIG_FIELD_INTERNATIONAL_FREE_SHIPPING_PRODUCTS,
                $store
            );

            return $this->normalizeAllowedProducts($allowedProducts);
        }

        return array();
    }

    /**
     * Get the international free shipping subtotal value.
     *
     * @param mixed $store
     *
     * @return float
     */
    public function getInternationalFreeShippingSubTotal($store = null)
    {
        return $this->isInternationalFreeShippingEnabled($store) ?
            (float)$this->getStoreConfig(
                self::CONFIG_FIELD_INTERNATIONAL_FREE_SHIPPING_SUBTOTAL,
                $store
            ) : 0;
    }

    /**
     * @param mixed $store
     * @return bool
     */
    public function isDomesticFreeShippingEnabled($store = null)
    {
        return $this->getStoreConfigFlag(
            self::CONFIG_FIELD_DOMESTIC_FREE_SHIPPING_ENABLED,
            $store
        );
    }

    /**
     * Get the domestic free shipping allowed products.
     *
     * @param mixed $store
     * @return string[]
     */
    public function getDomesticFreeShippingProducts($store = null)
    {
        if ($this->isDomesticFreeShippingEnabled($store)) {
            $allowedProducts = $this->getStoreConfig(
                self::CONFIG_FIELD_DOMESTIC_FREE_SHIPPING_PRODUCTS,
                $store
            );

            return $this->normalizeAllowedProducts($allowedProducts);
        }

        return array();
    }

    /**
     * Get the domestic free shipping subtotal value.
     *
     * @param mixed $store
     * @return float
     */
    public function getDomesticFreeShippingSubTotal($store = null)
    {
        return $this->isDomesticFreeShippingEnabled($store) ?
            (float)$this->getStoreConfig(
                self::CONFIG_FIELD_DOMESTIC_FREE_SHIPPING_SUBTOTAL,
                $store
            ) : 0;
    }

    /**
     * Get the international handling fee.
     *
     * @param mixed $store
     * @return float
     */
    public function getInternationalHandlingFee($store = null)
    {
        if ($this->isInternationalRatesConfigurationEnabled($store)) {
            $type =
                $this->getInternationalHandlingType($store) ===
                Mage_Shipping_Model_Carrier_Abstract::HANDLING_TYPE_FIXED ?
                    self::CONFIG_XML_SUFFIX_FIXED :
                    self::CONFIG_XML_SUFFIX_PERCENTAGE;

            return (float)$this->getStoreConfig(
                self::CONFIG_XML_PATH_INTERNATIONAL_HANDLING_FEE . $type,
                $store
            );
        }

        return 0;
    }

    /**
     * Get the domestic handling fee.
     *
     * @param mixed $store
     * @return float
     */
    public function getDomesticHandlingFee($store = null)
    {
        if ($this->isDomesticRatesConfigurationEnabled($store)) {
            $type = $this->getDomesticHandlingType($store) ===
            Mage_Shipping_Model_Carrier_Abstract::HANDLING_TYPE_FIXED ?
                self::CONFIG_XML_SUFFIX_FIXED :
                self::CONFIG_XML_SUFFIX_PERCENTAGE;

            return (float)$this->getStoreConfig(
                self::CONFIG_XML_PATH_DOMESTIC_HANDLING_FEE . $type,
                $store
            );
        }

        return 0;
    }

    /**
     * Get the general weight unit.
     *
     * @param null $store
     * @return string
     */
    public function getWeightUnit($store = null)
    {
        $weightUOM = $this->getStoreConfig(self::CONFIG_XML_PATH_WEIGHT_UNIT, $store);

        return $this->normalizeWeightUOM($weightUOM);
    }

    /**
     * Resolves and flattens product codes separated by ";".
     *
     * @param string $allowedProductsValue The ";" separated list of product codes
     *
     * @return string[]
     *
     * @see InternationalProducts
     */
    protected function normalizeAllowedProducts($allowedProductsValue)
    {
        $combinedKeys = explode(',', $allowedProductsValue) ?: array();

        return array_reduce(
            $combinedKeys,
            function ($carry, $item) {
                $singleKeys = explode(';', $item);
                if ($singleKeys !== false) {
                    $carry = array_merge($carry, $singleKeys);
                }

                return $carry;
            },
            array()
        );
    }

    /**
     * Maps Magento's internal unit names to SDKs unit names
     *
     * @param string $unit
     * @return string
     */
    public function normalizeWeightUOM($unit)
    {
        if (array_key_exists($unit, $this->weightUnitMap)) {
            return $this->weightUnitMap[$unit];
        }

        return $unit;
    }

    /**
     * Derives the current dimensions UOM from weight UOM (so both UOMs are in SU or SI format, but always consistent)
     *
     * @param $unit
     * @return string
     */
    protected function getDimensionsUOMfromWeightUOM($unit)
    {
        if (array_key_exists($unit, $this->weightUnitToDimensionUnitMap)) {
            return $this->weightUnitToDimensionUnitMap[$unit];
        }

        return self::DEFAULT_DIMENSION_UNIT;
    }

    /**
     * Get the general dimensions unit.
     *
     * @return string
     */
    public function getDimensionsUOM()
    {
        return $this->getDimensionsUOMfromWeightUOM(
            $this->getWeightUnit()
        );
    }

    /**
     * Maps Magento's internal unit names to SDKs unit names
     *
     * @param string $unit
     * @return string
     */
    public function normalizeDimensionUOM($unit)
    {
        if (array_key_exists($unit, $this->dimensionUnitMap)) {
            return $this->dimensionUnitMap[$unit];
        }

        return $unit;
    }


    /**
     * Returns countries that are marked as EU-Countries
     *
     * @param mixed $store
     * @return string[]
     */
    public function getEuCountries($store = null)
    {
        $euCountries = $this->getStoreConfig(
            Mage_Core_Helper_Data::XML_PATH_EU_COUNTRIES_LIST,
            $store
        );

        return explode(',', $euCountries);
    }

    /**
     * Returns the shipping origin country
     *
     * @see Config
     *
     * @param mixed $store
     * @return string
     */
    public function getOriginCountry($store = null)
    {
        return (string)$this->getStoreConfig(Mage_Shipping_Model_Config::XML_PATH_ORIGIN_COUNTRY_ID, $store);
    }

    /**
     * Checks if route is dutiable by stores origin country and eu country list
     *
     * @param string $receiverCountry
     * @param mixed $store
     * @return bool
     */
    public function isDutiableRoute($receiverCountry, $store = null)
    {
        $originCountry = $this->getOriginCountry($store);
        $euCountries = $this->getEuCountries($store);

        $bothEU = \in_array($originCountry, $euCountries, true) &&
            \in_array($receiverCountry, $euCountries, true);

        return $receiverCountry !== $originCountry && !$bothEU;
    }
}
