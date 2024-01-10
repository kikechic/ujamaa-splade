<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
                $roleDB->permissions()->sync(array_merge(
                    range(1, count($permissions) * 4),
                    [count($permissions) * 4 + 1]
                ));
                $roleDB->users()->sync([84, 89]);
            }
            if ($role['name'] == 'User') {
                $index = array_search('timesheets', $permissions);
                $roleDB->permissions()->sync(range(($index * 4 + 1), ($index * 4) + 3));

                $users = User::query()->whereNotIn('id', [84, 89])->pluck('id')->toArray();
                $roleDB->users()->sync($users);
            }
        }
    }
}
