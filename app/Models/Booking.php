<?php

namespace App\Models;

use App\Constants\MyModel;
use App\Requests\BookingRequest;
use App\Services\MergeDataService;
use App\Traits\UseState;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{    
    use softDeletes;
    use UseState;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'customer_id',
        'room_id',
        'date_from',
        'date_to',
        'remark',
        'deleted_at',
        'state'
    ];
    protected $hidden = ['deleted_at'];

    //Relationship
    public function Rooms()
    {
        return $this->belongsTo(MyModel::ROOM)->select('id', 'name');
    }

    //Stores
    public static function storeBooking($request)
    {
        $valid = (new BookingRequest)->storeValidationRule($request);
        if (!$valid) return $valid;
        return Booking::Create(
            (new MergeDataService)->StoreMergeData($request)
                ->all()
        );
    }

    public static function updateBooking($request, $id)
    {
        $valid = (new BookingRequest)->updateValidationRule($request, $id);
        if (!$valid) return $valid;

        $model = Booking::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return $model;
    }
    public static function cancelBooking($id)
    {

        $model = Booking::findOrFail($id);
        $model->id=-2;
        $model->save();

        return $model;
    }
    public static function toggleStatus($id)
    {
        $model = Booking::findOrFail($id);
        $model->state = $model->state ^ 1;
        $model->save();
        return $model;
    }
}