<?php

namespace App\Requests;

use App\Http\Controllers\Controller;

class TestimonialRequest extends Controller
{
    public function storeValidationRule($request)
    {
        return $this->validate($request, [
            'name' => 'required|unique:testimonials',
        ]);
    }

    public function updateValidationRule($request, $id)
    {
        return $this->validate($request, [
            'name' => 'required|unique:testimonials,id' . ',' . $id,
        ]);
    }
}