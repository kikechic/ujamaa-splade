<?php

namespace Database\Seeders;

use App\Models\Donor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DonorsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donors = [
            ['id' => '2', 'company_id' => '1', 'code' => 'UJM', 'name' => 'Ujamaa', 'start_date' => '2020-12-24', 'end_date' => '2020-12-31', 'status' => '1', 'updater_id' => NULL, 'user_id' => '1', 'created_at' => '2020-12-31 21:26:28', 'updated_at' => '2020-12-31 21:26:28'],
            ['id' => '3', 'company_id' => '1', 'code' => 'CAD', 'name' => 'Peace & Stabilisation Operations', 'start_date' => '2020-01-01', 'end_date' => '2021-12-31', 'status' => '0', 'updater_id' => NULL, 'user_id' => '1', 'created_at' => '2020-12-31 22:11:07', 'updated_at' => '2022-02-03 09:12:15'],
            ['id' => '4', 'company_id' => '1', 'code' => 'NOVO', 'name' => 'Novo Foundation', 'start_date' => '2020-01-01', 'end_date' => '2021-12-31', 'status' => '0', 'updater_id' => NULL, 'user_id' => '1', 'created_at' => '2021-01-26 13:10:58', 'updated_at' => '2022-02-03 09:12:15'],
            ['id' => '5', 'company_id' => '1', 'code' => 'GCC-M', 'name' => 'Grand Challenges Canada (Mashinani)', 'start_date' => '2020-01-01', 'end_date' => '2021-12-31', 'status' => '0', 'updater_id' => NULL, 'user_id' => '1', 'created_at' => '2021-01-26 13:10:58', 'updated_at' => '2022-02-03 09:12:15'],
            ['id' => '6', 'company_id' => '1', 'code' => 'GCC-E', 'name' => 'Grand Challenges Canada (Empowerement)', 'start_date' => '2020-01-01', 'end_date' => '2021-12-31', 'status' => '1', 'updater_id' => NULL, 'user_id' => '1', 'created_at' => '2021-01-26 13:10:58', 'updated_at' => '2022-12-01 16:25:00'],
            ['id' => '7', 'company_id' => '1', 'code' => 'RUT', 'name' => 'Rutgers (YIDA 2020)', 'start_date' => '2020-01-01', 'end_date' => '2021-12-31', 'status' => '0', 'updater_id' => NULL, 'user_id' => '1', 'created_at' => '2021-01-26 13:10:58', 'updated_at' => '2023-04-12 10:36:18'],
            ['id' => '8', 'company_id' => '1', 'code' => 'JHU', 'name' => 'John Hopkins University', 'start_date' => '2020-01-01', 'end_date' => '2021-12-31', 'status' => '1', 'updater_id' => NULL, 'user_id' => '1', 'created_at' => '2021-01-26 13:10:58', 'updated_at' => '2021-01-26 13:10:58'],
            ['id' => '9', 'company_id' => '1', 'code' => 'WINF', 'name' => 'Winfred Stephens', 'start_date' => '2023-01-01', 'end_date' => NULL, 'status' => '1', 'updater_id' => NULL, 'user_id' => '89', 'created_at' => '2021-05-03 10:10:32', 'updated_at' => '2022-12-01 15:34:32'],
            ['id' => '10', 'company_id' => '1', 'code' => 'UNICEF-S', 'name' => 'UNICEF(Safe Schools)', 'start_date' => '2023-01-01', 'end_date' => NULL, 'status' => '1', 'updater_id' => NULL, 'user_id' => '2', 'created_at' => '2021-06-23 08:34:20', 'updated_at' => '2021-06-23 08:55:09'],
            ['id' => '11', 'company_id' => '1', 'code' => 'AMREF', 'name' => 'Amref- PtY', 'start_date' => '2023-01-01', 'end_date' => NULL, 'status' => '0', 'updater_id' => NULL, 'user_id' => '2', 'created_at' => '2021-08-06 12:47:53', 'updated_at' => '2022-02-03 09:11:17'],
            ['id' => '12', 'company_id' => '1', 'code' => 'ARCADIA', 'name' => 'ARCADIA', 'start_date' => '2023-01-01', 'end_date' => NULL, 'status' => '1', 'updater_id' => NULL, 'user_id' => '84', 'created_at' => '2023-03-10 08:05:27', 'updated_at' => '2023-03-10 08:05:27'],
            ['id' => '13', 'company_id' => '1', 'code' => 'CIFF', 'name' => 'Children Investment Fund Foundation and Elma Foundation', 'start_date' => '2023-01-01', 'end_date' => NULL, 'status' => '1', 'updater_id' => NULL, 'user_id' => '84', 'created_at' => '2023-03-10 08:06:29', 'updated_at' => '2023-03-30 11:37:26'],
        ];

        Donor::query()->truncate();

        foreach ($donors as $donor) {
            Donor::query()->create($donor);
        }
    }
}
