<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUserTrait
{
    public static function bootHasUserTrait()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->check() ? auth()->id() : 1;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
