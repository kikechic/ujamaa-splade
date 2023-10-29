<?php

namespace App\Services;

use App\Models\TimesheetPeriod;
use Illuminate\Support\Facades\DB;

class TimesheetPeriodService
{
    protected $validated;
    protected TimesheetPeriod $timesheetPeriod;

    public function setTimesheetPeriod($timesheetPeriod): self
    {
        $this->timesheetPeriod = $timesheetPeriod;
        return $this;
    }

    public function getTimesheetPeriod(): TimesheetPeriod
    {
        return $this->timesheetPeriod;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): TimesheetPeriod
    {
        return DB::transaction(function () {
            $this->timesheetPeriod = TimesheetPeriod::query()->create($this->validated);
            return $this->timesheetPeriod;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->timesheetPeriod->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->timesheetPeriod->delete();
        });
    }
}
