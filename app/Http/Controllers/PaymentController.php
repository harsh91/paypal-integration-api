<?php

namespace App\Http\Controllers;

use App\Paypal\CreatePayment;
use App\Paypal\ExecutePayment;

class PaymentController extends Controller
{
    public function execute()
    {
        return request()->all();
        $payment = new ExecutePayment();
        return $payment->execute();
    }

    public function create()
    {
        return 'lol';
        $payment = new CreatePayment();
        return $payment->create();
    }
}
