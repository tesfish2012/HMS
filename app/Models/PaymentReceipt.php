<?php

namespace App\Models;

use App\Constants\MyModel;
use App\Requests\PaymentReceiptRequest;
use App\Services\MergeDataService;
use App\Traits\UseState;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PaymentReceipt extends Model
{    
    use softDeletes;
    use UseState;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'customer_service_log_id',
        'customer_name',
        'amount',
        'service_name',
        'to_be_paid_at',
        'paid_at',
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
    public static function storePaymentReceipt($request)
    {
        $valid = (new PaymentReceiptRequest)->storeValidationRule($request);
        if (!$valid) return $valid;

        return PaymentReceipt::Create(
            (new MergeDataService)->StoreMergeData($request)
                ->all()
        );
    }

    public static function updatePaymentReceipt($request, $id)
    {
        $valid = (new PaymentReceiptRequest)->updateValidationRule($request, $id);
        if (!$valid) return $valid;

        $model = PaymentReceipt::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return $model;
    }

    public static function toggleStatus($id)
    {
        $model = PaymentReceipt::findOrFail($id);
        $model->state = $model->state ^ 1;
        $model->save();
        return $model;
    }
}