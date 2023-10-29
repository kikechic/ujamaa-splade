<?php

namespace App\Services;

use App\Models\Office;
use Illuminate\Support\Facades\DB;

class OfficeService
{
    protected $validated;
    protected Office $office;

    public function setOffice($office): self
    {
        $this->office = $office;
        return $this;
    }

    public function getOffice(): Office
    {
        return $this->office;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): Office
    {
        return DB::transaction(function () {
            $this->office = Office::query()->create($this->validated);
            return $this->office;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->office->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->office->delete();
        });
    }
}
