<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaveTypesTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveType::query()->truncate();

        $leaveTypes = [
            'A' => 'Annual Leave',
            'H' => 'Holiday',
            'S' => 'Sick Leave',
            'ST' => 'Study Leave',
            'RR' => 'Resting & Recuperation',
            'C' => 'Compassionate Leave',
            'W' => 'Weekend',
        ];

        foreach ($leaveTypes as $code => $name) {
            foreach ([1, 2] as $id) {
                LeaveType::query()->create([
                    'code' => $code,
                    'name' => $name,
                    'company_id' => $id,
                    'user_id' => '84',
                ]);
            }
        }
    }
}
