<?php
namespace App\Models;

use App\Constants\MyModel;
use App\Requests\ServiceSubscriptionRequest;
use App\Services\MergeDataService;
use App\Traits\UseState;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ServiceSubscription extends Model
{    
    use softDeletes;
    use UseState;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'service_id',
        'customer_id',
        'service_plan_id',
        'date_from',
        'date_to',
        'payment_state',
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
    public static function storeServiceSubscription($request)
    {
        $valid = (new ServiceSubscriptionRequest)->storeValidationRule($request);
        if (!$valid) return $valid;

        return ServiceSubscription::Create(
            (new MergeDataService)->StoreMergeData($request)
                ->all()
        );
    }

    public static function updateServiceSubscription($request, $id)
    {
        $valid = (new ServiceSubscriptionRequest)->updateValidationRule($request, $id);
        if (!$valid) return $valid;

        $model = ServiceSubscription::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return $model;
    }

    public static function toggleStatus($id)
    {
        $model = ServiceSubscription::findOrFail($id);
        $model->state = $model->state ^ 1;
        $model->save();
        return $model;
    }
}