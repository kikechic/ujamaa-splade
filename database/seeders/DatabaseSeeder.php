<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            CompaniesTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            DesignationsTableSeeder::class,
            DepartmentsTableSeeder::class,
            TimesheetPeriodsTableSeeder::class,
            EmployeesTableSeeder::class,
            WorkdaysTableSeeder::class,
            DocumentSequencesTableSeeder::class,
            TimesheetsTableSeeder::class,
            TimesheetEntriesTableSeeder::class,
            DonorsTableSeeder::class,
            OfficesTableSeeder::class,
            DonorsTableSeeder::class,
            LeaveTypesTableSeeder::class,
            TimesheetCommentsTableSeeder::class,
            TimesheetApprovalsTableSeeder::class,
        ]);
    }
}
