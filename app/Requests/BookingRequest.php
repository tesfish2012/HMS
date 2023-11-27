<?php

namespace App\Requests;

use App\Http\Controllers\Controller;

class BookingRequest extends Controller
{
    public function storeValidationRule($request)
    {
        return $this->validate($request, [
            'date_to' => 'required|unique:bookings',
        ]);
    }

    public function updateValidationRule($request, $id)
    {
        return $this->validate($request, [
            'date_to' => 'required|unique:bookings,id' . ',' . $id,
        ]);
    }
}