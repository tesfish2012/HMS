<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait UseState
{

    protected static function bootUseState()
    {
        static::addGlobalScope('state', function (Builder $builder) {
            $builder->where('state', '!=', '-1');
        });
    }


    public function ScopeWithTrashed($builder)
    {
        return  $builder->withoutGlobalScope('state');
    }

    public function ScopeActive($builder)
    {
        return $builder->withoutGlobalScope('state')->where('state', '>=', 1);
    }

    public function ScopeListAll($builder)
    {
        return $builder->withoutGlobalScope('state')->where('state', '!=', -1);
    }

    public function ScopeTrashRecord($builder, $id)
    {
        return $builder->withoutGlobalScope('state')
            ->where('state', '>=', '1')
            ->findOrFail($id)
            ->update([
                'state' => -1,
                'deleted_at' => Carbon::now()
            ]);
    }

    public function ScopeRestoreRecord($builder, $id)
    {
        return $builder->withoutGlobalScope('state')
            ->whereState(-1)
            ->findOrFail($id)
            ->update([
                'state' => 1
            ]);
    }

    public function ScopeFeatured($builder)
    {
        return $builder->withoutGlobalScope('state')->where('state', 2);
    }

    public function ScopeOnlyTrashed($builder)
    {
        return $builder->withoutGlobalScope('state')->where('state', -1);
    }
}