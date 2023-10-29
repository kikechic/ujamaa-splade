<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompaniesTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->truncate();

        $companies = [
            ['name' => 'Ujamaa Africa - Kenya'],
            ['name' => 'Ujamaa Africa - Somalia'],
        ];

        foreach ($companies as $company) {
            Company::factory()->create($company);
        }
    }
}
