<?php

namespace App\Services;

use App\Models\Designation;
use Illuminate\Support\Facades\DB;

class DesignationService
{
    protected $validated;
    protected Designation $designation;

    public function setDesignation($designation): self
    {
        $this->designation = $designation;
        return $this;
    }

    public function getDesignation(): Designation
    {
        return $this->designation;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): Designation
    {
        return DB::transaction(function () {
            $this->designation = Designation::query()->create($this->validated);
            return $this->designation;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->designation->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->designation->delete();
        });
    }
}
