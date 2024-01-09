<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Designation::query()->truncate();

        $designations = [
            ['id' => '1', 'company_id' => '1', 'code' => 'FM', 'name' => 'Finance Manager', 'status' => '1', 'created_at' => '2021-05-04 21:46:28', 'updated_at' => '2021-05-04 21:46:28', 'user_id' => '89'],
            ['id' => '2', 'company_id' => '1', 'code' => 'ADM', 'name' => 'Administration Manager', 'status' => '1', 'created_at' => '2021-02-17 12:00:04', 'updated_at' => '2021-02-17 12:32:27', 'user_id' => '89'],
            ['id' => '3', 'company_id' => '1', 'code' => 'ED', 'name' => 'Executive Director', 'status' => '1', 'created_at' => '2021-06-21 21:53:18', 'updated_at' => '2021-06-21 21:53:18', 'user_id' => '89'],
            ['id' => '4', 'company_id' => '1', 'code' => 'PM', 'name' => 'Project Manager', 'status' => '1', 'created_at' => '2021-06-21 21:37:36', 'updated_at' => '2021-06-21 21:37:36', 'user_id' => '89'],
            ['id' => '5', 'company_id' => '1', 'code' => 'FO', 'name' => 'Field Officer', 'status' => '1', 'created_at' => '2021-06-24 09:24:09', 'updated_at' => '2021-06-24 09:24:09', 'user_id' => '2'],
            ['id' => '6', 'company_id' => '1', 'code' => 'SALM', 'name' => 'Area Liaisons Manager', 'status' => '1', 'created_at' => '2021-07-18 11:35:26', 'updated_at' => '2021-07-18 11:35:26', 'user_id' => '2'],
            ['id' => '7', 'company_id' => '1', 'code' => 'PO', 'name' => 'Project Officer', 'status' => '1', 'created_at' => '2021-11-08 09:46:43', 'updated_at' => '2021-11-08 09:46:43', 'user_id' => '2'],
            ['id' => '8', 'company_id' => '1', 'code' => 'FI', 'name' => 'FINANCE INTERN', 'status' => '1', 'created_at' => '2023-06-22 13:28:08', 'updated_at' => '2023-06-22 13:28:08', 'user_id' => '84'],
            ['id' => '9', 'company_id' => '1', 'code' => 'CPC', 'name' => 'COUNTY PROJECT COORDINATOR', 'status' => '1', 'created_at' => '2023-06-22 13:28:33', 'updated_at' => '2023-06-22 13:28:33', 'user_id' => '84'],
            ['id' => '10', 'company_id' => '1', 'code' => 'ADMIN ASST', 'name' => 'ADMIN ASSISTANT', 'status' => '1', 'created_at' => '2023-06-22 13:28:59', 'updated_at' => '2023-06-22 13:28:59', 'user_id' => '84'],
        ];

        foreach ($designations as $designation) {
            Designation::query()->create($designation);
        }
    }
}
