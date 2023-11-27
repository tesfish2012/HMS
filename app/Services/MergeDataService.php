<?php

namespace App\Services;

use Illuminate\Support\Str;

class MergeDataService
{

    public function storeMergeData($request)
    {
        return $request->merge([
            'id' => (string) Str::uuid(),
            'state' => 1
        ]);
    }

    public function updateMergeData($request, $id)
    {
        return $request->merge([
            'id' => $id
        ]);
    }

    public function mergeFileAndId($request, $fileName)
    {
        return $request->merge([
            'id' => (string) Str::uuid(),
            'featured_photo' => $fileName
        ]);
    }
}