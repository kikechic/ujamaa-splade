<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->truncate();

        $permissions = config('fusion.permissions');

        foreach ($permissions as $permission) {
            foreach (['access', 'create', 'update', 'delete'] as $type) {
                Permission::query()->create([
                    'name' => "{$permission}_{$type}",
                ]);
            }
        }

        Permission::query()->create([
            'name' => 'access_all_timesheets',
        ]);
    }
}
