<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUpdaterTrait
{
    public static function bootHasUpdaterTrait()
    {
        static::updating(function ($model) {
            $model->updater_id = auth()->check() ? auth()->id() : 1;
        });
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
