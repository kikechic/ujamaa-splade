<?php

namespace App\Services;

use App\Models\Donor;
use Illuminate\Support\Facades\DB;

class DonorService
{
    protected $validated;
    protected Donor $donor;

    public function setDonor($donor): self
    {
        $this->donor = $donor;
        return $this;
    }

    public function getDonor(): Donor
    {
        return $this->donor;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): Donor
    {
        return DB::transaction(function () {
            $this->donor = Donor::query()->create($this->validated);
            return $this->donor;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->donor->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->donor->delete();
        });
    }
}
