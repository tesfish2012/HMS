<?php

namespace App\Requests;

use App\Http\Controllers\Controller;

class ServiceSubscriptionRequest extends Controller
{
    public function storeValidationRule($request)
    {
        return $this->validate($request, [
            'date_to' => 'required|unique:service_subscriptions',
        ]);
    }

    public function updateValidationRule($request, $id)
    {
        return $this->validate($request, [
            'date_to' => 'required|unique:service_subscriptions,id' . ',' . $id,
        ]);
    }
}