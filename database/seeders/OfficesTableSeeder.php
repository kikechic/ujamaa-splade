<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfficesTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $offices = [
            ['code' => 'HQ', 'name' => 'Headquarters', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'MKR', 'name' => 'Mukuru', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'KRG', 'name' => 'Korogocho', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'NKR', 'name' => 'Nakuru', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'MCA', 'name' => 'Machakos', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'MGR', 'name' => 'Migori', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'KJA', 'name' => 'Kajiado', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'KBR', 'name' => 'Kibera', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'KKM', 'name' => 'Kakuma', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
            ['code' => 'HRM', 'name' => 'Huruma', 'created_at' => '2023-11-04  22:00:00', 'updated_at' => '2023-11-04  22:00:00', 'user_id' => '84', 'company_id' => '1', 'status' => '1',],
        ];

        Office::query()->truncate();

        foreach ($offices as $office) {
            Office::query()->create($office);
        }
    }
}
