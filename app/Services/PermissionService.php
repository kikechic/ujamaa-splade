<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    protected $validated;
    protected Permission $permission;

    public function setPermission($permission): self
    {
        $this->permission = $permission;
        return $this;
    }

    public function getPermission(): Permission
    {
        return $this->permission;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): Permission
    {
        return DB::transaction(function () {
            $this->permission = Permission::query()->create($this->validated);
            return $this->permission;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->permission->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->permission->delete();
        });
    }
}
