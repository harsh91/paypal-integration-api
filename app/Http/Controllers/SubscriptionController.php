<?php

namespace App\Http\Controllers;

use App\Paypal\Agreement;
use App\Paypal\SimplePlan;
use App\Paypal\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function createSimplePlan() {
        $simplePlan = new SimplePlan();
        $simplePlan->create();
    }

    public function listPlans()
    {
        $subscription = new SubscriptionPlan();
        return $subscription->listPlans();
    }

    public function getPlan($id)
    {
        $subscription = new SubscriptionPlan();
        return $subscription->getPlan($id);
    }

    public function deletePlan(Request $request)
    {
        $subscription = new SubscriptionPlan();
        return $subscription->deletePlan($request->id) === true ? "Deleted Successfully" : "Some problem while deleting.";
    }

    public function activatePlan($id) {
        $subscription = new SubscriptionPlan();
        return $subscription->activatePlan($id);
    }

    public function createAgreement($id)
    {
        $agreement = new Agreement();
        return $agreement->create($id);
    }

    public function executeAgreement($status)
    {
        if($status == 'true') {
            $token = $_GET['token'];
            $agreement = new Agreement();
            return $agreement->execute($token);
        } else {
            dd("Problem occurred!!");
        }
    }
}
