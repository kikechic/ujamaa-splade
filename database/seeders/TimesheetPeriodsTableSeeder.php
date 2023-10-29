<?php

namespace Database\Seeders;

use App\Models\TimesheetPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimesheetPeriodsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timesheetPeriods = [
            ['id' => 1, 'period_year' => '2020', 'period_month' => 3, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-18 13:53:11', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 2, 'period_year' => '2020', 'period_month' => 4, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-18 13:53:17', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 3, 'period_year' => '2020', 'period_month' => 5, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-18 13:53:23', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 4, 'period_year' => '2020', 'period_month' => 6, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-18 13:53:28', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 5, 'period_year' => '2020', 'period_month' => 7, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-18 13:53:34', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 6, 'period_year' => '2020', 'period_month' => 8, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-18 13:52:38', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 7, 'period_year' => '2020', 'period_month' => 9, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-18 13:52:49', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 8, 'period_year' => '2020', 'period_month' => 10, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-18 13:53:01', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 9, 'period_year' => '2020', 'period_month' => 11, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-01-19 06:42:15', 'updated_at' => '2021-06-19 10:28:18', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 19, 'period_year' => '2020', 'period_month' => 12, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2021-02-22 20:04:38', 'updated_at' => '2021-06-19 10:28:23', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 20, 'period_year' => '2021', 'period_month' => 1, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2021-02-22 20:04:40', 'updated_at' => '2021-06-18 15:23:52', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 21, 'period_year' => '2021', 'period_month' => 2, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2021-02-22 20:04:42', 'updated_at' => '2021-06-19 10:28:28', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 22, 'period_year' => '2021', 'period_month' => 3, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-04-20 19:33:30', 'updated_at' => '2021-10-14 13:02:09', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 23, 'period_year' => '2021', 'period_month' => 4, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-04-20 19:33:36', 'updated_at' => '2021-10-14 13:02:14', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 24, 'period_year' => '2021', 'period_month' => 5, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-04-20 19:34:39', 'updated_at' => '2021-10-14 13:02:19', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 25, 'period_year' => '2021', 'period_month' => 6, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-06-18 13:54:45', 'updated_at' => '2021-10-14 13:02:27', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 26, 'period_year' => '2021', 'period_month' => 7, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-06-19 10:28:36', 'updated_at' => '2022-02-28 07:35:25', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 27, 'period_year' => '2021', 'period_month' => 8, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-06-19 10:28:41', 'updated_at' => '2022-02-28 07:35:32', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 28, 'period_year' => '2021', 'period_month' => 9, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2021-06-23 09:08:52', 'updated_at' => '2022-02-28 07:35:38', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 29, 'period_year' => '2021', 'period_month' => 10, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2021-10-14 13:03:43', 'updated_at' => '2022-02-28 07:35:44', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 30, 'period_year' => '2021', 'period_month' => 11, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2021-10-14 13:03:49', 'updated_at' => '2022-02-28 07:35:50', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 31, 'period_year' => '2021', 'period_month' => 12, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2021-10-14 13:03:53', 'updated_at' => '2022-07-25 10:08:40', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 32, 'period_year' => '2022', 'period_month' => 1, 'status' => 'closed', 'user_id' => 89, 'created_at' => '2021-12-06 14:26:08', 'updated_at' => '2022-05-10 15:00:54', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 33, 'period_year' => '2022', 'period_month' => 2, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2022-02-28 07:34:50', 'updated_at' => '2022-11-01 12:54:40', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 34, 'period_year' => '2022', 'period_month' => 3, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2022-02-28 07:34:52', 'updated_at' => '2023-01-04 11:27:08', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 35, 'period_year' => '2022', 'period_month' => 4, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2022-02-28 07:35:00', 'updated_at' => '2023-01-04 11:27:56', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 36, 'period_year' => '2022', 'period_month' => 5, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2022-02-28 07:35:10', 'updated_at' => '2023-01-04 11:27:59', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 37, 'period_year' => '2022', 'period_month' => 6, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2022-02-28 07:35:55', 'updated_at' => '2023-01-04 11:28:03', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 38, 'period_year' => '2022', 'period_month' => 7, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2022-02-28 07:40:37', 'updated_at' => '2023-01-04 11:27:12', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 39, 'period_year' => '2022', 'period_month' => 8, 'status' => 'closed', 'user_id' => 2, 'created_at' => '2022-02-28 08:07:54', 'updated_at' => '2023-01-04 11:28:06', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 40, 'period_year' => '2022', 'period_month' => 9, 'status' => 'closed', 'user_id' => 57, 'created_at' => '2022-07-20 12:28:59', 'updated_at' => '2023-01-04 11:28:10', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 41, 'period_year' => '2022', 'period_month' => 10, 'status' => 'closed', 'user_id' => 57, 'created_at' => '2022-11-01 12:54:23', 'updated_at' => '2023-05-31 11:01:12', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 42, 'period_year' => '2022', 'period_month' => 11, 'status' => 'closed', 'user_id' => 43, 'created_at' => '2022-12-01 10:23:05', 'updated_at' => '2023-05-31 11:01:17', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 43, 'period_year' => '2022', 'period_month' => 12, 'status' => 'closed', 'user_id' => 57, 'created_at' => '2023-01-04 11:28:15', 'updated_at' => '2023-05-31 11:01:20', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 44, 'period_year' => '2023', 'period_month' => 1, 'status' => 'closed', 'user_id' => 84, 'created_at' => '2023-01-04 11:28:23', 'updated_at' => '2023-05-31 11:01:22', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 45, 'period_year' => '2023', 'period_month' => 2, 'status' => 'open', 'user_id' => 84, 'created_at' => '2023-01-04 11:28:32', 'updated_at' => '2023-01-04 11:28:32', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 46, 'period_year' => '2023', 'period_month' => 3, 'status' => 'open', 'user_id' => 84, 'created_at' => '2023-01-04 11:28:35', 'updated_at' => '2023-01-04 11:28:35', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 47, 'period_year' => '2023', 'period_month' => 4, 'status' => 'open', 'user_id' => 71, 'created_at' => '2023-01-04 17:22:05', 'updated_at' => '2023-01-04 17:22:05', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 48, 'period_year' => '2023', 'period_month' => 5, 'status' => 'open', 'user_id' => 84, 'created_at' => '2023-05-31 10:59:50', 'updated_at' => '2023-05-31 10:59:50', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 49, 'period_year' => '2023', 'period_month' => 6, 'status' => 'open', 'user_id' => 84, 'created_at' => '2023-05-31 10:59:52', 'updated_at' => '2023-05-31 10:59:52', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 50, 'period_year' => '2023', 'period_month' => 7, 'status' => 'open', 'user_id' => 84, 'created_at' => '2023-05-31 11:00:57', 'updated_at' => '2023-05-31 11:00:57', 'updater_id' => NULL, 'company_id' => '1'],
            ['id' => 51, 'period_year' => '2023', 'period_month' => 8, 'status' => 'open', 'user_id' => 84, 'created_at' => '2023-05-31 11:01:28', 'updated_at' => '2023-05-31 11:01:28', 'updater_id' => NULL, 'company_id' => '1'],
        ];

        TimesheetPeriod::query()->truncate();

        foreach ($timesheetPeriods as $timesheetPeriod) {
            TimesheetPeriod::query()->create($timesheetPeriod);
        }
    }
}
