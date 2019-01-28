<?php
/**
 * Created by PhpStorm.
 * User: harshg
 * Date: 1/23/2019
 * Time: 11:27 AM
 */

namespace App\Paypal;

use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class CreatePayment extends Paypal
{

    public function create()
    {
        $item1 = new Item();
        $item1->setName('Gun')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku('123456')
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Ballon Bag')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku('123654')
            ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        $payment = $this->getPayment($itemList);

        try {
            $payment->create($this->apiContext);
        } catch(Exception $e) {
            echo $e->getMessage();
            exit(1);
        }

        return redirect($payment->getApprovalLink());
    }

    /**
     * @return Payer
     */
    protected function setPayerMethod(): Payer
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        return $payer;
    }

    /**
     * @param ItemList $itemList
     * @return Transaction
     */
    protected function getTransaction(ItemList $itemList): Transaction
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->getAmount())
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        return $transaction;
    }

    /**
     * @return RedirectUrls
     */
    protected function getRedirectUrls(): RedirectUrls
    {
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(config('services.paypal.url.payment.execute'))
            ->setCancelUrl(config('services.paypal.url.payment.cancel'));
        return $redirectUrls;
    }

    /**
     * @param $itemList
     * @return Payment
     */
    protected function getPayment($itemList): Payment
    {
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($this->setPayerMethod())
            ->setRedirectUrls($this->getRedirectUrls())
            ->setTransactions(array($this->getTransaction($itemList)));
        return $payment;
    }
}