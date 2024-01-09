<?php

namespace Database\Seeders;

use App\Models\Workday;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkdaysTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workdays')->truncate();

        $days = [
            ['name' => 'Monday', 'status' => true, 'company_id' => 1],
            ['name' => 'Tuesday', 'status' => true, 'company_id' => 1],
            ['name' => 'Wednesday', 'status' => true, 'company_id' => 1],
            ['name' => 'Thursday', 'status' => true, 'company_id' => 1],
            ['name' => 'Friday', 'status' => true, 'company_id' => 1],
            ['name' => 'Saturday', 'status' => false, 'company_id' => 1],
            ['name' => 'Sunday', 'status' => false, 'company_id' => 1],
        ];

        foreach ($days as $day) {
            Workday::query()->create([
                'user_id' => 1,
                'name' => $day['name'],
                'status' => $day['status'],
                'company_id' => $day['company_id']
            ]);
        }
    }
}
