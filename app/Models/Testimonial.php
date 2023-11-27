<?php

namespace App\Models;

use App\Constants\MyModel;
use App\Requests\TestimonialRequest;
use App\Services\MergeDataService;
use App\Traits\UseState;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use UseState;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
      'id','name','position','quoted_text','body','deleted_at','state'
    ];
    protected $hidden = ['deleted_at'];

    //Relationship
    public function category()
    {
        return $this->belongsTo(MyModel::CATEGORY)->select('id', 'name');
    }

    //Stores
    public static function storeTestimonial($request)
    {
        $valid = (new TestimonialRequest)->storeValidationRule($request);
        if (!$valid) return $valid;

        return Testimonial::Create(
            (new MergeDataService)->StoreMergeData($request)
                ->all()
        );
    }

    public static function updateTestimonial($request, $id)
    {
        $valid = (new TestimonialRequest)->updateValidationRule($request, $id);
        if (!$valid) return $valid;

        $model = Testimonial::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return $model;
    }

    public static function toggleStatus($id)
    {
        $model = Testimonial::findOrFail($id);
        $model->state = $model->state ^ 1;
        $model->save();
        return $model;
    }
}