<?php
/**
 * Created by PhpStorm.
 * User: harshg
 * Date: 1/23/2019
 * Time: 2:07 PM
 */

namespace App\Paypal;

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class ExecutePayment extends Paypal
{

    public function execute()
    {
        $payment = $this->getPayment();
        $this->createExecution()->addTransaction($this->getTransaction());
        $result = $payment->execute($this->createExecution(), $this->apiContext);

        return $result;
    }

    /**
     * @return Payment
     */
    protected function getPayment(): Payment
    {
        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $this->apiContext);
        return $payment;
    }

    /**
     * @return PaymentExecution
     */
    protected function createExecution(): PaymentExecution
    {
        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));
        return $execution;
    }

    /**
     * @return Transaction
     */
    protected function getTransaction(): Transaction
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->getAmount());
        return $transaction;
    }

}