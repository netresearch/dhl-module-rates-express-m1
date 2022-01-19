<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Webservice\Soap\TypeMapper;

use Dhl\Express\Api\Data\RateResponseInterface;
use Dhl\Express\Exception\RateRequestException;
use Dhl\Express\Model\RateResponse;
use Dhl\Express\Model\Response\Rate\Rate;
use Dhl\Express\Webservice\Soap\Type\Common\Notification;
use Dhl\Express\Webservice\Soap\Type\RateResponse\Provider\Service\Charges;
use Dhl\Express\Webservice\Soap\Type\SoapRateResponse;

/**
 * Rate Response Mapper.
 *
 * Transform the SOAP response type into rate objects suitable for further processing.
 *
 * @package  Dhl\Express\Webservice
 * @link     https://www.netresearch.de/
 */
class RateResponseMapper
{
    /**
     * @param SoapRateResponse $rateResponse
     *
     * @return RateResponseInterface
     *
     * @throws RateRequestException
     */
    public function map(SoapRateResponse $rateResponse)
    {
        $rates = [];

        $provider = $rateResponse->getProvider();
        $notification = $provider->getNotification();
        if (\is_array($notification) && !empty($notification)) {
            /** @var Notification $notification */
            $notification = current($notification);
        }

        if ($notification->isError()) {
            throw new RateRequestException($notification->getMessage(), $notification->getCode());
        }

        if ($provider->getService()) {
            foreach ($provider->getService() as $service) {
                $serviceCode = $service->getType();
                $totals = $service->getTotalNet();
                $charges = $service->getCharges();

                foreach ($totals as $total) {
                    $currencyType = $total->getType();
                    $totalCharges = array_filter(
                        $charges,
                        function (Charges $charges) use ($currencyType) {
                            return ($charges->getType() === $currencyType);
                        }
                    );

                    if (empty($totalCharges)) {
                        continue;
                    }

                    /** @var Charges[] $totalCharges */
                    $chargeComponents = $totalCharges[0]->getCharge();
                    if (!empty($chargeComponents)) {
                        $label = $chargeComponents[0]->getChargeType();
                    } else {
                        $label = 'DHL Express';
                    }

                    $currencyCode = $total->getCurrency();
                    $cost = $total->getAmount();

                    $rate = new Rate($serviceCode, $label, $cost, $currencyCode);
                    $rate->setDeliveryTime($service->getDeliveryTime());

                    $rates[] = $rate;
                }
            }
        }

        return new RateResponse($rates);
    }
}
