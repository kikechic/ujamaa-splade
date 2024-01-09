<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['id' => '1', 'code' => 'ADM', 'name' => 'Administration', 'status' => '1', 'created_at' => '2021-02-17 13:15:08', 'updated_at' => '2021-02-17 13:15:08', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '2', 'code' => 'EMP-HRM', 'name' => 'Empowerment - Huruma', 'status' => '0', 'created_at' => '2021-02-17 13:15:21', 'updated_at' => '2021-02-17 13:15:21', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '3', 'code' => 'EMP-CRD', 'name' => 'Empowerment - Coordination', 'status' => '1', 'created_at' => '2021-02-17 13:15:29', 'updated_at' => '2021-02-17 13:15:29', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '4', 'code' => 'EMP-DND', 'name' => 'Empowerment - Dandora', 'status' => '0', 'created_at' => '2021-02-17 13:15:39', 'updated_at' => '2021-02-17 13:15:39', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '5', 'code' => 'FIN', 'name' => 'Finance', 'status' => '1', 'created_at' => '2021-02-17 13:16:10', 'updated_at' => '2021-02-17 13:16:10', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '6', 'code' => 'EMP', 'name' => 'Empowerment - Kibera', 'status' => '0', 'created_at' => '2021-02-17 13:16:27', 'updated_at' => '2021-02-17 13:16:27', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '7', 'code' => 'MASH', 'name' => 'Mashinani', 'status' => '1', 'created_at' => '2021-02-17 13:16:45', 'updated_at' => '2021-02-17 13:16:45', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '8', 'code' => 'EMP-KK', 'name' => 'Empowerment - Kakuma', 'status' => '1', 'created_at' => '2021-02-17 13:16:58', 'updated_at' => '2021-02-17 13:16:58', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '9', 'code' => 'RES', 'name' => 'Research', 'status' => '1', 'created_at' => '2021-02-17 13:17:06', 'updated_at' => '2021-02-17 13:17:06', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '10', 'code' => 'EMP-KOCH', 'name' => 'Empowerment - Korogocho', 'status' => '0', 'created_at' => '2021-02-17 13:17:18', 'updated_at' => '2021-02-17 13:17:18', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '11', 'code' => 'EMP-MKR', 'name' => 'Empowerment - Mukuru', 'status' => '0', 'created_at' => '2021-03-02 08:26:47', 'updated_at' => '2021-03-02 08:26:47', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '12', 'code' => 'EMP-SOM', 'name' => 'Empowerment - Somalia', 'status' => '1', 'created_at' => '2021-03-02 08:27:36', 'updated_at' => '2021-03-02 08:27:36', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '13', 'code' => 'EMP-NKR', 'name' => 'Empowerment Nakuru', 'status' => '1', 'created_at' => '2023-05-18 15:53:25', 'updated_at' => '2023-05-18 15:56:35', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '14', 'code' => 'EMP-KJD', 'name' => 'Empowerment Kajiado County', 'status' => '1', 'created_at' => '2023-06-22 13:48:56', 'updated_at' => '2023-06-22 13:48:56', 'user_id' => '89', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '15', 'code' => 'EMP-MGR', 'name' => 'EMPOWERMENT MIGORI COUNTY', 'status' => '1', 'created_at' => '2023-06-22 13:51:48', 'updated_at' => '2023-06-22 13:51:48', 'user_id' => '84', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '16', 'code' => 'EMP- KAM', 'name' => 'EMPOWERMENT KIAMBU COUNTY', 'status' => '1', 'created_at' => '2023-06-22 13:53:51', 'updated_at' => '2023-06-22 13:53:51', 'user_id' => '84', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '17', 'code' => 'EMP-NRB', 'name' => 'EMPOWERMENT NAIROBI COUNTY', 'status' => '1', 'created_at' => '2023-06-22 13:55:25', 'updated_at' => '2023-06-22 13:55:25', 'user_id' => '84', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '18', 'code' => 'EMP-MCK', 'name' => 'EMPOERMENT MACHAKOS COUNTY', 'status' => '1', 'created_at' => '2023-06-22 13:56:35', 'updated_at' => '2023-06-22 13:56:35', 'user_id' => '84', 'updater_id' => NULL, 'company_id' => 1],
            ['id' => '19', 'code' => 'FI-NRB', 'name' => 'FINANCE INTERN', 'status' => '1', 'created_at' => '2023-06-22 13:57:19', 'updated_at' => '2023-06-22 13:57:19', 'user_id' => '84', 'updater_id' => NULL, 'company_id' => 1],
        ];

        Department::query()->truncate();

        foreach ($departments as $department) {
            Department::query()->create($department);
        }
    }
}
