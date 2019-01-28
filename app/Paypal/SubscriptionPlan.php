<?php
/**
 * Created by PhpStorm.
 * User: harshg
 * Date: 1/24/2019
 * Time: 10:17 AM
 */

namespace App\Paypal;


use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Api\Plan;
use PayPal\Api\PlanList;
use PayPal\Common\PayPalModel;

class SubscriptionPlan extends Paypal
{

    public function listPlans(): PlanList
    {
        $params = array('page_size' => '10');
        return Plan::all($params, $this->apiContext);
    }

    public function getPlan($planId): Plan
    {
        return Plan::get($planId, $this->apiContext);
    }

    public function deletePlan($planId): bool
    {
        return $this->getPlan($planId)->delete($this->apiContext);
    }

    public function activatePlan($planId): Plan
    {
        $patch = new Patch();
        $value = new PayPalModel('{
            "state":"ACTIVE"
        }');

        $patch->setOp('replace')
            ->setPath('/')
            ->setValue($value);
        $patchRequest = new PatchRequest();
        $patchRequest->addPatch($patch);

        $this->getPlan($planId)->update($patchRequest, $this->apiContext);

        return $this->getPlan($planId);
    }

}