<?php

namespace App\Requests;

use App\Http\Controllers\Controller;

class ServicePlanRequest extends Controller
{
    public function storeValidationRule($request)
    {
        return $this->validate($request, [
            'code' => 'required|unique:service_plans',
        ]);
    }

    public function updateValidationRule($request, $id)
    {
        return $this->validate($request, [
            'code' => 'required|unique:service_plans,id' . ',' . $id,
        ]);
    }
}