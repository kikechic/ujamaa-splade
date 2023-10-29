<?php

namespace App\Traits;

use App\Models\Timesheet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTimesheetTrait
{
    public function timesheet(): BelongsTo
    {
        return $this->belongsTo(Timesheet::class)->withDefault();
    }
}
