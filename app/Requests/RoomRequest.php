<?php

namespace App\Requests;

use App\Http\Controllers\Controller;

class RoomRequest extends Controller
{
    public function storeValidationRule($request)
    {
        return $this->validate($request, [
            'name' => 'required|unique:rooms',
        ]);
    }

    public function updateValidationRule($request, $id)
    {
        return $this->validate($request, [
            'name' => 'required|unique:rooms,id' . ',' . $id,
        ]);
    }
}