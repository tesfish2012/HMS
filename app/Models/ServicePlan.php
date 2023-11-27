<?php

namespace App\Models;
use Illuminate\Support\Str;
use App\Constants\MyModel;
use App\Requests\ServicePlanRequest;
use App\Services\MergeDataService;
use App\Services\FileService;
use App\Traits\UseState;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ServicePlan extends Model
{    
    use softDeletes;
    use UseState;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'service_id',
        'code',
        'name',
        'price',
        'description',
        'featured_photo',
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
    public static function storeServicePlan($request)
    {
        $valid = (new ServicePlanRequest)->storeValidationRule($request);
        if (!$valid) return $valid;
            $model=new ServicePlan;
            $model->id= Str::uuid()->toString();
            $model->service_id=$request->input('service_id') ; 
            $model->name=$request->input('name') ; 
            $model->code=$request->input('code') ; 
            $model->price=$request->input('price') ; 
            $model->description=$request->input('description') ;
            
            $filename= (new FileService)->storeFile($request,'featured_photo');
            $model->featured_photo=$filename ; 
            $model->state = 1;
            $model->save();
            // return $model::Create(
            //     (new MergeDataService)->StoreMergeData($model)->all()
            // );
    }

    public static function updateServicePlan($request, $id)
    {
        $valid = (new ServicePlanRequest)->updateValidationRule($request, $id);
        if (!$valid) return $valid;

        $model = ServicePlan::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return $model;
    }

    public static function toggleStatus($id)
    {
        $model = ServicePlan::findOrFail($id);
        $model->state = $model->state ^ 1;
        $model->save();
        return $model;
    }
}