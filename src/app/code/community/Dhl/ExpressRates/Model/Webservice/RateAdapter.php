<?php
/**
 * See LICENSE.md for license details.
 */


use Dhl\Express\Exception\RateRequestException;
use Dhl\Express\Exception\SoapException;

/**
 * Class RateAdapter
 *
 * @package Dhl\ExpressRates\Model\Webservice
 * @author  Andreas Müller <andreas.mueller@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Webservice_RateAdapter
{
    /**
     * @var Dhl_ExpressRates_Model_Webservice_Rate_RequestDataMapper
     */
    protected $requestDataMapper;

    /**
     * @var Dhl_ExpressRates_Model_Webservice_Rate_ResponseDataMapper
     */
    protected $responseDataMapper;

    /**
     * @var Dhl_ExpressRates_Model_Webservice_RateClient
     */
    protected $client;

    /**
     * Dhl_ExpressRates_Model_Webservice_RateAdapter constructor.
     */
    public function __construct()
    {
        $this->requestDataMapper = Mage::getModel('dhl_expressrates/webservice_rate_requestDataMapper');
        $this->responseDataMapper = Mage::getModel('dhl_expressrates/webservice_rate_responseDataMapper');
        $this->client = Mage::getModel('dhl_expressrates/webservice_rateClient');
    }

    /**
     * @param Mage_Shipping_Model_Rate_Request $request
     *
     * @return array Mage_Shipping_Model_Rate_Result_Method
     * @throws Mage_Core_Exception
     */
    public function getRates(Mage_Shipping_Model_Rate_Request $request)
    {
        $requestModel = $this->requestDataMapper->mapRequest($request);

        try {
            $response = $this->client->performRatesRequest($requestModel);
            $result = $this->responseDataMapper->mapResult($response);
        } catch (RateRequestException $exception) {
            Mage::throwException(
                Mage::helper('dhl_expressrates/data')->__('Error during rate request.'),
                $exception
            );
        } catch (SoapException $exception) {
            Mage::throwException(
                Mage::helper('dhl_expressrates/data')->__('Error during rate request.'),
                $exception
            );
        }

        return $result;
    }
}
