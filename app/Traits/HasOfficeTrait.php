<?php

namespace App\Traits;

use App\Models\Office;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOfficeTrait
{
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class)->withDefault();
    }
}
