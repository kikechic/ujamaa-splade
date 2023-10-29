<?php

namespace App\Traits;

use App\Models\Designation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasDesignationTrait
{
    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class)->withDefault();
    }
}
