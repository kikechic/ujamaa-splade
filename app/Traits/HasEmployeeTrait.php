<?php

namespace App\Traits;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasEmployeeTrait
{
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }
}
