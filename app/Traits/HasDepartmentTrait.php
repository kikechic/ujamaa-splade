<?php

namespace App\Traits;

use App\Models\Department;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasDepartmentTrait
{
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class)->withDefault();
    }
}
