<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    protected $validated;
    protected Company $company;

    public function setCompany($company): self
    {
        $this->company = $company;
        return $this;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): Company
    {
        return DB::transaction(function () {
            $this->company = Company::query()->create($this->validated);
            if (request()->hasFile('logo')) {
                $this->company->addMediaFromRequest('logo')->toMediaCollection('logos');
            }
            return $this->company;
        });
    }

    public function update(): void
    {
        DB::transaction(function () {
            $this->company->update($this->validated);

            if (request()->hasFile('logo')) {
                $this->company->clearMediaCollection('logos');
                $this->company->addMediaFromRequest('logo')->toMediaCollection('logos');
            }
        });
    }

    public function delete(): void
    {
        DB::transaction(function () {
            $this->company->clearMediaCollection('logos');
            $this->company->delete();
        });
    }
}
