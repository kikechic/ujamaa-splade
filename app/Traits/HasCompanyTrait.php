<?php

namespace App\Traits;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCompanyTrait
{
    public static function bootHasCompanyTrait()
    {
        static::creating(function (Model $model) {
            if (auth()->check()) {
                $model->company_id = auth()->user()->current_company_id;
            }
        });
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withDefault();
    }
}
