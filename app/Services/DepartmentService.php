<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    protected $validated;
    protected Department $department;

    public function setDepartment($department): self
    {
        $this->department = $department;
        return $this;
    }

    public function getDepartment(): Department
    {
        return $this->department;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): Department
    {
        return DB::transaction(function () {
            $this->department = Department::query()->create($this->validated);
            return $this->department;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->department->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->department->delete();
        });
    }
}
