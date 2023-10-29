<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    protected $validated;
    protected Employee $employee;

    public function setEmployee($employee): self
    {
        $this->employee = $employee;
        return $this;
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): Employee
    {
        return DB::transaction(function () {
            $this->employee = Employee::query()->create($this->validated);
            return $this->employee;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->employee->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->employee->delete();
        });
    }
}
