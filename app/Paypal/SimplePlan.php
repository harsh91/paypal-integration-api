<?php
/**
 * Created by PhpStorm.
 * User: harshg
 * Date: 1/24/2019
 * Time: 8:31 AM
 */

namespace App\Paypal;

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;

class SimplePlan extends SubscriptionPlan
{

    public function create() {
        $plan = $this->initiatePlan();

        $paymentDefinition = $this->getPaymentDefinition();
        $chargeModel = $this->getChargeModel();
        $paymentDefinition->setChargeModels(array($chargeModel));

        $merchantPreferences = $this->getMerchantPerferences();

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        $output = $plan->create($this->apiContext);
        dd($output);
    }

    /**
     * @return Plan
     */
    public function initiatePlan(): Plan
    {
        $plan = new Plan();
        $plan->setName('T-Shirt of the Month Club Plan')
            ->setDescription('Template creation.')
            ->setType('fixed');
        return $plan;
    }

    /**
     * @return PaymentDefinition
     */
    protected function getPaymentDefinition(): PaymentDefinition
    {
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval("2")
            ->setCycles("12")
            ->setAmount(new Currency(array('value' => 100, 'currency' => 'USD')));
        return $paymentDefinition;
    }

    /**
     * @return ChargeModel
     */
    protected function getChargeModel(): ChargeModel
    {
        $chargeModel = new ChargeModel();
        $chargeModel->setType('SHIPPING')
            ->setAmount(new Currency(array('value' => 10, 'currency' => 'USD')));
        return $chargeModel;
    }

    /**
     * @return MerchantPreferences
     */
    protected function getMerchantPerferences(): MerchantPreferences
    {
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl(config('services.paypal.url.agreement.success'))
            ->setCancelUrl(config('services.paypal.url.agreement.failure'))
            ->setAutoBillAmount("yes")
            ->setInitialFailAmountAction("CONTINUE")
            ->setMaxFailAttempts("0")
            ->setSetupFee(new Currency(array('value' => 1, 'currency' => 'USD')));
        return $merchantPreferences;
    }

}