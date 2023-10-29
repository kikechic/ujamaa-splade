<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Superadministrator', 'company_id' => 1],
            ['name' => 'Administrator', 'company_id' => 1],
            ['name' => 'User', 'company_id' => 1],
        ];

        $permissions = config('fusion.permissions');

        Role::query()->truncate();

        foreach ($roles as $role) {
            $roleDB = Role::query()->create($role);
            if ($role['name'] == 'Superadministrator') {
                $roleDB->permissions()->sync(range(1, count($permissions) * 4));
                $roleDB->users()->sync([84, 89]);
            }
        }
    }
}
