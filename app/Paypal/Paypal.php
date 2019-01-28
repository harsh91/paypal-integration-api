<?php
/**
 * Created by PhpStorm.
 * User: harshg
 * Date: 1/23/2019
 * Time: 11:22 AM
 */

namespace App\Paypal;

use PayPal\Api\Amount;
use PayPal\Api\Details;

class Paypal
{
    protected $apiContext, $itemList;

    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.id'),
                config('services.paypal.secret')
            )
        );
    }

    /**
     * @return Details
     */
    protected function getDetails(): Details
    {
        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.5);
        return $details;
    }

    /**
     * @return Amount
     */
    protected function getAmount(): Amount
    {
        $amount = new Amount();
        $amount->setCurrency('USD');
        $amount->setTotal(20);
        $amount->setDetails($this->getDetails());
        return $amount;
    }
}