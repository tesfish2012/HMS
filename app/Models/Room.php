<?php

namespace App\Models;

use App\Constants\MyModel;
use App\Requests\RoomRequest;
use App\Services\MergeDataService;
use App\Traits\UseState;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use UseState;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'floor_number',
        'bed_type',
        'category_id',
        'deleted_at',
        'state'
    ];
    protected $hidden = ['deleted_at'];

    //Relationship
    public function category()
    {
        return $this->belongsTo(MyModel::CATEGORY)->select('id', 'name');
    }

    //Stores
    public static function storeRoom($request)
    {
        $valid = (new RoomRequest)->storeValidationRule($request);
        if (!$valid) return $valid;

        return Room::Create(
            (new MergeDataService)->StoreMergeData($request)->all()
        );
    }

    public static function updateRoom($request, $id)
    {
        $valid = (new RoomRequest)->updateValidationRule($request, $id);
        if (!$valid) return $valid;

        $model = Room::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return $model;
    }

    public static function toggleStatus($id)
    {
        $model = Room::findOrFail($id);
        $model->state = $model->state ^ 1;
        $model->save();
        return $model;
    }
}