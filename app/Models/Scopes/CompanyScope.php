<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class CompanyScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $company = auth()->check() ? auth()->user()->current_company_id : '';

        $builder->where('company_id', $company);
    }
}
