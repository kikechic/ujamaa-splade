<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService
{
    protected $validated;
    protected Role $role;

    public function setRole($role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): Role
    {
        return DB::transaction(function () {
            $this->role = Role::query()->create($this->validated);
            $this->role->permissions()->sync($this->validated['permission_id']);
            return $this->role;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->role->update($this->validated);
            $this->role->permissions()->sync($this->validated['permission_id']);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->role->delete();
        });
    }
}
