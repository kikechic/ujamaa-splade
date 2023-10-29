<?php

namespace App\Services;

use App\Models\LeaveType;
use Illuminate\Support\Facades\DB;

class LeaveTypeService
{
    protected $validated;
    protected LeaveType $leaveType;

    public function setLeaveType($leaveType): self
    {
        $this->leaveType = $leaveType;
        return $this;
    }

    public function getLeaveType(): LeaveType
    {
        return $this->leaveType;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): LeaveType
    {
        return DB::transaction(function () {
            $this->leaveType = LeaveType::query()->create($this->validated);
            return $this->leaveType;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->leaveType->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->leaveType->delete();
        });
    }
}
