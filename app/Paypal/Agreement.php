<?php

namespace App\Paypal;

use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;

class Agreement extends Paypal
{

    public function create($id)
    {
        return redirect($this->initialize($id));
    }

    public function execute($token)
    {
        $agreement = new \PayPal\Api\Agreement();
        $agreement->execute($token, $this->apiContext);
        return \PayPal\Api\Agreement::get($agreement->getId(), $this->apiContext);
    }

    /**
     * @return string
     */
    protected function initialize($id): string
    {
        $agreement = new \PayPal\Api\Agreement();
        $agreement->setName('Base Agreement')
            ->setDescription('Basic Agreement')
            ->setStartDate('2019-06-17T9:45:04Z');
        $agreement->setPlan($this->getPlan($id));
        $agreement->setPayer($this->getPayer());
        $agreement->setShippingAddress($this->getShippingAdress());
        $agreement = $agreement->create($this->apiContext);
        return $agreement->getApprovalLink();
    }

    /**
     * @return ShippingAddress
     */
    protected function getShippingAdress(): ShippingAddress
    {
        $shippingAddress = new ShippingAddress();
        $shippingAddress->setLine1('111 First Street')
            ->setCity('Saratoga')
            ->setState('CA')
            ->setPostalCode('95070')
            ->setCountryCode('US');
        return $shippingAddress;
    }

    /**
     * @return Payer
     */
    protected function getPayer(): Payer
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        return $payer;
    }

    /**
     * @param $id
     * @return Plan
     */
    protected function getPlan($id): Plan
    {
        $plan = new Plan();
        $plan->setId($id);
        return $plan;
    }

}