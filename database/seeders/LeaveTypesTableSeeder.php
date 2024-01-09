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
            LeaveType::query()->create([
                'code' => $code,
                'name' => $name,
                'company_id' => 1,
                'user_id' => '84',
            ]);
        }
    }
}
